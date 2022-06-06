<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Account;
use Illuminate\Http\Request;
use App\Models\PasswordAccount;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function writeMail(){
        return view('user.login.resetPassword');
    }
    public function sendMail(Request $request)
    {
        $user = Account::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordAccount::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
  
        return response()->json([
        'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    public function confirm(){
        return view('user.login.confirm');
    }
    public function reset(Request $request)
    {
        $validate = $request->validate([
            'password' => 'required|min:8',
            'token' => 'required',

        ],[
            'required' => ':attribute không được để trống',
            'min' => ':attribute có độ dài ít nhất :min kí tự',
         ],
        [
            'password' => 'Mật khẩu',
            'token' => 'Mã token'
        ]);
        if($request->token){
            $passwordReset = PasswordAccount::where('token', $request->token)->firstOrFail();
        }
       
        if($validate){
            if( $passwordReset){
                if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
                    $passwordReset->delete();
        
                    return response()->json([
                        'message' => 'This password reset token is invalid.',
                    ], 422);
                }
                $user = Account::where('email', $passwordReset->email)->firstOrFail();
                $updatePasswordUser = $user->update(['password'=> Hash::make($request->password)]);
                $passwordReset->delete();
                return redirect()->route('user.login')->with('status','Bạn đã đổi mật khẩu thành công');
            }
            else{
                dd('chưa hợp lệ');
            }
            
        }else{
            // return redirect()->route('confirm.password')->with('status', 'This password reset token is invalid');
            dd('chưa hợp lệ');
        }
     
            
        
       
        // return redirect()->route('user.login')->with('status','Bạn đã đổi mật khẩu thành công');
        

        
    }
}