<?php

// Template Name: Info

get_header();
?>

<section class="faq" id="faq">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="accordeon">
            <?php while (have_rows('akkordeon')):
                the_row(); ?>
                <div class="accordeon__item">
                    <div class="accordeon__head">
                        <div class="icon">
                            <img src="/wp-content/uploads/2025/04/down-arrow.png" alt="">
                        </div>
                        <p><?php the_sub_field('title'); ?></p>
                    </div>
                    <div class="accordeon__body">
                        <div>
                            <?php the_sub_field('text'); ?>
                        </div>

                        <?php if (have_rows('docs')): ?>
                            <ul>
                                <?php while (have_rows('docs')):
                                    the_row(); ?>
                                    <li><a href="<?php the_sub_field('image'); ?>"><?php the_sub_field('text'); ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>


                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php
get_footer();
