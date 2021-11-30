@extends('layouts.layout')

@section('title', 'Login')

@section('content')

<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End-->
<!--================login_part Area =================-->
<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>New to our Shop?</h2>
                        <p>There are advances being made in science and technology
                            everyday, and a good example of this is the</p>
                        <a href="#" class="btn_3">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Welcome Back ! <br>
                            Please Sign in now</h3>

                        @error('email')
                            <div class="" style="margin-bottom: 20px; color: red; font-size: 0.8em;">
                                Wrong email!
                            </div>
                        @enderror
                        @error('password')
                            <div class="" style="margin-bottom: 20px; color: red; font-size: 0.8em;">
                                Wrong password!
                            </div>
                        @enderror

                        <form class="row contact_form" action="{{ route('login') }}" method="post" novalidate="novalidate">
                            <div class="col-md-12 form-group p_star">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                    placeholder="Password">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="f-option" name="selector">
                                    <label for="f-option">Remember me</label>
                                </div>
                                <button type="submit" value="submit" class="btn_3">
                                    log in
                                </button>
                                <a class="lost_pass" href="#">forget password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->

@endsection
