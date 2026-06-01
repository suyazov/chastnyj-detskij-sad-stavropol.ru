<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package testerossa
 */

?>

<footer class="footer">
    <div class="container">
        <div class="footer-1" itemscope itemtype="https://schema.org/Organization">

            <p>&copy; 2016 - <?php echo date("Y"); ?>. <span itemprop="name">&laquo;Дети в приоритете&raquo; - частный детский сад в
                    Ставрополе</span></p>

            <p itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">Адрес: <span
                    itemprop="addressLocality">г. Ставрополь,</span> <span itemprop="streetAddress">ул. Партизанская,
                    2</span> (ЖК &laquo;Александровский парк&raquo;)</p>

        </div>
        <div class="footer-2">
            <p>Лицензия от 19 сентября 2023 года рег. №Л035-01217-26/00681824<br><a href="/svedeniya-ob-obrazovatelnoj-organizaczii/">Сведения об образовательной организации</a></p>
            <p><a href="#">Политика конфиденциальности</a></p>

        </div>
    </div>
</footer>


<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-backdrop="false" id="offcanvasTop" data-bs-scroll="true"
    aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <span class="offcanvas-title" id="offcanvasTopLabel"></span>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php
        wp_nav_menu(
            array(
                "theme_location" => "menu-1",
                "menu_id" => "primary-menu",
            )
        );
        ?>
    </div>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer>
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/swiper-bundle.min.js" defer></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/fancybox.umd.js" defer></script>
<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/main.js" defer></script>

</body>

</html>
