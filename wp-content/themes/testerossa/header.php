<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package testerossa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php if ( is_front_page() ): ?>
    <link rel="preload" as="image" href="/wp-content/uploads/2024/04/screenshot_4.webp">
    <?php endif; ?>
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/swiper-bundle.min.css" media="print" onload="this.media='all'" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/fontawesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fancybox.css" media="print" onload="this.media='all'">

    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-sm.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-md.css" media="print" onload="this.media='all'">
</head>


<body class="<?php if (!is_front_page()): ?>body-page<?php endif; ?>">
    <header class="header">
        <div class="container header__row">
            <a href="<?php echo home_url(); ?>" class="header__logo"><img src="/wp-content/uploads/2024/07/logo.png"
                    alt="Частный детский сад"></a>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                )
            );
            ?>

            <div class="header__contact">
                <a href="<?php the_field('tg', 'option'); ?>" class="header__contact-tg" aria-label="Telegram"><i
                        class="fa-brands fa-telegram"></i></a>
                <a href="<?php the_field('wa', 'option'); ?>" class="header__contact-wa" aria-label="WhatsApp"><i
                        class="fa-brands fa-whatsapp"></i></a>
                <a href="<?php the_field('vk', 'option'); ?>" class="header__contact-vk" aria-label="ВКонтакте"><i
                        class="fa-brands fa-vk"></i></a>
                <div class="header__contact-phone">
                    <i class="icon fa-solid fa-phone" aria-label="Телефон"></i>
                    <a href="tel:<?php the_field('tel_link', 'option'); ?>"><?php the_field('tel', 'option'); ?></a>
                </div>
                <a href="#" class="mobile-burger" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasTop" aria-label="Меню">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
        </div>
    </header>

    <?php /*
       wp_nav_menu(
           array(
               'theme_location' => 'menu-1',
               'menu_id'        => 'primary-menu',
           )
       );
       */ ?>