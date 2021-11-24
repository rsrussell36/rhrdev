<div class="dashboard-heading dashboard-flex">
  <div class="dashboard-heading-left-content dashboard-flex mr-26">
      <div class="dashboard-heading-icon">
        <img class="admin-light-icon" src="<?php echo esc_url(CREST_IMAGE. 'elements.svg'); ?>" alt="Elements">
      </div>
      <div class="dashboard-heading-text">
        <h3 class="title"><?php echo esc_html__('Elements', 'rhr'); ?></h3>
      </div>
  </div>
  <div class="dashboard-heading-right-content">
    <button class="dashboard-button save_elements" id="save_elements" data-layout="elements"><?php echo esc_html__('SAVE SETTINGS', 'rhr'); ?><span class="loading-ring"></span></button>

</div>
</div>
<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('rhr_elements_nonce'); ?>" />
<form class="elements_form" action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>" method="post" id="elements_form" enctype="multipart/form-data" encoding="multipart/form-data">
    <!-- Elements Header-->
    <div class="dashboard-widget-search-filter">
        <div class="dashboard-filter dashboard-flex">
            <div class="dashboard-enable">
                <label class="panel-widget-head dashboard-widget-check-all _disabled_remove">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.532" height="20.533" viewBox="0 0 23.532 20.533">
                            <path d="M6.9,15.626,0,8.73,2.228,6.5,6.9,11.064,17.729,0,20,2.388Z" transform="translate(4.307) rotate(16)"></path>
                                </svg>
                    </span>
                    <input type="checkbox" id="widget_check_all"> Enable All
                </label>
            </div>
        </div>
        <div class="dashboard-search">
            <span class="search-group-addon">
                <span class="dashicons dashicons-search"></span>
            </span>
            <input id="search" type="text" name="" value="" placeholder="<?php esc_attr_e( 'Search', 'rhr' ); ?>">
        </div>
    </div>
    <div id="no-result" class="section-info">
        <div class="controls">
          <div class="of-info">
            <h3><?php esc_html_e( 'No Data Found!', 'rhr' ); ?></h3>
          </div>
        </div>
    </div>
    <!-- Elements -->
    <div class="dashboard-widget-list">
      <?php $elements = \KC_GLOBAL\Integration::rhr__widgets_map(); 
      foreach ($elements as $_key => $element) :
        $_inactive          = _get_inactive();
        $checked            = ''; 
        
        if (!in_array($_key, $_inactive)) {
            $checked = 'checked="checked"';
        }
          
      ?>
      <div class="dashboard-col type-<?php echo $element['type'];?> has-animated">
        <div class="dashboard-widget-list-wrap">
           <div class="dashboard-widget-list-inner">
              <span class="widget-icon">
                 <i class="dashboard-elements--icon <?php echo $element['icon'] ?>"></i>
              </span>
              <span class="search_value"><?php echo esc_html__($element['title'], 'rhr');?></span>
           </div>
           <div class="on-off-toggle button-switch">
                <input class="on-off-toggle__input _disabled_remove" name="elements[]" value="<?php echo esc_attr($_key); ?>" type="checkbox" <?php echo $checked; ?> id="<?php echo esc_attr($_key); ?>" data-type="free">
                <label for="<?php echo esc_attr($_key); ?>" class="on-off-toggle__slider"></label>
            </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
</form>
<div id="back-to-top">
 <button class="dashboard-button save_elements" id="save_elements" data-layout="elements"><?php echo esc_html__('SAVE SETTINGS', 'rhr'); ?><span class="loading-ring"></span></button>
</div>