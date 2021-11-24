<?php get_header();
global $wp_query;
$h_btn_text = rhr_options('h_btn_text', 'Get In Touch');
$h_btn_url = rhr_options('h_btn_url', home_url( '/' ));
?>
<div class="main-content pages">
    <section>
        <div class="pages-content pc-noPadidng">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-10">
                        <div class="search">
                            <h1 class="title"><?php echo esc_html__("Search", 'rhr'); ?></h1>
                            <div class="s-status">We found <span><?php echo $wp_query->found_posts; ?></span> results for "<span><?php echo get_search_query(); ?></span>"</div>
                            <form method="get" action="/" class="rhr-search-relative">
                                <div class="row">
                                <input type="text" value="" name="s" class="s" placeholder="<?php echo esc_html('Type here...');?>" />
                                    <button class="s-icon svg" type="submit"></button>
                                    <div class="s-close bt-search-close svg" data-cursor="scale"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content pc-paddingTop">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-3">
                        <div class="menu-navigate mn-bigger">
                            <div class="items">
                                <div class="paragraph p-gray p-small">Not finding what<br>you’re looking for?</div>
                                <a href="<?php echo esc_url($h_btn_url); ?>" class="button" data-cursor="scale">
                                    <span><?php echo esc_html__($h_btn_text, 'rhr'); ?></span>
                                    <div class="arrow svg"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-7">
                    <?php if (have_posts()) : ?>
                        <div class="search-list">
                            <?php while (have_posts()) : the_post(); ?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="s-item" data-cursor="scale">
                            <div class="s-title"><?php echo get_the_title(); ?></div>
                            <div class="paragraph p-gray"><?php echo wp_trim_words( do_shortcode( get_the_content() ), 20, '...' ); ?></div>
                            </a>
                            <?php endwhile;?>
                        </div>
                        <div class="search-pagination-margin">
                            <?php
                            $values = array();
                            $args = array(
                                'posts_per_page'      => get_option( 'posts_per_page' ),
                                'ignore_sticky_posts' => 1
                            );
                            $search = array(
                                's' => get_search_query()
                            );

                            $args = array_merge( $args, $search );

                            echo rhr_search_pagination( $args, $values );
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<?php get_footer(); ?>
