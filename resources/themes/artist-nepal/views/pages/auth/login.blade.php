<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Login &#8211; ArtistNepal</title>
    <link rel='stylesheet' id='style-css'
          href='https://artistnepal.com/wp-content/themes/artistnepal/assets/css/login.css?ver=6.8.3' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='css/normalize.min.css-css'
          href='https://artistnepal.com/wp-content/themes/artistnepal/assets/css/normalize.min.css' type='text/css'
          media='all'/>
    <link rel="stylesheet" href="https://artistnepal.com/wp-content/themes/artistnepal/style.css" type="text/css"
          media="screen"/>
    <link rel="pingback" href="https://artistnepal.com/xmlrpc.php"/>

    <title>Login &#8211; ArtistNepal</title>
    <meta name='robots' content='max-image-preview:large'/>
    <style>img:is([sizes="auto" i], [sizes^="auto," i]) {
            contain-intrinsic-size: 3000px 1500px
        }</style>

</head>
<body
    class="wp-singular page-template page-template-page-templates page-template-login page-template-page-templateslogin-php page page-id-9795 wp-theme-artistnepal">
<div id="page">

    <div id="header" role="banner">
        <div id="headerimg">
            <h1><a href="https://artistnepal.com/">ArtistNepal</a></h1>
            <div class="description">ArtistNepal&#039;s login or Sign Up | Where Professional Artists Meet &#8211; find
                musicians, actors, models, dancers, photographers, and directors | Nepal&#039;s 1st Online Database
                &amp; Portfolio Management site for Nepali Artists.
            </div>
        </div>
    </div>
    <hr/>

    <div class="login-container">
        <div class="login-image"
             style="background: url('https://artistnepal.com/wp-content/uploads/2025/04/Chhulthim-Dollma-Gurung-Actress-producer-VJ-RJ-model.artistnepal-5-1-.webp') no-repeat center center;background-size: cover;">
            <div class="primary-title-wrap">
                <h1>ARTISTNEPAL
                    Let's get started!</h1>
            </div>

            <div class="secondary-title-wrap">
                <h3>Crate-> Verify-> Access. Join the artistnepal.com</h3>
            </div>
        </div>

        <div class="login-form-area">
            <div class="login-form-box">
                <div class="login-logo" onclick="window.location.href = 'https://artistnepal.com';">
                    <img src="https://artistnepal.com/wp-content/mu-plugins/customize-admin/assets/logo.svg"
                         alt="Site Logo">
                </div>
                <div class="login-tagline">
                    <b>
                    </b>
                </div>

                <form name="custom_loginform" id="custom_loginform" action="{{ route('app.login') }}"
                      method="post">
                    @csrf
                    <p class="login-username">
                        <label for="user_login">Username or Email</label>
                        <input type="text" name="user_login" id="user_login" autocomplete="username" class="input" value="{{ old('user_login') }}"
                               size="20"/>
                    </p>
                    <p class="login-password">
                        <label for="user_pass">Password</label>
                        <input type="password" name="pwd" id="user_pass" autocomplete="current-password"
                               spellcheck="false" class="input" value="" size="20"/>
                    </p>
                    <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme"
                                                            value="forever"/> Remember Me</label></p>
                    <p class="login-submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary"
                               value="Log In"/>
                    </p></form>
                <div class="lost-password">
                    <a href="{{ route('app.register') }}">Register</a> |
                    <a href="{{ route('app.reset-password') }}">Lost your password?</a>
                </div>
                <!--                <div class="social-login" style="display: flex">-->
                <!--                    <a href=""><img src="/wp-content/plugins/nextend-facebook-connect/admin/images/google/dark.png" alt=""></a>-->
                <!--                    <a href=""><img src="/wp-content/plugins/nextend-facebook-connect/admin/images/facebook/dark.png" alt=""></a>-->
                <!--                </div>-->
            </div>
        </div>
    </div>

</div>
</body>
</html>
