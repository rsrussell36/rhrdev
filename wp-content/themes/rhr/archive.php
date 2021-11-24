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
                            <h1 class="title"> <?php echo esc_html__('Posts for: ' . single_cat_title('',false), 'rhr'); ?></h1>
                            <div class="s-status">We found <span><?php echo $wp_query->found_posts; ?></span> results for "<span><?php echo single_cat_title('',false); ?></span>"</div>
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

        <div class="pages-content pc-paddingTop rhr-archive">
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

                            $posttags = get_term_by( 'name', single_tag_title( '',false ), 'events-tag' );
                            if( is_category() ) : // Archive Category

                                $category_obj = get_term_by( 'name', single_cat_title('',false), 'category' );
                                $slug = $category_obj->slug;

                                $category = array(
                                    'category_name' => $slug
                                );

                                $args = array_merge( $args, $category );

                            elseif( is_author() ) : // Archive Author

                                global $post;
                                $author_id = $post->post_author;

                                $author = array(
                                    'author' => $author_id
                                );

                                $args = array_merge( $args, $author );

                            elseif( is_tag() ) : // Archive Tag

                                $posttags = get_term_by( 'name', single_tag_title( '',false ), 'post_tag' );
                                $slug = $posttags->slug;

                                $tag = array(
                                    'tag' => $slug
                                );

                                $args = array_merge( $args, $tag );

                            elseif( is_day() ) : // Archive Day

                                $day = array(
                                    'day'      => get_the_time( 'j' ),
                                    'monthnum' => get_the_time( 'm' ),
                                    'year'     => get_the_time( 'Y' )
                                );

                                $args = array_merge( $args, $day );

                             elseif( is_month() ) : // Archive Month

                                $month = array(
                                    'monthnum' => get_the_time( 'm' ),
                                    'year'     => get_the_time( 'Y' )
                                );
                                $args = array_merge( $args, $month );

                            elseif( is_year() ) : // Archive Year

                                $year = array(
                                    'year' => get_the_time('Y')
                                );

                                $args = array_merge( $args, $year );

                            elseif( is_search() ) : // Archive Search

                                $search = array(
                                    's' => get_search_query()
                                );

                                $args = array_merge( $args, $search );

                            endif;

                            //echo rhr_search_pagination( $args, $values );
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
