<?php

/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package testerossa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php if ( is_front_page() ): ?>
    <meta name="description" content="Частный детский сад в Ставрополе. Оздоровительный образовательный комплекс с экскурсиями, аттракционами и профессиональными воспитателями.">
    <link rel="preload" as="image" href="/wp-content/uploads/2024/07/main.webp" fetchpriority="high">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://ka-f.fontawesome.com">

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    window.addEventListener("load", function() {
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(82867762, "init", {webvisor:true, clickmap:true, referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
    });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/82867762" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/swiper-bundle.min.css" media="print" onload="this.media='all'">
    <script src="<?php echo get_template_directory_uri(); ?>/js/fontawesome.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fancybox.css" media="print" onload="this.media='all'">

    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-sm.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-md.css" media="print" onload="this.media='all'">
</head>


<body class="<?php if (!is_front_page()): ?>body-page<?php endif; ?>">
    <header class="header">
        <div class="container header__row">
            <a href="<?php echo home_url(); ?>" class="header__logo"><img src="/wp-content/uploads/2024/07/logo.png"
                    alt="Частный детский сад" width="120" height="120"></a>
            <?php
            wp_nav_menu(
                array(
                    "theme_location" => "menu-1",
                    "menu_id" => "primary-menu",
                )
            );
            ?>

            <div class="header__contact">
                <a href="<?php the_field("tg", "option"); ?>" class="header__contact-tg" aria-label="Telegram"><i
                        class="fa-brands fa-telegram"></i></a>
                <a href="<?php the_field("wa", "option"); ?>" class="header__contact-wa" aria-label="WhatsApp"><i
                        class="fa-brands fa-whatsapp"></i></a>
                <a href="<?php the_field("vk", "option"); ?>" class="header__contact-vk" aria-label="ВКонтакте"><i
                        class="fa-brands fa-vk"></i></a>
                <div class="header__contact-phone">
                    <i class="icon fa-solid fa-phone" aria-label="Телефон"></i>
                    <a href="tel:<?php the_field("tel_link", "option"); ?>"><?php the_field("tel", "option"); ?></a>
                </div>
                <a href="#" class="mobile-burger" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasTop" aria-label="Меню">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
        </div>
    </header>
