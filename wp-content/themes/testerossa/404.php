<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package testerossa
 */

get_header();
?>
<section class="main-section error">
    <div class="container">
        <div class="main__block">
            <div class="green__block-wrap">
                <div class="green__block">
                    <h1>Ошибка 404. Страницы не существует</h1>
                    <img src="/wp-content/uploads/2024/03/logotip-bolshoj-tochka-rosta.png" alt="">
                </div>
                <p class="main__text">Пожалуйста, вернитесь <a href="/">на главную</a></p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
