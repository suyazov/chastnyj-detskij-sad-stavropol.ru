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
    <style>
    @font-face{font-family:'Roboto';font-style:normal;font-weight:100 900;font-display:optional;src:url('<?php echo get_template_directory_uri(); ?>/fonts/roboto-cyrillic-ext.woff2') format('woff2');unicode-range:U+0460-052F,U+1C80-1C8A,U+20B4,U+2DE0-2DFF,U+A640-A69F,U+FE2E-FE2F}
    @font-face{font-family:'Roboto';font-style:normal;font-weight:100 900;font-display:optional;src:url('<?php echo get_template_directory_uri(); ?>/fonts/roboto-cyrillic.woff2') format('woff2');unicode-range:U+0301,U+0400-045F,U+0490-0491,U+04B0-04B1,U+2116}
    body{font-family:'Roboto',system-ui,-apple-system,sans-serif}
    </style>

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

    <style>.container{max-width:1140px;margin:0 auto;padding:0 15px}.row{display:flex;flex-wrap:wrap;margin:0 -7.5px}.col-md-3,.col-md-4,.col-md-8{position:relative;width:100%;padding:0 7.5px}[class*="col-md-"]{box-sizing:border-box}.main-section{position:relative;overflow:hidden;width:100%;padding-bottom:120px;min-height:480px;aspect-ratio:16/7;background:url("/wp-content/uploads/2024/07/main.webp") center/cover no-repeat}.main-section__bg{position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0}.main-section>.container{position:relative;z-index:1}.header{width:100%;background-color:#fff;padding:10px 0}.header__row{display:flex;align-items:center;justify-content:space-between;width:100%}.header__logo img{width:70px}.offcanvas{position:fixed;bottom:0;z-index:1050;display:flex;flex-direction:column;max-width:100%;visibility:hidden;background-color:#fff;outline:0;transition:transform .3s ease-in-out}.offcanvas-end{right:0;top:0;width:400px;border-left:1px solid rgba(0,0,0,.2);transform:translateX(100%)}.offcanvas.show{transform:none;visibility:visible}.btn-close{box-sizing:content-box;width:1em;height:1em;padding:.25em;color:#000;background:transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;border:0;border-radius:.375rem;opacity:.5}.btn-close:hover{opacity:.75}</style>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/swiper-bundle.min.css" media="print" onload="this.media='all'">
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
                <a href="<?php the_field("tg", "option"); ?>" class="header__contact-tg" aria-label="Telegram"><svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg></a>
                <a href="<?php the_field("wa", "option"); ?>" class="header__contact-wa" aria-label="WhatsApp"><svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.435-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg></a>
                <a href="<?php the_field("vk", "option"); ?>" class="header__contact-vk" aria-label="ВКонтакте"><svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor"><path d="M15.684 0H8.316C1.592 0 0 1.592 0 8.316v7.368C0 22.408 1.592 24 8.316 24h7.368C22.408 24 24 22.408 24 15.684V8.316C24 1.592 22.391 0 15.684 0zm3.692 17.123h-1.744c-.66 0-.864-.525-2.05-1.727-1.033-1-1.49-1.135-1.744-1.135-.356 0-.458.102-.458.593v1.575c0 .424-.135.678-1.253.678-1.846 0-3.896-1.12-5.335-3.202C4.624 10.857 4.03 8.57 4.03 8.096c0-.254.102-.491.593-.491h1.744c.44 0 .61.203.78.678.847 2.49 2.27 4.674 2.853 4.674.22 0 .322-.102.322-.66V9.721c-.068-1.186-.695-1.287-.695-1.71 0-.203.17-.407.44-.407h2.744c.373 0 .508.203.508.643v3.473c0 .372.17.508.271.508.22 0 .407-.136.813-.542 1.27-1.422 2.18-3.607 2.18-3.607.119-.254.322-.491.763-.491h1.744c.525 0 .644.27.525.643-.22 1.017-2.354 4.031-2.354 4.031-.186.305-.254.44 0 .78.186.254.796.78 1.203 1.253.745.847 1.32 1.558 1.473 2.05.17.49-.085.744-.576.744z"/></svg></a>
                <div class="header__contact-phone">
                    <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-label="Телефон"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3.2 3.45 3.2 3.99c0 9.66 7.85 17.5 17.5 17.5.54 0 .99-.45.99-.99v-3.63c0-.55-.45-.99-.99-.99z"/></svg>
                    <a href="tel:<?php the_field("tel_link", "option"); ?>"><?php the_field("tel", "option"); ?></a>
                </div>
                <a href="#" class="mobile-burger" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasTop" aria-label="Меню">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3V6m0 5h18v2H3v-2m0 5h18v2H3v-2z"/></svg>
                </a>
            </div>
        </div>
    </header>
