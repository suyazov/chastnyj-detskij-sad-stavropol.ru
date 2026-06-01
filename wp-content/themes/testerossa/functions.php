<?php
/**
 * testerossa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package testerossa
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function testerossa_setup() {
	load_theme_textdomain( 'testerossa', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'testerossa' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-background',
		apply_filters(
			'testerossa_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'testerossa_setup' );

function testerossa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'testerossa_content_width', 640 );
}
add_action( 'after_setup_theme', 'testerossa_content_width', 0 );

function testerossa_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'testerossa' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'testerossa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'testerossa_widgets_init' );

/**
 * Enqueue scripts and styles with defer support
 */
function testerossa_scripts() {
	wp_enqueue_style( 'testerossa-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'testerossa-style', 'rtl', 'replace' );

	wp_enqueue_script( 'testerossa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'testerossa_scripts' );

/**
 * Add defer attribute to all enqueued scripts
 */
function testerossa_add_defer_to_scripts( $tag, $handle, $src ) {
	$defer_handles = array(
		'jquery-core',
		'jquery-migrate',
		'contact-form-7',
		'swv',
		'wpcf7mf-mask',
	);
	if ( in_array( $handle, $defer_handles, true ) && false === strpos( $tag, 'defer' ) ) {
		$tag = str_replace( ' src=', ' defer src=', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'testerossa_add_defer_to_scripts', 10, 3 );

/**
 * Load CF7 CSS asynchronously to avoid render-blocking
 */
function testerossa_async_cf7_css( $html, $handle, $href, $media ) {
	if ( 'contact-form-7' === $handle ) {
		$html = preg_replace(
			"/media='all'/",
			"media='print' onload=\"this.media='all'\"",
			$html
		);
	}
	return $html;
}
add_filter( 'style_loader_tag', 'testerossa_async_cf7_css', 10, 4 );

/**
 * Remove jQuery Migrate (not needed for modern jQuery usage)
 */
function testerossa_remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'testerossa_remove_jquery_migrate' );

/**
 * Remove emoji scripts to reduce page weight
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Remove unnecessary head elements
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

/**
 * Remove Speculation Rules API script
 */
remove_action( 'wp_head', 'wp_print_speculation_rules', 1 );

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

/**
 * Helper function to get image URL from ACF field
 */
function testerossa_get_image_url( $image ) {
    if ( ! $image ) {
        return '';
    }

    if ( is_array( $image ) && ! empty( $image['url'] ) ) {
        return esc_url( $image['url'] );
    }

    if ( is_numeric( $image ) ) {
        $url = wp_get_attachment_url( $image );
        return $url ? esc_url( $url ) : '';
    }

    return esc_url( $image );
}

/**
 * Honeypot + timestamp spam protection for Contact Form 7
 */
require get_template_directory() . '/spam-protection.php';

/**
 * Disable Google reCAPTCHA scripts (using honeypot instead)
 */
add_action( 'wp_enqueue_scripts', 'disable_recaptcha_scripts', 100 );
function disable_recaptcha_scripts() {
    wp_dequeue_script( 'google-recaptcha' );
    wp_dequeue_script( 'wpcf7-recaptcha' );
}

/**
 * SMTP configuration — Beget mail server (no plugin)
 * From: clients@chastnyj-detskij-sad-stavropol.ru
 * Server: smtp.beget.com:465 (SSL)
 */
add_action( 'phpmailer_init', 'testerossa_smtp_setup' );
function testerossa_smtp_setup( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.beget.com';
    $phpmailer->Port       = 465;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = 'clients@chastnyj-detskij-sad-stavropol.ru';
    $phpmailer->Password   = 'KajO%j3DBuV%';
    $phpmailer->From       = 'clients@chastnyj-detskij-sad-stavropol.ru';
    $phpmailer->FromName   = 'Детский сад Дети в приоритете';
    $phpmailer->CharSet    = 'UTF-8';
    $phpmailer->Encoding   = 'base64';
    $phpmailer->Timeout    = 10;
}

/**
 * CF7 submission logging — diagnostic
 */
add_action( "wpcf7_mail_sent", "testerossa_cf7_log_sent", 10, 1 );
function testerossa_cf7_log_sent( $contact_form ) {
    $log = "[" . date("Y-m-d H:i:s") . "] CF7 mail SENT OK\n";
    error_log( $log, 3, ABSPATH . "wp-content/uploads/cf7-logs.log" );
}

add_action( "wpcf7_mail_failed", "testerossa_cf7_log_failed", 10, 3 );
function testerossa_cf7_log_failed( $contact_form, $mail, $error ) {
    $log = "[" . date("Y-m-d H:i:s") . "] CF7 mail FAILED: " . print_r( $error, true ) . "\n";
    error_log( $log, 3, ABSPATH . "wp-content/uploads/cf7-logs.log" );
}

add_action( "wpcf7_submit", "testerossa_cf7_log_submit", 10, 2 );
function testerossa_cf7_log_submit( $contact_form, $result ) {
    $status = $result["status"];
    $data = isset( $result["posted_data"] ) ? $result["posted_data"] : array();
    $log = "[" . date("Y-m-d H:i:s") . "] CF7 submit status={$status} data=" . json_encode( $data, JSON_UNESCAPED_UNICODE ) . "\n";
    error_log( $log, 3, ABSPATH . "wp-content/uploads/cf7-logs.log" );
}

/**
 * Disable CF7 built-in spam detection — we use honeypot + timestamp instead
 * CF7 marks submissions as spam when reCAPTCHA response is empty
 */
add_filter( "wpcf7_spam", "__return_false" );
