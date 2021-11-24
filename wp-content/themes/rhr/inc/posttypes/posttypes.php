<?php

    $slug_client = 'clients';
    $slug_client_cat = 'client-category';

	$client_arr = array(
		'menu_icon' =>'dashicons-groups',
		'supports' => array( 'title', 'thumbnail', 'author'),
		'rewrite' 	=> array(
			'slug' => $slug_client
		),
		'has_archive' => false
	);

	$client_arr = apply_filters( 'rhr_clients_post_type_args', $client_arr );
	$client_tax_arr = array(
		"Categories"   => array(
			'singular_name' => 'Category',
			'query_var' => 'client_cat',
			'rewrite' => array(
				'slug' => $slug_client_cat
			)
		)
	);

	$client = new RHR_Post_Type('clients', 'Clients', 'Clients', $client_arr);
	$client->taxonomies('clients', $client_tax_arr);

//adding column to client posts type
add_filter( 'manage_edit-rhr_clients_columns', 'my_edit_rhr_clients_columns' ) ;

function my_edit_rhr_clients_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__('All Clients', 'rhr' ),
		'id' => esc_html__('Id', 'rhr' ),
		'type' => esc_html__('Categories', 'rhr' ),
		'thumb' => esc_html__('Image', 'rhr' ),
		'date' => esc_html__('Created', 'rhr' )
		);
	return $columns;
}

//adding column to client posts type
add_action( 'manage_rhr_clients_posts_custom_column', 'my_manage_client_columns', 10, 2 );
function my_manage_client_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		case 'id' :
			printf( $post_id );
		break;
		case 'thumb' :

			if ( has_post_thumbnail() ) {
				echo '<img width="80" height="80" src="' . get_the_post_thumbnail_url(). '" />';
			}
			else {
				printf( '-');
			}
		break;
		case 'type' :
			$categories = get_the_terms( $post_id, 'rhr_categories' );
			if(!empty($categories)){
				foreach( $categories as $category ) {
					printf(  $category->name . '<br />');
				}
			}
		break;

		default :
		break;
	}
}
	$slug_ebook = 'ebooks';
    $slug_ebook_cat = 'ebook-category';
	$slug_ebook_tag = 'ebook-tag';

	$ebook_arr = array(
		'menu_icon' =>'dashicons-pdf',
		'supports' => array( 'title', 'thumbnail', 'author', 'editor', 'excerpt'),
		'rewrite' 	=> array(
			'slug' => $slug_ebook
		),
		'has_archive' => false
	);

	$ebook_arr = apply_filters( 'rhr_ebooks_post_type_args', $ebook_arr );
	$ebook_tax_arr = array(
		"eBook Categories"   => array(
			'singular_name' => 'Category',
			'query_var' => 'ebook_cat',
			'rewrite' => array(
				'slug' => $slug_ebook_cat
			)
		)
	);
	$eboog_tag_arr = array(
		"eBook Tags"   => array(
			'singular_name' => 'Tag',
			'query_var' => 'ebook_tag',
			'rewrite' => array(
				'slug' => $slug_ebook_tag
			)
		)
	);

	$ebook = new RHR_Post_Type('ebooks', 'Ebooks', 'Ebooks', $ebook_arr);
	$ebook->taxonomies('ebooks', $ebook_tax_arr);
	$ebook->taxonomies('ebooks', $eboog_tag_arr);
	add_filter( 'manage_edit-rhr_ebooks_columns', 'my_edit_rhr_ebooks_columns' ) ;

function my_edit_rhr_ebooks_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__('All eBook', 'rhr' ),
		'id' => esc_html__('Id', 'rhr' ),
		'type' => esc_html__('Categories', 'rhr' ),
		'rhr-tags' => esc_html__('Tags', 'rhr' ),
		'thumb' => esc_html__('Image', 'rhr' ),
		'date' => esc_html__('Created', 'rhr' )
		);
	return $columns;
}

//adding column to ebook posts type
add_action( 'manage_rhr_ebooks_posts_custom_column', 'my_manage_ebook_columns', 10, 2 );
function my_manage_ebook_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		case 'id' :
			printf( $post_id );
		break;
		case 'thumb' :

			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail( $post_id, array(80, 80) );
			}
			else {
				printf( '-');
			}
		break;
		case 'type' :
			$categories = get_the_terms( $post_id, 'rhr_ebook_categories' );
			if(!empty($categories)){
				foreach( $categories as $category ) {
					printf(  $category->name . '<br />');
				}
			}else{
				printf( '-');
			}
		break;
		case 'rhr-tags' :
			$tags = get_the_terms( $post_id, 'rhr_ebook_tags' );
			if(!empty($tags)){
				foreach( $tags as $tag ) {
					printf(  $tag->name . '<br />');
				}
			}else{
				printf( '-');
			}
		break;

		default :
		break;
	}
}
$slug_event = 'events';
    $slug_event_cat = 'event-category';
	$slug_event_tag = 'event-tag';

	$event_arr = array(
		'menu_icon' =>'dashicons-calendar-alt',
		'supports' => array( 'title', 'thumbnail', 'author', 'editor', 'excerpt'),
		'rewrite' 	=> array(
			'slug' => $slug_event
		),
		'has_archive' => false
	);

	$event_arr = apply_filters( 'rhr_events_post_type_args', $event_arr );
	$event_tax_arr = array(
		"Event Categories"   => array(
			'singular_name' => 'Category',
			'query_var' => 'event_cat',
			'rewrite' => array(
				'slug' => $slug_event_cat
			)
		)
	);
	$events_tag_arr = array(
		"Event Tags"   => array(
			'singular_name' => 'Tag',
			'query_var' => 'event_tag',
			'rewrite' => array(
				'slug' => $slug_event_tag
			)
		)
	);

	$event = new RHR_Post_Type('events', 'Events', 'Events', $event_arr);
	$event->taxonomies('events', $event_tax_arr);
	$event->taxonomies('events', $events_tag_arr);
	add_filter( 'manage_edit-rhr_events_columns', 'my_edit_rhr_events_columns' ) ;

function my_edit_rhr_events_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__('All Event', 'rhr' ),
		'id' => esc_html__('Id', 'rhr' ),
		'type' => esc_html__('Categories', 'rhr' ),
		'rhr-tags' => esc_html__('Tags', 'rhr' ),
		'thumb' => esc_html__('Image', 'rhr' ),
		'date' => esc_html__('Created', 'rhr' )
		);
	return $columns;
}

//adding column to events posts type
add_action( 'manage_rhr_events_posts_custom_column', 'my_manage_event_columns', 10, 2 );
function my_manage_event_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		case 'id' :
			printf( $post_id );
		break;
		case 'thumb' :

			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail( $post_id, array(80, 80) );
			}
			else {
				printf( '-');
			}
		break;
		case 'type' :
			$categories = get_the_terms( $post_id, 'rhr_event_categories' );
			if(!empty($categories)){
				foreach( $categories as $category ) {
					printf(  $category->name . '<br />');
				}
			}else{
				printf( '-');
			}
		break;
		case 'rhr-tags' :
			$tags = get_the_terms( $post_id, 'rhr_event_tags' );
			if(!empty($tags)){
				foreach( $tags as $tag ) {
					printf(  $tag->name . '<br />');
				}
			}else{
				printf( '-');
			}
		break;

		default :
		break;
	}
}

$slug_news = 'news';
    $slug_news_cat = 'news-category';
    $slug_news_tag = 'news-tag';

    $news_arr = array(
        'menu_icon' =>'dashicons-media-spreadsheet',
        'supports' => array( 'title', 'thumbnail', 'author', 'editor', 'excerpt'),
        'rewrite'   => array(
            'slug' => $slug_news
        ),
        'has_archive' => false
    );

    $news_arr = apply_filters( 'rhr_news_post_type_args', $news_arr );
    $news_tax_arr = array(
        "News Categories"   => array(
            'singular_name' => 'Category',
            'query_var' => 'news_cat',
            'rewrite' => array(
                'slug' => $slug_news_cat
            )
        )
    );
    $news_tag_arr = array(
        "News Tags"   => array(
            'singular_name' => 'Tag',
            'query_var' => 'news_tag',
            'rewrite' => array(
                'slug' => $slug_news_tag
            )
        )
    );

    $news = new RHR_Post_Type('news', 'News', 'News', $news_arr);
    $news->taxonomies('news', $news_tax_arr);
    $news->taxonomies('news', $news_tag_arr);
    add_filter( 'manage_edit-rhr_news_columns', 'my_edit_rhr_news_columns' ) ;

function my_edit_rhr_news_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('All News', 'rhr' ),
        'id' => esc_html__('Id', 'rhr' ),
        'type' => esc_html__('Categories', 'rhr' ),
        'rhr-tags' => esc_html__('Tags', 'rhr' ),
        'thumb' => esc_html__('Image', 'rhr' ),
        'date' => esc_html__('Created', 'rhr' )
        );
    return $columns;
}

//adding column to news posts type
add_action( 'manage_rhr_news_posts_custom_column', 'my_manage_news_columns', 10, 2 );
function my_manage_news_columns( $column, $post_id ) {
    global $post;
    switch( $column ) {
        case 'id' :
            printf( $post_id );
        break;
        case 'thumb' :

            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $post_id, array(80, 80) );
            }
            else {
                printf( '-');
            }
        break;
        case 'type' :
            $categories = get_the_terms( $post_id, 'rhr_news_categories' );
            if(!empty($categories)){
                foreach( $categories as $category ) {
                    printf(  $category->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;
        case 'rhr-tags' :
            $tags = get_the_terms( $post_id, 'rhr_news_tags' );
            if(!empty($tags)){
                foreach( $tags as $tag ) {
                    printf(  $tag->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;

        default :
        break;
    }
}


$slug_research = 'research-studies';
    $slug_research_cat = 'research-category';
    $slug_research_tag = 'research-tag';

    $research_arr = array(
        'menu_icon' =>'dashicons-code-standards',
        'supports' => array( 'title', 'thumbnail', 'author', 'editor', 'excerpt'),
        'rewrite'   => array(
            'slug' => $slug_research
        ),
        'has_archive' => false
    );

    $research_arr = apply_filters( 'rhr_research_post_type_args', $research_arr );
    $research_tax_arr = array(
        "Research Categories"   => array(
            'singular_name' => 'Category',
            'query_var' => 'research_cat',
            'rewrite' => array(
                'slug' => $slug_research_cat
            )
        )
    );
    $research_tag_arr = array(
        "Research Tags"   => array(
            'singular_name' => 'Tag',
            'query_var' => 'research_tag',
            'rewrite' => array(
                'slug' => $slug_research_tag
            )
        )
    );

    $research = new RHR_Post_Type('research', 'Research', 'Research', $research_arr);
    $research->taxonomies('research', $research_tax_arr);
    $research->taxonomies('research', $research_tag_arr);
    add_filter( 'manage_edit-rhr_research_columns', 'my_edit_rhr_research_columns' ) ;

function my_edit_rhr_research_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('All research', 'rhr' ),
        'id' => esc_html__('Id', 'rhr' ),
        'type' => esc_html__('Categories', 'rhr' ),
        'rhr-tags' => esc_html__('Tags', 'rhr' ),
        'thumb' => esc_html__('Image', 'rhr' ),
        'date' => esc_html__('Created', 'rhr' )
        );
    return $columns;
}

//adding column to research posts type
add_action( 'manage_rhr_research_posts_custom_column', 'my_manage_research_columns', 10, 2 );
function my_manage_research_columns( $column, $post_id ) {
    global $post;
    switch( $column ) {
        case 'id' :
            printf( $post_id );
        break;
        case 'thumb' :

            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $post_id, array(80, 80) );
            }
            else {
                printf( '-');
            }
        break;
        case 'type' :
            $categories = get_the_terms( $post_id, 'rhr_research_categories' );
            if(!empty($categories)){
                foreach( $categories as $category ) {
                    printf(  $category->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;
        case 'rhr-tags' :
            $tags = get_the_terms( $post_id, 'rhr_research_tags' );
            if(!empty($tags)){
                foreach( $tags as $tag ) {
                    printf(  $tag->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;

        default :
        break;
    }
}


$slug_teams = 'profiles';
    $slug_teams_cat = 'profiles-category';
    $slug_teams_tag = 'profiles-tag';

    $teams_arr = array(
        'menu_icon' =>'dashicons-businessperson',
        'supports' => array( 'title', 'thumbnail', 'editor'),
        'rewrite'   => array(
            'slug' => $slug_teams
        ),
        'has_archive' => false
    );

    $teams_arr = apply_filters( 'rhr_teams_post_type_args', $teams_arr );
    $teams_tax_arr = array(
        "Teams Categories"   => array(
            'singular_name' => 'Category',
            'query_var' => 'teams_cat',
            'rewrite' => array(
                'slug' => $slug_teams_cat
            )
        )
    );

    $teams = new RHR_Post_Type('teams', 'Profiles', 'Profiles', $teams_arr);
    $teams->taxonomies('teams', $teams_tax_arr);
    add_filter( 'manage_edit-rhr_teams_columns', 'my_edit_rhr_teams_columns' ) ;

function my_edit_rhr_teams_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('All Profiles', 'rhr' ),
        'id' => esc_html__('Id', 'rhr' ),
        'type' => esc_html__('Categories', 'rhr' ),
        'thumb' => esc_html__('Image', 'rhr' ),
        'date' => esc_html__('Created', 'rhr' )
        );
    return $columns;
}

//adding column to teams posts type
add_action( 'manage_rhr_teams_posts_custom_column', 'my_manage_teams_columns', 10, 2 );
function my_manage_teams_columns( $column, $post_id ) {
    global $post;
    switch( $column ) {
        case 'id' :
            printf( $post_id );
        break;
        case 'thumb' :

            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $post_id, array(80, 80) );
            }
            else {
                printf( '-');
            }
        break;
        case 'type' :
            $categories = get_the_terms( $post_id, 'rhr_teams_categories' );
            if(!empty($categories)){
                foreach( $categories as $category ) {
                    printf(  $category->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;

        default :
        break;
    }
}
$slug_webinar = 'webinars-podcasts';
    $slug_webinar_cat = 'webinar-category';
    $slug_webinar_tag = 'webinar-tag';

    $webinar_arr = array(
        'menu_icon' =>'dashicons-money',
        'supports' => array( 'title', 'thumbnail', 'author', 'editor', 'excerpt'),
        'rewrite'   => array(
            'slug' => $slug_webinar
        ),
        'has_archive' => false
    );

    $webinar_arr = apply_filters( 'rhr_webinar_post_type_args', $webinar_arr );
    $webinar_tax_arr = array(
        "Webinar Categories"   => array(
            'singular_name' => 'Category',
            'query_var' => 'webinar_cat',
            'rewrite' => array(
                'slug' => $slug_webinar_cat
            )
        )
    );
    $webinar_tag_arr = array(
        "Webinar Tags"   => array(
            'singular_name' => 'Tag',
            'query_var' => 'webinar_tag',
            'rewrite' => array(
                'slug' => $slug_webinar_tag
            )
        )
    );

    $webinar = new RHR_Post_Type('webinar', 'Webinar', 'Webinar', $webinar_arr);
    $webinar->taxonomies('webinar', $webinar_tax_arr);
    $webinar->taxonomies('webinar', $webinar_tag_arr);
    add_filter( 'manage_edit-rhr_webinar_columns', 'my_edit_rhr_webinar_columns' ) ;

function my_edit_rhr_webinar_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('All Webinar', 'rhr' ),
        'id' => esc_html__('Id', 'rhr' ),
        'type' => esc_html__('Categories', 'rhr' ),
        'rhr-tags' => esc_html__('Tags', 'rhr' ),
        'thumb' => esc_html__('Image', 'rhr' ),
        'date' => esc_html__('Created', 'rhr' )
        );
    return $columns;
}

//adding column to webinar posts type
add_action( 'manage_rhr_webinar_posts_custom_column', 'my_manage_webinar_columns', 10, 2 );
function my_manage_webinar_columns( $column, $post_id ) {
    global $post;
    switch( $column ) {
        case 'id' :
            printf( $post_id );
        break;
        case 'thumb' :

            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $post_id, array(80, 80) );
            }
            else {
                printf( '-');
            }
        break;
        case 'type' :
            $categories = get_the_terms( $post_id, 'rhr_webinar_categories' );
            if(!empty($categories)){
                foreach( $categories as $category ) {
                    printf(  $category->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;
        case 'rhr-tags' :
            $tags = get_the_terms( $post_id, 'rhr_webinar_tags' );
            if(!empty($tags)){
                foreach( $tags as $tag ) {
                    printf(  $tag->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;

        default :
        break;
    }
}


$slug_client_cases = 'case-studies';
    $slug_client_cases_cat = 'client-cases-category';
    $slug_client_cases_tag = 'client-cases-tag';

    $client_cases_arr = array(
        'menu_icon' =>'dashicons-admin-page',
        'supports' => array( 'title', 'thumbnail', 'author'),
        'rewrite'   => array(
            'slug' => $slug_client_cases
        ),
        'has_archive' => false
    );

    $client_cases_arr = apply_filters( 'rhr_client_cases_post_type_args', $client_cases_arr );
    $client_cases_tax_arr = array(
        "Client Cases Categories"   => array(
            'singular_name' => 'Category',
            'query_var' => 'client_cases_cat',
            'rewrite' => array(
                'slug' => $slug_client_cases_cat
            )
        )
    );
    $client_tag_arr = array(
        "Client Cases Tags"   => array(
            'singular_name' => 'Tag',
            'query_var' => 'client_cases_tag',
            'rewrite' => array(
                'slug' => $slug_client_cases_tag
            )
        )
    );

    $client_cases = new RHR_Post_Type('client_cases', 'Client Cases', 'Client Cases', $client_cases_arr);
    $client_cases->taxonomies('client_cases', $client_cases_tax_arr);
    $client_cases->taxonomies('client_cases', $client_tag_arr);
    add_filter( 'manage_edit-rhr_client_cases_columns', 'my_edit_rhr_client_cases_columns' ) ;

function my_edit_rhr_client_cases_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('All Client Cases', 'rhr' ),
        'id' => esc_html__('Id', 'rhr' ),
        'type' => esc_html__('Categories', 'rhr' ),
        'rhr-tags' => esc_html__('Tags', 'rhr' ),
        'thumb' => esc_html__('Image', 'rhr' ),
        'date' => esc_html__('Created', 'rhr' )
        );
    return $columns;
}

//adding column to client_cases posts type
add_action( 'manage_rhr_client_cases_posts_custom_column', 'my_manage_client_cases_columns', 10, 2 );
function my_manage_client_cases_columns( $column, $post_id ) {
    global $post;
    switch( $column ) {
        case 'id' :
            printf( $post_id );
        break;
        case 'thumb' :

            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $post_id, array(80, 80) );
            }
            else {
                printf( '-');
            }
        break;
        case 'type' :
            $categories = get_the_terms( $post_id, 'rhr_client_cases_categories' );
            if(!empty($categories)){
                foreach( $categories as $category ) {
                    printf(  $category->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;
        case 'rhr-tags' :
            $tags = get_the_terms( $post_id, 'rhr_client_cases_tags' );
            if(!empty($tags)){
                foreach( $tags as $tag ) {
                    printf(  $tag->name . '<br />');
                }
            }else{
                printf( '-');
            }
        break;

        default :
        break;
    }
}
