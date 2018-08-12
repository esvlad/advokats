<?php
/**
 * Адвокаты functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Адвокаты
 */

require get_template_directory() . '/inc/EMT.php';

function my_typograf($text){
	$typograf = new EMTypograph();
    $typograf->set_text($text);
    $typograf->setup(array(
		'Text.paragraphs' => 'off',
		'Text.breakline' => 'off',
		'OptAlign.oa_oquote' => 'off',
		'OptAlign.oa_obracket_coma' => 'off',
	));
    $result = $typograf->apply(); //$result = $text;

    return $result;
}

if ( ! function_exists( 'advokats_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function advokats_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Адвокаты, use a find and replace
		 * to change 'advokats' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'advokats', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'advokats' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'advokats_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'advokats_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function advokats_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'advokats_content_width', 640 );
}
add_action( 'after_setup_theme', 'advokats_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function advokats_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'advokats' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'advokats' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'advokats_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function advokats_scripts() {
	wp_enqueue_style( 'advokats-style', get_stylesheet_uri() );

	wp_enqueue_script( 'advokats-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'advokats-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'advokats_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function my_active_link($link, $uri){
	if($link == site_url() . $uri){
		echo ' class="active"'; //active
	} else {
		return false;
	}
}


if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'command_big', 564, 793, true ); // 300 в ширину и без ограничения в высоту
	add_image_size( 'command_preview', 336, 437, true ); // Кадрирование изображения
	add_image_size( 'command_small', 67, 67 );
	add_image_size( 'clients_logo', 206, 90);
}

add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'command_big' => 'Фото сотрудника',
		'command_preview' => 'Превью сотрудника',
		'command_small' => 'Маленькая картинка',
	) );
}

#[adv_btn data-text="Шакирьянову Ренату Миргазияновичу"]
function shortcode_adv_btn($atts){
	$html = '<div class="btn btn_commands shortcode" data-type="modal" data-modal-id="1" data-modal-title="'. $atts['data-text'] .'">Задать вопрос</div>';
	$html .= '<div class="clears"></div>';

	return $html;
}

#[adv_courses ids="56,57,58,59,60,61,55"]
function shortcode_adv_courses($atts){
	$ids = explode(',', $atts['ids']);

	$html = '<div class="curses_items">';

	foreach($ids as $key => $id){
		$meta = wp_get_attachment_metadata($id, true);
		$big_class = ($meta['width'] > $meta['height']) ? ' big' : null;
		$outer_class = ($key >= 7) ? ' none' : null;

		$html .= '<div class="curses_item' . $big_class . $outer_class . '">';
		$html .= '<img src="'. wp_get_attachment_image_url($id, 'large'). '" alt="" data-width="'.$meta['width'].'" data-height="'.$meta['height'].'"/>';
		$html .= '<p>'. my_typograf(wp_get_attachment_caption($id)) .'</p>';
		$html .= '</div>';
	}

	$html .= '</div>';

	if(count($ids) > 7) $html .= '<div class="items_more items_more_90 curses_more"><span>Показать ещё</span></div>';

	return $html;
}

add_shortcode('adv_btn', 'shortcode_adv_btn');
add_shortcode('adv_courses', 'shortcode_adv_courses');

function preprint($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);

	if($count==»){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);

	if($count==»){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return '0';
	}

	return $count;
}

if( wp_doing_ajax() ){
	add_action('wp_ajax_add_form_st', 'adv_add_form_standart');
	add_action('wp_ajax_nopriv_add_form_st', 'adv_add_form_standart');

	function adv_add_form_standart(){
		$json = array();
		
		$json['post'] = $_POST;

		$html = '';
		$files = '';

		foreach($_POST['data'] as $data){
			switch ($data['name']) {
				case 'form_name':
					$title = $data['value'];
					break;
				case 'name':
					$html .= '<p><strong>Имя</strong> ' . $data['value'] . '</p>';
					break;
				case 'phone':
					$html .= '<p><strong>Телефон:</strong>' . $data['value'] . '</p>';
					break;
				case 'email':
					$html .= '<p><strong>E-mail:</strong>' . $data['value'] . '</p>';
					break;
				case 'text':
					$html .= '<p><strong>Текст сообщения:</strong> ' . $data['value'] . '</p>';
					break;
				case 'files':
					$files .= '<a href="' . $data['value'] . '" target="_blank">' . $data['value'] . '</a><br>';
					break;
				default : break;
			}
		}

		if($files != ''){
			$html .= '<p><strong>Прикрепенные файлы:</strong><br>' . $files . '</p>';
		}

		$json['html'] = $html;

		$post_data = array(
		  'post_title'    => 'Заявка - ' . $title,
		  'post_content'  => $html,
		  'post_status'   => 'Pending',
		  'post_author'   => 1,
		  'post_category' => array(44),
		);

		$post_id = wp_insert_post($post_data);

		if(isset($post_id) && $post_id > 0){
			$json['success'] = true;

			$message = '<p><b>Форма</b>: ' . $title . '</p>';
			$message .= $html;
			$message .= '<p>Результат обработки формы выможете посмотреть по этой <a href="' . admin_url() . 'post.php?post='.$post_id.'&action=edit">ссылке</a>.</p>';

			$mail_to = get_option('admin_email');
			
			$headers = array(
				'From: Адвокатская контора №1 <' . $mail_to . '>',
				'content-type: text/html',
			);

			$json['mail'] = wp_mail($mail_to, 'Новая заявка с сайта', $message, $headers);
		}

		wp_send_json($json);
	}

	add_action('wp_ajax_add_form_review', 'adv_add_form_review');
	add_action('wp_ajax_nopriv_add_form_review', 'adv_add_form_review');

	function adv_add_form_review(){
		$json = array();
		
		$json['post'] = $_POST;

		foreach($_POST['data'] as $data){
			switch ($data['name']) {
				case 'form_name':
					$form_title = $data['value'];
					break;
				case 'name':
					$title = $data['value'];
					break;
				case 'phone':
					$phone = $data['value'] ;
					break;
				case 'text':
					$text = '<p>' . $data['value'] . '</p>';
					$m_test = '<p style="margin: 3px 0;">' . $data['value'] . '</p>';
					break;
				default : break;
			}
		}

		$post_data = array(
		  'post_title'    => $title,
		  'post_content'  => $text,
		  'post_status'   => 'Pending',
		  'post_author'   => 1,
		  'post_category' => array(12),
		);

		$post_id = wp_insert_post($post_data);

		if(isset($post_id) && $post_id > 0){
			$json['success'] = true;

			add_post_meta($post_id, 're_call', $phone);

			$message = '<p><b>Форма</b>: ' . $form_title . '</p>';
			$message .= '<p style="margin: 3px 0;"><b>Имя</b>: ' . $title . '</p>';
			$message .= '<p style="margin: 3px 0;"><b>Cвязаться</b>: ' . $phone . '</p>';
			$message .= '<div style="margin: 3px 0 10px;"><b>Отзыв</b>:<br>' . $m_test . '</div><br>';
			$message .= '<p>Результат обработки формы выможете посмотреть по этой <a href="' . admin_url() . 'post.php?post='.$post_id.'&action=edit">ссылке</a>.</p>';

			$mail_to = get_option('admin_email');
			
			$headers = array(
				'From: Адвокатская контора №1 <' . $mail_to . '>',
				'content-type: text/html',
			);

			$json['mail'] = wp_mail($mail_to, 'Новый отзыв на сайте', $message, $headers);
		}

		wp_send_json($json);
	}

	if($_GET['user_file_upload']){
		$json = array();

		$json['files'] = array();

		if ( ! function_exists( 'wp_handle_upload' ) ) 
			require_once( ABSPATH . 'wp-admin/includes/file.php' );

		$overrides = array( 'test_form' => false );

		$upload_dir = wp_upload_dir();

		$f = 0;
		foreach($_FILES as $file){
			$file['name'] = wp_unique_filename( $upload_dir['subdir'], $file['name'] );

			$json['files'][$f] = wp_handle_upload( $file, $overrides );
			$json['files'][$f]['name'] = $file['name'];

			$f++;
		}

		wp_send_json($json);
	}

	function get_posts_practika(){
		$json = array();

		$cat_id = $_POST['cat_id'];
		$offset = $_POST['offset'];

		//query_posts("cat=$cat_id&offset=$offset&posts_per_page=8");
		$practika = new WP_Query(
			array(
				'cat' => (int)$cat_id,
				'offset' => (int)$offset, 
				'orderby' => 'date', 
				'order' => 'DESC', 
				'posts_per_page' => 8
			)
		);
		$html = '';
		$i = 1;
		$json['found_posts'] = $practika->found_posts;

		while($practika->have_posts()){
			$practika->the_post();

			$html .= '<div class="lawyers_post practika_item">';
			$html .= '<p class="title"><a href="'.get_the_permalink().'" target="_self">'.my_typograf(get_the_title()).'</a></p>';
			$html .= '<p class="result">'.my_typograf(strip_tags(get_post_meta(get_the_ID(), 'result', true))).'</p>';

			$the_categories = get_the_category();

                foreach($the_categories as $categories){
                  	if($categories->category_parent != 0){
	                    $get_category = get_category($categories->category_parent);

						if($get_category->slug == 'branch_of_law'){
	                    	$html .=  '<p class="cat_theme">'. $categories->name .'</p>';
						}
					}
        		}

        	$html .= '</div>';
		}

		$json['items'] = $html;
		$json['success'] = true;

		wp_send_json($json);
	}

	add_action('wp_ajax_get_posts_practika', 'get_posts_practika');
	add_action('wp_ajax_nopriv_get_posts_practika', 'get_posts_practika');

	function adv_remove_file(){
		$json = array();

		$path = $_POST['path'];
		$json['path'] = $path;

		$url = site_url();
		$file_path = explode($url, $path);
		$file_path = '..' . $file_path[1];
		
		wp_send_json($json);
	}

	add_action('wp_ajax_remove_file', 'adv_remove_file');
	add_action('wp_ajax_nopriv_remove_file', 'adv_remove_file');
}