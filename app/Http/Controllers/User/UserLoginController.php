<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\PasswordAccount;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyAccount;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        //kiểm tra trường remember có được chọn hay không
        if (Auth::guard('account')->attempt($arr)) {
            $accout_id = Auth::guard('account')->id();
            // dd(Auth::guard('account')->id());
             $account = Account::find($accout_id);
            // dd('đăng nhập thành công');
            // dd(Auth::guard('account')->user()->name);
            return redirect()->route('user.index')->with('status','succsec');
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {

           
            return redirect()->route('user.login')->with('dangerous','Tài khoản hoặc mật khẩu chưa chính xác');
            //...code tùy chọn
            //đăng nhập thất bại hiển thị đăng nhập thất bại
        }
    }
    public function create()
    {

        return view('user.login.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
            'signupName' => ['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255','unique:accounts'],
            'password'=>['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại trong hệ thống',
                'min' => ':attribute có độ dài ít nhất :min kí tự',
             ],
            [
                'signupName'=>'Tên người dùng',
                'email'=>'Email',
                'password' => 'Mật khẩu',
            ]);
        if($validate){
            $data=['name' => $request->signupName,
            'email' =>$request->email,
            'password'=>$request->password,
            ];
             Account::create([
                'name' =>$data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
                'verify_account'=>false,
            ]);
            return redirect()->route('user.login')->with('status','Tạo tài khoản thành công');
        }else{
           return redirect()->route('user.register')->with('dangerous','Tạo tài khoản thất bại');
        }
        
       
        
    }
    public function logout(Request $request) {
        Auth::guard('account')->logout();
 
        //  $request->session()->invalidate();
 
        // $request->session()->regenerateToken();
        return redirect()->route('user.index');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function verify(){
     
        return view('user.login.verify');
    }
    public function sendMail(Request $request, $id)
    {
        
        $user = Account::where('id', $id)->firstOrFail();
        // $verify =  [
        //     'email' => $user->email,
        //     'token' =>  rand(1000,5000),
        // ];
        $passwordReset = PasswordAccount::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' =>rand(1000,5000),
        ]);
        if($passwordReset){
            $user->notify(new VerifyAccount($passwordReset -> token));
        }
        $status = 'Chúng tôi đã gửi mã code vào email của bạn .';
        return view('user.login.verifyConfirm',compact('status'));
       
    }
    public function verifyConfirm(Request $request ,$id) {
        // $passwordReset = PasswordAccount::where('token', $request->token)->firstOrFail();
        $user = Account::where('id', $id)->firstOrFail();
        $email =  PasswordAccount::where('email', $user->email)->firstOrFail();
        if (Carbon::parse($email->updated_at)->addMinutes(720)->isPast()) {
            $email->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        if($request->code){
            if($request->code == $email->token){
                $user -> verify_account = true;
                $user->update();
                $email->delete();

                return redirect()->route('user.verify')->with('status','Xác thực thành công .');
                
            }else{
                $status ='Mã không đúng xin nhập lại .';
                return view('user.login.verifyConfirm',compact('status'));
            }
        }
        // $user = Account::where('email', $passwordReset->email)->firstOrFail();
        // $updatePasswordUser = $user->update(['password'=> Hash::make($request->password)]);
        // $passwordReset->delete();
        // return redirect()->route('user.login')->with('status','Bạn đã đổi mật khẩu thành công');
    }
    function info() {
        return view('user.login.info');
    }
    public function destroy($id)
    {
        //
    }
}
