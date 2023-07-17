@extends('layouts.auth-master')

<style>

body {
    display: flex;
    justify-content: center;
    align-items: center;

}

body.text-center {
    /* background: #71bbd9; */
    display: flex;
    justify-content: center;
    align-items: center;
    /* background-color: rgb(0, 0, 0); */
    /* color: #522a6e!important; */
    position: relative;
    background-image: url('/assets/images/qrcode_banner.jpg');

    background-repeat: no-repeat;
    background-position-y: center;
    background-position-x: center;
    background-size: cover;
    height: 100vh;
    display: flex;
    align-items: center;
    z-index: 0;
    padding: 10PX;
}

    main.form-signin {
    min-width: 500px;
    align-items: center;
    /* background: rgba(255,255,255,0.3); */
    background: rgba(113,187,217,0.5);
    padding: 20px;
    border-radius:20px;
    /* background: #71bbd9; */
}

a.logo {
    position: absolute;
    left: 10px;
    top: 10px;
}


@media screen and (max-width: 540px) {   
     main.form-signin {
    min-width: 300px;
}
}

@media screen and (max-width: 300px) {   
     main.form-signin {
    min-width: 250px;
}
}

</style>
<a href="#" class="logo">
    <img src="{{ asset('assets/images/instareel.png') }}" class="img-fluid mt-2" alt="" style="max-width:150px;">
</a>
@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        {{-- <img class="mb-4" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57"> --}}
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Employee Id" required="required" autofocus>
            <label for="floatingName">Employee Id</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        {{-- <div class="form-group mb-3">
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember" value="1">
        </div> --}}

        {{-- <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button> --}}
        <button class=" btn-lg btn-primary" type="submit">Login</button>
        
        @include('auth.partials.copy')
    </form>
@endsection
