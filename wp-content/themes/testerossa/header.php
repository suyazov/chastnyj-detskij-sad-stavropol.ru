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
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/swiper-bundle.min.css" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/fontawesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fancybox.css" />

    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-sm.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-md.css">
</head>


<body class="<?php if (!is_front_page()): ?>body-page<?php endif; ?>">
    <header class="header">
        <div class="container header__row">
            <a href="<?php echo home_url(); ?>" class="header__logo"><img src="/wp-content/uploads/2024/07/logo.png"
                    alt=""></a>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                )
            );
            ?>

            <div class="header__contact">
                <a href="<?php the_field('tg', 'option'); ?>" class="header__contact-tg"><i
                        class="fa-brands fa-telegram"></i></a>
                <a href="<?php the_field('wa', 'option'); ?>" class="header__contact-wa"><i
                        class="fa-brands fa-whatsapp"></i></a>
                <a href="<?php the_field('vk', 'option'); ?>" class="header__contact-vk"><i
                        class="fa-brands fa-vk"></i></a>
                <div class="header__contact-phone">
                    <i class="icon fa-solid fa-phone"></i>
                    <a href="tel:<?php the_field('tel_link', 'option'); ?>"><?php the_field('tel', 'option'); ?></a>
                </div>
                <a href="#" class="mobile-burger" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasTop">
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