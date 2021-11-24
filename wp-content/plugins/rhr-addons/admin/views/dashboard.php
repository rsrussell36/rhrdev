<div id="wrapper" class="dashboard-wrapper">
    <div class="dashboard-container">
        <div class="dashboard-sidebar">
            <div class="dashboard-menu">
                <div class="dashboard-item active"><span class="light"></span><span><?php echo esc_html__('Dashboard', 'rhr'); ?></span></div>
                <div class="dashboard-item"><span class="light"></span><span><?php echo esc_html__('Elements', 'rhr'); ?></span></div>
                <div class="dashboard-item"><span class="light"></span><span><?php echo esc_html__('Performance', 'rhr'); ?></span></div>
            </div>
        </div>
        <div class="dashboard-content-area">
            <div class="dashboard-content">
                <div class="content-item active">
                    <div class="dashboard-heading dashboard-flex">
                      <div class="dashboard-heading-left-content dashboard-flex mr-26">
                          <div class="dashboard-heading-icon">
                            <img class="admin-light-icon" src="<?php echo esc_url(CREST_IMAGE. 'elements.svg'); ?>" alt="Over View">
                          </div>
                          <div class="dashboard-heading-text">
                            <h3 class="title"><?php echo esc_html__('Overview', 'rhr'); ?></h3>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="content-item search-item">
                    <?php include 'elements.php'; ?>
                </div>
                <div class="content-item search-item">
                    <?php include 'performance.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'message.php';?>