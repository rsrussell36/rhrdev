<?php
/**
 * Template Name: RHR Forgot Password
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
                                    <div class="paragraph p-bigger"><?php echo esc_html__('Forgot Your Password?', 'rhr'); ?></div><br>
                                        <div class="paragraph p-gray"><?php echo esc_html__('If you forgot your password, no worries: enter your email address and we\'ll send you a link you can use to pick a new password', 'rhr'); ?> </div><br><br>
                                            <?php
                                            $attributes['errors'] = array();
                                            if ( isset( $_REQUEST['errors'] ) ) {
                                                $error_codes = explode( ',', $_REQUEST['errors'] );

                                                foreach ( $error_codes as $error_code ) {
                                                    $attributes['errors'] []= get_error_message( $error_code );
                                                }
                                            }
                                            ?>
                                            <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
                                                <?php foreach ( $attributes['errors'] as $error ) : ?>
                                                    <p class="rhr-red">
                                                        <?php echo $error; ?>
                                                    </p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <div class="form">
                                                <form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
                                                    <div class="row">
                                                        <div class="group">
                                                            <div class="input i-black">
                                                                <input type="text" name="user_login" id="user_login" placeholder="Username or Email*" value="<?php if(isset($email_set)){ echo $email_set; } ?>" required arial-label="Email*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="group">
                                                            <a href="<?php echo rhr_credential_login_page_slug(); ?>" class="bt-forgot"><?php echo esc_html__('Login','rhr'); ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="row ended">
                                                        <button class="bt-login" id="signin" name="signin" data-cursor="scale">
                                                            <span><?php echo esc_html__('Reset Password','rhr'); ?></span>
                                                        </button>
                                                    </div>
                                                </form>
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
