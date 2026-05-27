<?php
/**
 * The template for displaying 404 pages
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package testerossa
 */

get_header();
?>

<main class="error-404" style="padding: 50px 0; text-align: center;">
    <div class="container">
        <h1 style="font-size: 48px; margin-bottom: 20px;">404 — Страница не найдена</h1>
        <p style="font-size: 18px; margin-bottom: 30px;">Извините, запрашиваемая страница не существует.</p>
        
        <div class="search-404" style="margin-bottom: 30px;">
            <h2>Поиск по сайту</h2>
            <?php get_search_form(); ?>
        </div>
        
        <div class="links-404">
            <a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-primary">На главную</a>
        </div>
    </div>
</main>

<?php
get_footer();
