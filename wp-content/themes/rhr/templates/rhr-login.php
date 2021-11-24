<?php
/**
 * Template Name: RHR Login
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHR
 */
do_action('rhr_user_redirect_if_logged_in');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php rhr_head(); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body>
	<main data-page="login">
		<header class="header h-login">
            <a href="/" class="go-back" data-cursor="scale">
                <div class="svg"></div>
            </a>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col col-10">
                        <div class="contents">
                        <a href="<?php echo home_url();?>" class="logo" data-cursor="scale">
                            <div class="svg"></div>
                        </a>
                    </div>
                </div>
            </div>
		</header>
    <div class="main-content p-login">
      <section>
        <div class="pages-content pc-noPadidng pc-solutions-inner">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-12">
                        <div class="login">
                            <div class="logo-line svg ll-left"></div>
                            <div class="wrapper">
                              <div class="paragraph p-bigger"><?php echo esc_html__('Welcome Back!', 'rhr'); ?></div><br>
                              <div class="paragraph p-gray"><?php echo esc_html__('Great to see you again. Please enter your login details below.', 'rhr'); ?> </div><br><br>
                                <div class="form">
                                <?php
                                // Check if the user just requested a new password
                                    $attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';
                                    $attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;
                                ?>
                                <?php if ( $attributes['lost_password_sent'] ) : ?>
                                    <p class="rhr-sent-password-link">
                                        <?php _e( 'Check your email for a link to reset your password.', 'rhr' ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( $attributes['logged_out'] ) : ?>
                                    <p class="rhr-signout">
                                            <?php _e( 'You have signed out. Would you like to sign in again?', 'rhr' ); ?>
                                    </p>
                                    <?php endif; ?>
                                <?php
                                // Error messages
                                    $errors = array();
                                    if ( isset( $_REQUEST['login'] ) ) {
                                        $error_codes = explode( ',', $_REQUEST['login'] );

                                        foreach ( $error_codes as $code ) {
                                            $errors []= get_error_message( $code );
                                        }
                                    }
                                    $attributes['errors'] = $errors;

                                ?>
                                <!-- Show errors if there are any -->
                                    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
                                        <?php foreach ( $attributes['errors'] as $error ) : ?>
                                            <p class="paragraph p-gray rhr-red">
                                                <?php echo $error; ?>
                                            </p>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <form method="post" action="<?php echo wp_login_url(); ?>">
                                        <div class="row">
                                            <div class="group">
                                                <div class="input i-black">
                                                    <input type="text" name="log" id="user_login" placeholder="Username or Email*" required arial-label="Email*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="group">
                                                <div class="input i-black">
                                                    <input type="password" name="pwd" id="user_pass" placeholder="Password*" arial-label="Password*" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="group">
                                                <div class="checkbox i-black">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="remember" >
                                                    <label class="custom-control-label" for="remember"><?php echo esc_html__('Remember Me','rhr'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="group">
                                                <a href="<?php echo rhr_credential_forgot_page_slug(); ?>" class="bt-forgot"><?php echo esc_html__('Forgot Password','rhr'); ?></a>
                                            </div>
                                        </div>
                                        <div class="row ended">
                                            <button class="bt-login" id="signin" name="signin" data-cursor="scale">
                                                <span><?php echo esc_html__('Log in','rhr'); ?></span>
                                            </button>
                                        </div>
                                    </form>
                              </div>
                            </div>
                            <div class="logo-line svg ll-right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </div>
    <div id="cursor" class="cursor">
      <div class="pointer"></div>
      <div class="icos">
        <div class="ico i-play svg"></div>
        <div class="ico i-left svg"></div>
        <div class="ico i-right svg"></div>
      </div>
      <div class="text">
        <span><?php echo esc_html__('More','rhr'); ?></span>
      </div>
    </div>

</main>
<?php wp_footer(); ?>
</body>
</html>
