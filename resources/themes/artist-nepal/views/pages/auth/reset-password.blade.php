<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Reset Password &#8211; ArtistNepal</title>

    <link rel="stylesheet" href="https://artistnepal.com/wp-content/themes/artistnepal/style.css" type="text/css"
          media="screen"/>
    <link rel='stylesheet' id='style-css' href='https://artistnepal.com/wp-content/themes/artistnepal/assets/css/register.css?ver=6.8.3' type='text/css' media='all' />
    <link rel="pingback" href="https://artistnepal.com/xmlrpc.php"/>


    <meta name='robots' content='max-image-preview:large'/>
    <style>img:is([sizes="auto" i], [sizes^="auto," i]) {
            contain-intrinsic-size: 3000px 1500px
        }</style>
    <link rel="icon" href="https://artistnepal.com/wp-content/uploads/2019/12/cropped-ArtistNepal-Icon-32x32.png"
          sizes="32x32"/>
    <link rel="icon" href="https://artistnepal.com/wp-content/uploads/2019/12/cropped-ArtistNepal-Icon-192x192.png"
          sizes="192x192"/>
    <link rel="apple-touch-icon"
          href="https://artistnepal.com/wp-content/uploads/2019/12/cropped-ArtistNepal-Icon-180x180.png"/>
    <meta name="msapplication-TileImage"
          content="https://artistnepal.com/wp-content/uploads/2019/12/cropped-ArtistNepal-Icon-270x270.png"/>
</head>
<body
    class="wp-singular page-template page-template-page-templates page-template-register page-template-page-templatesregister-php page page-id-9797 wp-theme-artistnepal">
<div id="page">

    <div class="register-container">
        <div class="register-image"
             style="background: url('https://artistnepal.com/wp-content/uploads/2025/04/Chhulthim-Dollma-Gurung-Actress-producer-VJ-RJ-model.artistnepal-5-1-.webp') no-repeat center center;background-size: cover;">
            <div class="primary-title-wrap">
                <h1>Reset Password</h1>
            </div>
        </div>

        <div class="register-form-area">
            <div class="register-form-box">
                <div class="register-logo" onclick="window.location.href = 'https://artistnepal.com';">
                    <img src="https://artistnepal.com/wp-content/mu-plugins/customize-admin/assets/logo.svg"
                         alt="Site Logo">
                </div>

                @if($data['is-artist-route'])
                <div class="an_login_teaser message register">
                    <p data-start="163" data-end="332">We’re thrilled to invite you to be part of <a href="http://artistnepal.com"><strong data-start="232" data-end="251">ArtistNepal.com</strong> </a>– Nepal’s <strong data-start="262" data-end="329">first and most exclusive digital portfolio magazine for artists</strong>.</p>
                    <p data-start="334" data-end="484"><strong data-start="336" data-end="352">Free to Join!</strong><br data-start="352" data-end="355"><strong data-start="358" data-end="396">Exclusively for Individual Artists</strong><br data-start="396" data-end="399">Showcase your talent, grow your visibility, and connect with the creative world.</p>
                    <p data-start="486" data-end="526"><strong data-start="486" data-end="516">Let your art speak louder.</strong> Join now!</p>
                </div>
                @endif

                <div class="register-tagline">


                    <form method="post" action="">
                        <input type="email" name="email" placeholder="Enter your Email" value="" required><br>

                        <small style="display: block; margin-bottom: 15px;">
                            Password reset confirmation will be emailed to you.
                        </small>

                        <input type="submit" name="submit_reset" value="Reset Password">
                    </form>

                    <div class="lost-password">
                        <a href="{{ route('app.login') }}">Login</a> |
                        <a href="{{ route('home') }}">Home</a>
                    </div>
                    <!--                <div class="social-login" style="display: flex">-->
                    <!--                    <a href=""><img src="/wp-content/plugins/nextend-facebook-connect/admin/images/google/dark.png" alt=""></a>-->
                    <!--                    <a href=""><img src="/wp-content/plugins/nextend-facebook-connect/admin/images/facebook/dark.png" alt=""></a>-->
                    <!--                </div>-->

                    <!--                --><!--                -->            </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


