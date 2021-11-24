<?php

class rhr_extra {

  public function __construct() {
        add_action( 'wp_ajax_rhr_loading_post', [ $this, 'rhr_loading_post' ] );
        add_action( 'wp_ajax_nopriv_rhr_loading_post', [ $this, 'rhr_loading_post' ] );
        add_action( 'wp_ajax_rhr_download_pdf_black', [ $this, 'rhr_download_pdf_black' ] );
        add_action( 'wp_ajax_nopriv_rhr_download_pdf_black', [ $this, 'rhr_download_pdf_black' ] );

        add_action( 'wp_ajax_rhr_download_pdf', [ $this, 'rhr_download_pdf' ] );
        add_action( 'wp_ajax_nopriv_rhr_download_pdf', [ $this, 'rhr_download_pdf' ] );
        add_action( 'wp_ajax_rhr_contact_send', [ $this, 'rhr_contact_message' ] );
        add_action( 'wp_ajax_nopriv_rhr_contact_send', [ $this, 'rhr_contact_message' ] );
  }
    public function rhr_loading_post(){
        global $wpdb;

        $nonce = sanitize_text_field( $_POST['nonce'] );
        if ( !wp_verify_nonce( $nonce, 'rhr-nonce' ) ) {
            die( '-1' );
        }
        $search = sanitize_text_field( $_POST['search'] );
        $item = sanitize_text_field( $_POST['item'] );
        $p_type = sanitize_text_field( $_POST['p_type'] );
        $q = [
            'order'               => 'DESC',
            'orderby'             => 'post_date',
            'post_status'         => 'publish',
            'posts_per_page'      => $item,
            'ignore_sticky_posts' => 1,
            's' => $search,
        ];
        if ( !empty($p_type)) {
          $post_types = [
              'post_type' => $p_type,
          ];
          $q = wp_parse_args($q, $post_types);
      }
        $query = new WP_Query( $q );
        if ( $query->have_posts() ):
            echo '<div class="search-list">';
         while ($query->have_posts()) : $query->the_post(); ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="s-item" data-cursor="scale">
                <h3 class="s-title"><?php echo get_the_title(); ?></h3>
            </a>
        <?php endwhile; wp_reset_postdata();
        echo '<a href='.get_search_link($search).' class="s-item search-see-more" data-cursor="scale">Show All Results</a>';
        echo '</div>';
        else:
            echo '<h3 class="search-not-found">We didn\'t find any results for the search <em>"'.$search.'"</em></h3>';
        endif;
        die();
    }
    public function rhr_download_pdf_black(){
        global $wpdb;
        $is_popup_wc = rhr_options( 'is_popup_wc', '' );
        $nonce = sanitize_text_field( $_POST['nonce'] );
        if ( !wp_verify_nonce( $nonce, 'rhr-nonce' ) ) {
            die( '-1' );
        }
        $name = sanitize_text_field( $_POST['name'] );
        $email = sanitize_text_field( $_POST['email'] );
        $company = sanitize_text_field( $_POST['company'] );
        $pdffile = sanitize_text_field( $_POST['pdffile'] );
        $datato = sanitize_text_field( $_POST['datato'] );
        $datareply = sanitize_text_field( $_POST['datareply'] );
        $datamsg = sanitize_text_field( $_POST['datamsg'] );
        $msgprefix = sanitize_text_field( $_POST['msgprefix'] );
        $datasuccess = sanitize_text_field( $_POST['datasuccess'] );
        $dataempty = sanitize_text_field( $_POST['dataempty'] );
        $dataerror = sanitize_text_field( $_POST['dataerror'] );
        $datasubject = sanitize_text_field( $_POST['datasubject'] );
        $to =  isset($datato) && !empty($datato) ? $datato : '';
        $subject = $datasubject;
        $charset = 'utf-8';
      $body_msgprefix = $msgprefix;
      if(!empty($email) && is_email($email)){
                $body = '<!doctype html>
                <html>
                <head>
                  <meta name="viewport" content="width=device-width" />
                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                  <style>
                    body {
                    background-color: #f6f6f6;
                    font-family: sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                    padding: 0;
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                  }
                  table {
                    border-collapse: separate;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    width: 100%;
                  }
                  table td {
                    font-family: sans-serif;
                    font-size: 14px;
                    vertical-align: top;
                  }

                  table td.emailhedpadding{background: #EAF2FA;padding-left:10px}
                  table td.emailvalpadding{padding:0 30px}
                  table td.emailvalpadding a{text-decoration: none;color: #000000;}

                        .body {
                          background-color: #f6f6f6;
                          width: 100%;
                        }

                        .container {
                          display: block;
                          margin: 0 auto !important;
                          padding: 10px;
                          width: 70%;
                        }

                        .content {
                          box-sizing: border-box;
                          display: block;
                          margin: 0 auto;
                          width: 100%;
                          padding: 10px;
                        }
                        .main {
                          background: #fff;
                          border-radius: 3px;
                          width: 100%;
                        }
                        .wrapper {
                          box-sizing: border-box;
                          padding: 20px;
                        }
                        .footer {
                          clear: both;
                          padding-top: 10px;
                          text-align: center;
                          width: 100%;
                        }
                        .footer td,
                        .footer p,
                        .footer span,
                        .footer a {
                          color: #999999;
                          font-size: 12px;
                          text-align: center;
                        }
                        td{padding: 6px 0}
                        hr {
                          border: 0;
                          border-bottom: 1px solid #f6f6f6;
                          margin: 20px 0;
                        }
                        @media only screen and (max-width: 620px) {
                          table[class=body] .content {
                            padding: 0 !important;
                          }
                          table[class=body] .container {
                            padding: 0 !important;
                            width: 100% !important;
                          }
                          table[class=body] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;
                          }
                        }
                      </style>
                    </head>
                    <body class="">
                      <table border="0" cellpadding="0" cellspacing="0" class="body">
                        <tr>
                        <td>&nbsp;</td>
                        <td class="container">
                          <div class="content">
                            <table class="main">
                              <tr>
                                <td class="wrapper">
                                  <table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="emailhedpadding"><strong>Name</strong></td>
                                  </tr>
                                    <tr>
                                      <td class="emailvalpadding">'.$name.'</td>
                                    </tr>
                                    <tr>
                                    <td class="emailhedpadding"><strong>Email</strong></td>
                                  </tr>
                                    <tr>
                                      <td class="emailvalpadding">'.$email.'</td>
                                    </tr>
                                    <tr>
                                    <td class="emailhedpadding"><strong>Company</strong></td>
                                  </tr>
                                    <tr>
                                      <td class="emailvalpadding">'.$company.'</td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                          </table>
                          </div>
                          </td>
                          <td>&nbsp;</td>
                          </tr>
                          </table>
                          </body>
                          </html>';
                      if(!empty($to)){
                        $headers[] = 'From: ' . ucfirst(get_bloginfo('name')) . ' <' . $datareply . '>';
                        $headers[] = 'Reply-To: ' . $email;
                        $headers[] = 'Content-Type: text/html; charset='.$charset.'';
                        $admin_email = preg_replace('/\s+/', '', $to);
                        $admin_emails = explode(",", $admin_email);
                        foreach ($admin_emails as $ad_email) {
                          wp_mail($ad_email, $subject, $body, $headers);
                        }
                      }
                      if($is_popup_wc){
                        $body_re = $body_msgprefix.$datamsg;
                        $headers_re[] = 'From: ' . ucfirst(get_bloginfo('name')) . ' <' . $datareply . '>';
                        $headers_re[] = 'Reply-To: ' . $datareply;
                        $headers_re[] = 'Content-Type: text/html: charset='.$charset.'';
                        $headers_re[] = 'Bcc: '.$datareply ;
                        wp_mail($email, $subject, $body_re, $headers_re);
                      }
                      if(!empty($pdffile)){
                        echo json_encode( array( "status" => 1, "msg" => $datasuccess, "file"  => wp_get_attachment_url($pdffile) ) );
                      }else{
                          echo json_encode( array( "status" => 1, "msg" => $dataempty, "file"  => '' ) );
                      }
              }else{
                  echo json_encode( array( "status" => 2, "msg" => $dataerror ) );
              }
              die();
          }
    public function rhr_download_pdf(){
        global $wpdb;
        $is_popup_wc = rhr_options( 'is_popup_wc', '' );
        $nonce = sanitize_text_field( $_POST['nonce'] );
        if ( !wp_verify_nonce( $nonce, 'rhr-nonce' ) ) {
            die( '-1' );
        }
        $name = sanitize_text_field( $_POST['name'] );
        $email = sanitize_text_field( $_POST['email'] );
        $company = sanitize_text_field( $_POST['company'] );
        $pdffile = sanitize_text_field( $_POST['pdffile'] );
        $datato = sanitize_text_field( $_POST['datato'] );
        $datareply = sanitize_text_field( $_POST['datareply'] );
        $datamsg = sanitize_text_field( $_POST['datamsg'] );
        $msgprefix = sanitize_text_field( $_POST['msgprefix'] );
        $datasuccess = sanitize_text_field( $_POST['datasuccess'] );
        $dataempty = sanitize_text_field( $_POST['dataempty'] );
        $dataerror = sanitize_text_field( $_POST['dataerror'] );
        $datasubject = sanitize_text_field( $_POST['datasubject'] );
        $to =  isset($datato) && !empty($datato) ? $datato : null;
        $subject = $datasubject;
        $charset = 'utf-8';

        $body_msgprefix = $msgprefix;
        if(!empty($email) && is_email($email)){
          $body = '<!doctype html>
          <html>
          <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <style>
              body {
               background-color: #f6f6f6;
               font-family: sans-serif;
               -webkit-font-smoothing: antialiased;
               font-size: 14px;
               line-height: 1.4;
               margin: 0;
               padding: 0;
               -ms-text-size-adjust: 100%;
               -webkit-text-size-adjust: 100%;
             }
             table {
               border-collapse: separate;
               mso-table-lspace: 0pt;
               mso-table-rspace: 0pt;
               width: 100%;
             }
             table td {
               font-family: sans-serif;
               font-size: 14px;
               vertical-align: top;
             }

             table td.emailhedpadding{background: #EAF2FA;padding-left:10px}
             table td.emailvalpadding{padding:0 30px}
             table td.emailvalpadding a{text-decoration: none;color: #000000;}

                   .body {
                     background-color: #f6f6f6;
                     width: 100%;
                   }

                   .container {
                     display: block;
                     margin: 0 auto !important;
                     padding: 10px;
                     width: 70%;
                   }

                   .content {
                     box-sizing: border-box;
                     display: block;
                     margin: 0 auto;
                     width: 100%;
                     padding: 10px;
                   }
                   .main {
                     background: #fff;
                     border-radius: 3px;
                     width: 100%;
                   }
                   .wrapper {
                     box-sizing: border-box;
                     padding: 20px;
                   }
                   .footer {
                     clear: both;
                     padding-top: 10px;
                     text-align: center;
                     width: 100%;
                   }
                   .footer td,
                   .footer p,
                   .footer span,
                   .footer a {
                     color: #999999;
                     font-size: 12px;
                     text-align: center;
                   }
                   td{padding: 6px 0}
                   hr {
                     border: 0;
                     border-bottom: 1px solid #f6f6f6;
                     margin: 20px 0;
                   }
                   @media only screen and (max-width: 620px) {
                     table[class=body] .content {
                       padding: 0 !important;
                     }
                     table[class=body] .container {
                       padding: 0 !important;
                       width: 100% !important;
                     }
                     table[class=body] .main {
                       border-left-width: 0 !important;
                       border-radius: 0 !important;
                       border-right-width: 0 !important;
                     }
                   }
                 </style>
               </head>
               <body class="">
                <table border="0" cellpadding="0" cellspacing="0" class="body">
                  <tr>
                   <td>&nbsp;</td>
                   <td class="container">
                    <div class="content">
                      <table class="main">
                        <tr>
                          <td class="wrapper">
                            <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                    <td class="emailhedpadding"><strong>Name</strong></td>
                                  </tr>
                            <tr>
                                <td class="emailvalpadding">'.$name.'</td>
                              </tr>
                              <tr>
                                    <td class="emailhedpadding"><strong>Email</strong></td>
                                  </tr>
                              <tr>
                                <td class="emailvalpadding">'.$email.'</td>
                              </tr>
                              <tr>
                                    <td class="emailhedpadding"><strong>Company</strong></td>
                                  </tr>
                              <tr>
                                <td class="emailvalpadding">'.$company.'</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                     </table>
                     </div>
                     </td>
                     <td>&nbsp;</td>
                     </tr>
                     </table>
                     </body>
                     </html>';


            if(!empty($to)){
              $headers[] = 'From: ' . ucfirst(get_bloginfo('name')) . ' <' . $datareply . '>';
              $headers[] = 'Reply-To: ' . $email;
              $headers[] = 'Content-Type: text/html: charset='.$charset.'';
              $admin_email = preg_replace('/\s+/', '', $to);
              $admin_emails = explode(",", $admin_email);
              foreach ($admin_emails as $ad_email) {
                wp_mail($ad_email, $subject, $body, $headers);
              }
            }
            if($is_popup_wc){
              $body_re = $body_msgprefix.$datamsg;
              $headers_re[] = 'From: ' . ucfirst(get_bloginfo('name')) . ' <' . $datareply . '>';
              $headers_re[] = 'Reply-To: ' . $datareply;
              $headers_re[] = 'Content-Type: text/html: charset='.$charset.'';
              $headers_re[] = 'Bcc: '.$datareply ;
              wp_mail($email, $subject, $body_re, $headers_re);
            }
            if(!empty($pdffile)){
              echo json_encode( array( "status" => 1, "msg" => $datasuccess, "file"  => wp_get_attachment_url($pdffile) ) );
            }else{
                echo json_encode( array( "status" => 1, "msg" => $dataempty, "file"  => '' ) );
            }
        }else{
            echo json_encode( array( "status" => 2, "msg" => $dataerror ) );
        }
        die();
    }
    public function rhr_contact_message(){

      $nonce = sanitize_text_field( $_POST['nonce'] );
      if ( !wp_verify_nonce( $nonce, 'rhr-nonce' ) ) {
          die( '-1' );
      }
      $contact_to_email  = rhr_options( 'contact_to_email', '' );
      $contact_to_from  = rhr_options( 'contact_to_from', '' );
      $contact_to_from_current  = isset($contact_to_from) && !empty($contact_to_from) ? $contact_to_from : get_option('admin_email');
      $contact_subject  = rhr_options( 'contact_subject', '' );
      $contact_success_msg  = rhr_options( 'contact_success_msg', '' );
      $contact_error_msg  = rhr_options( 'contact_error_msg', '' );

      $name = sanitize_text_field( $_POST['name'] );
      $email = sanitize_text_field( $_POST['email'] );
      $company = sanitize_text_field( $_POST['company'] );
      $phone = sanitize_text_field( $_POST['phone'] );
      $country = sanitize_text_field( $_POST['country'] );
      $jobtitle = sanitize_text_field( $_POST['jobtitle'] );
      $message = sanitize_text_field( $_POST['message'] );
      $captcha = sanitize_text_field( $_POST['captcha'] );
      $secret = sanitize_text_field( $_POST['secret'] );
      $secretKey = $secret;
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$captcha);
      $responseData = json_decode($verifyResponse);

      $to =  isset($contact_to_email) && !empty($contact_to_email) ? $contact_to_email : get_option('admin_email');
      $subject =  isset($contact_subject) && !empty($contact_subject) ? $contact_subject : 'Get In Touch';
      $charset = 'utf-8';
      if ($responseData->success==true) {
      if(!empty($email) && is_email($email)){
          $contact_phone = '';
          $contact_country = '';
          if(!empty($phone)){
            $contact_phone = '
              <tr>
              <td class="emailhedpadding"><strong>Phone</strong></td>
              </tr>
              <tr>
                <td class="emailvalpadding">'.$phone.'</td>
              </tr>';
          }
          if(!empty($country)){
            $contact_country = '
              <tr>
              <td class="emailhedpadding"><strong>Country</strong></td>
              </tr>
              <tr>
                <td class="emailvalpadding">'.$country.'</td>
              </tr>';
          }

              $body = '<!doctype html>
              <html>
              <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <style>
                  body {
                  background-color: #f6f6f6;
                  font-family: sans-serif;
                  -webkit-font-smoothing: antialiased;
                  font-size: 14px;
                  line-height: 1.4;
                  margin: 0;
                  padding: 0;
                  -ms-text-size-adjust: 100%;
                  -webkit-text-size-adjust: 100%;
                }
                table {
                  border-collapse: separate;
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
                  width: 100%;
                }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top;
                }
                table td.emailhedpadding{background: #EAF2FA;padding-left:10px}
                table td.emailvalpadding{padding:0 30px}
                table td.emailvalpadding a{text-decoration: none;color: #000000;}

                      .body {
                        background-color: #f6f6f6;
                        width: 100%;
                      }

                      .container {
                        display: block;
                        margin: 0 auto !important;
                        padding: 10px;
                        width: 70%;
                      }

                      .content {
                        box-sizing: border-box;
                        display: block;
                        margin: 0 auto;
                        width: 100%;
                        padding: 10px;
                      }
                      .main {
                        background: #fff;
                        border-radius: 3px;
                        width: 100%;
                      }
                      .wrapper {
                        box-sizing: border-box;
                        padding: 20px;
                      }
                      .footer {
                        clear: both;
                        padding-top: 10px;
                        text-align: center;
                        width: 100%;
                      }
                      .footer td,
                      .footer p,
                      .footer span,
                      .footer a {
                        color: #999999;
                        font-size: 12px;
                        text-align: center;
                      }
                      td{padding: 6px 0}
                      hr {
                        border: 0;
                        border-bottom: 1px solid #f6f6f6;
                        margin: 20px 0;
                      }
                      @media only screen and (max-width: 620px) {
                        table[class=body] .content {
                          padding: 0 !important;
                        }
                        table[class=body] .container {
                          padding: 0 !important;
                          width: 100% !important;
                        }
                        table[class=body] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;
                        }
                      }
                    </style>
                  </head>
                  <body class="">
                    <table border="0" cellpadding="0" cellspacing="0" class="body">
                      <tr>
                      <td>&nbsp;</td>
                      <td class="container">
                        <div class="content">
                          <table class="main">
                            <tr>
                              <td class="wrapper">
                                <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="emailhedpadding"><strong>Name</strong></td>
                                  </tr>
                                <tr>
                                    <td class="emailvalpadding">'.$name.'</td>
                                  </tr>
                                  <tr>
                                    <td class="emailhedpadding"><strong>Email</strong></td>
                                  </tr>
                                  <tr>
                                    <td class="emailvalpadding">'.$email.'</td>
                                  </tr>
                                  <tr>
                                    <td class="emailhedpadding"><strong>Company</strong></td>
                                  </tr>
                                  <tr>
                                    <td class="emailvalpadding">'.$company.'</td>
                                  </tr>
                                  <tr>
                                    <td class="emailhedpadding"><strong>Job Title</strong></td>
                                  </tr>
                                  <tr>
                                    <td class="emailvalpadding">'.$jobtitle.'</td>
                                  </tr>
                                  '.$contact_phone.'
                                  '.$contact_country.'
                                  <tr>
                                    <td class="emailhedpadding"><strong>Message</strong></td>
                                  </tr>
                                  <tr>
                                    <td class="emailvalpadding">'.$message.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                        </table>
                        </div>
                        </td>
                        <td>&nbsp;</td>
                        </tr>
                        </table>
                        </body>
                        </html>';
                    if(!empty($to)){
                      $headers[] = 'From: ' . ucfirst(get_bloginfo('name')) . ' <' . $contact_to_from_current . '>';
                      $headers[] = 'Reply-To: ' . $email;
                      $headers[] = 'Content-Type: text/html; charset='.$charset.'';
                      $admin_email = preg_replace('/\s+/', '', $to);
                      $admin_emails = explode(",", $admin_email);
                      foreach ($admin_emails as $ad_email) {
                        $send_email = wp_mail($ad_email, $subject, $body, $headers);
                      }
                    }
                    if($send_email){
                      echo json_encode( array( "status" => 1, "msg" => $contact_success_msg ) );
                    }else{
                        echo json_encode( array( "status" => 1, "msg" => $contact_error_msg ) );
                    }
            }else{
                echo json_encode( array( "status" => 2, "msg" => $dataerror ) );
            }
          }else{
            echo json_encode( array( "status" => 2, "msg" => 'Robot verification failed, please try again.' ) );
          }
            die();
    }
}
new rhr_extra;
