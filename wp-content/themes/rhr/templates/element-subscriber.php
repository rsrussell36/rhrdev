<?php
$global_mailchimp_api    = rhr_options( 'global_mailchimp_api', '' );
$ue_mailchimp_api    = rhr_options( 'ue_mailchimp_api', '' );
$uk_mailchimp_api    = rhr_options( 'uk_mailchimp_api', '' );

$newslater_code = rhr_get_country_code();
if($newslater_code->geoplugin_countryCode == 'GB'): ?>
      <div class="group g-full footer-subscriber">
        <span class="item-bigger"><?php echo html_entity_decode('Subscribe to Our<br>Newsletter'); ?></span>
        <form class="form f-margintT newslatter uk-newslater" method="post" data-api="<?php echo $uk_mailchimp_api; ?>">
            <div class="input">
              <input type="email" class="currect_email" name="EMAIL" placeholder="Email Address" arial-label="Email Address">
            </div>
            <button class="button b-white footer-subscribe-newsletter" data-cursor="scale" type="submit">
                <div class="arrow svg"></div>
            </button>
            <p class="mchimp-errmessage" style="display: none; margin-top:10px;"></p>
            <p class="mchimp-sucmessage" style="display: none; margin-top:10px;"></p>
          </form>
      </div>
      <?php else: ?>
        <?php if( $newslater_code->geoplugin_continentCode == 'EU' ) : ?>
          <div class="group g-full footer-subscriber">
        <span class="item-bigger"><?php echo html_entity_decode('Subscribe to Our<br>Newsletter'); ?></span>
        <form class="form f-margintT newslatter eu-newslater" method="post" data-api="<?php echo $ue_mailchimp_api; ?>">
            <div class="input">
              <input type="email" class="currect_email" name="EMAIL" placeholder="Email Address" arial-label="Email Address">
            </div>
            <button class="button b-white footer-subscribe-newsletter" data-cursor="scale" type="submit">
                <div class="arrow svg"></div>
            </button>
            <p class="mchimp-errmessage" style="display: none; margin-top:10px;"></p>
            <p class="mchimp-sucmessage" style="display: none; margin-top:10px;"></p>
          </form>
      </div>
          <?php else: ?>
        <div class="group g-full footer-subscriber">
        <span class="item-bigger"><?php echo html_entity_decode('Subscribe to Our<br>Newsletter'); ?></span>
        <form class="form f-margintT newslatter global-newslater" method="post" data-api="<?php echo $global_mailchimp_api; ?>">
            <div class="input">
              <input type="email" class="currect_email" name="EMAIL" placeholder="Email Address" arial-label="Email Address">
            </div>
            <button class="button b-white footer-subscribe-newsletter" data-cursor="scale" type="submit">
                <div class="arrow svg"></div>
            </button>
            <p class="mchimp-errmessage" style="display: none; margin-top:10px;"></p>
            <p class="mchimp-sucmessage" style="display: none; margin-top:10px;"></p>
          </form>
      </div>
            <?php endif; ?>
      <?php endif; ?>
