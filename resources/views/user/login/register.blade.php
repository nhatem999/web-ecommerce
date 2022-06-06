<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href={{ asset('public/users/css/import/register.css') }}>

<div class="container">
    <div class="row">
        <div class="panel panel-primary" style="margin-top:60px">
            <div class="panel-body">
                @if (session('dangerous'))
                    <div class="alert alert-danger">
                        {{ session('dangerous') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('user.store') }}" role="form">
                    @csrf
                    <div class="form-group">
                        <h2>Create account</h2>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupName">Your name</label>
                        <input id="signupName" name="signupName" type="text" maxlength="50" class="form-control"
                            value="{{ old('signupName') }}">
                        @error('signupName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupEmail">Email</label>
                        <input id="signupEmail" name="email" type="email" maxlength="50" class="form-control"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Password</label>
                        <input id="signupPassword" name="password" type="password" maxlength="25" class="form-control"
                            required autocomplete="new-password" placeholder="at least 6 characters" length="40">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password_confirmation">Password again</label>
                        <input id="signupPasswordagain" name="password_confirmation" type="password" maxlength="25"
                            class="form-control" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button id="signupSubmit" type="submit" class="btn btn-info btn-block">Create your
                            account</button>
                    </div>
                    {{-- <p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and
                        our <a href="#">Privacy Policy</a>.</p> --}}
                    <hr>
                    <p></p>Already have an account? <a href="{{ route('user.login') }}">Sign in</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
