<?php
/**
 * Template Name: RHR Reset Password
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHR
 */

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
            <a href="<?php echo rhr_credential_login_page_slug(); ?>" class="go-back" data-cursor="scale">
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
                                    <?php if ( is_user_logged_in() ) : ?>
                                        <div class="paragraph p-bigger"><?php echo esc_html__('You are already login.', 'rhr'); ?></div><br>
                                    <?php else: ?>
                                        <div class="paragraph p-bigger"><?php echo esc_html__('Welcome Back!', 'rhr'); ?></div><br>
                                        <div class="paragraph p-gray"><?php echo esc_html__('Great to see you again. Please enter your login details below.', 'rhr'); ?> </div><br><br>
                                            <div class="form">
                                                <?php
                                                if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) :
                                                    $attributes['login'] = $_REQUEST['login'];
                                                    $attributes['key'] = $_REQUEST['key'];

                                                    // Error messages
                                                    $errors = array();
                                                    if ( isset( $_REQUEST['error'] ) ) {
                                                        $error_codes = explode( ',', $_REQUEST['error'] );

                                                        foreach ( $error_codes as $code ) {
                                                            $errors []= get_error_message( $code );
                                                        }
                                                    }
                                                    $attributes['errors'] = $errors;
                                                ?>
                                                <form name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
                                                    <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off" />
                                                    <input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />
                                                    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
                                                        <?php foreach ( $attributes['errors'] as $error ) : ?>
                                                            <p class="rhr-reset-error">
                                                                <?php echo $error; ?>
                                                            </p>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <div class="row">
                                                        <div class="group">
                                                            <div class="input i-black">
                                                                <input type="password" name="pass1" id="email" placeholder="New Password*" value="<?php if(isset($email_set)){ echo $email_set; } ?>" required arial-label="Email*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="group">
                                                            <div class="input i-black">
                                                                <input type="password" name="pass2" placeholder="Repeat new password*" arial-label="Password*" value="<?php if(isset($pass_set)){ echo $pass_set; } ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="group">
                                                            <p class="description"><?php echo wp_get_password_hint(); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row ended">
                                                        <button class="bt-login" id="signin" name="signin" data-cursor="scale">
                                                            <span><?php echo esc_html__('Reset Password','rhr'); ?></span>
                                                        </button>
                                                    </div>
                                                </form>
                                                <?php else: ?>
                                                    <?php echo __( 'Invalid password reset link.', 'rhr' ); ?>
                                                <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
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
