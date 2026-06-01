<?php
// Template Name: Main
get_header(); ?>
<main id="main-content" class="site-main">

<?php


while (have_rows('build')) : the_row();

    if (get_row_layout() == 'main'): ?>

        <div class="main-section">
            <img src="/wp-content/uploads/2024/07/main.webp" alt="" class="main-section__bg" fetchpriority="high" width="1920" height="730" aria-hidden="true">
            <div class="container">
                <div class="main__block">
                    <div class="green__block-wrap">
                        <div class="green__block">
                            <div class="main-logo">
                                <img src="/wp-content/uploads/2025/04/main-arrow.png" class="old-img" width="276" height="173" alt="Стрелка декоративная">
                                <img src="/wp-content/uploads/2024/07/logo-big.png" class="main-img" width="158" height="156" alt="Логотип Детский сад Дети в приоритете">
                            </div>


                            <h1><?php the_sub_field('title'); ?></h1>
                        </div>
                        <p class="main__text"><?php the_sub_field('text'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <?php
                    while (have_rows('main_row')) : the_row(); ?>

                        <div class="col-md-4">
                            <div class="main__item">
                                <img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" alt="" class="main__item-img" loading="lazy" width="74" height="74">
                                <?php the_sub_field('text'); ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    <?php  elseif (get_row_layout() == 'video'): ?>

        <section class="presentation" id="about">
            <div class="container">
                <h2>Посмотрите нашу <span>видеопрезентацию</span></h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="video__item ratio ratio-16x9">
                            <a href="<?php the_sub_field('video'); ?>" data-fancybox="videopresentation" aria-label="Смотреть видео">
                                <img src="<?php echo testerossa_get_thumb_url(testerossa_get_image_url(get_sub_field('preview')), '500x255'); ?>" class="ratio ratio-16x9 w-100" width="500" height="255" alt="Видео презентация детского сада">
                                <svg class="icon-play" width="48" height="48" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>

                        </div>
                        <a href="#cta" class="green-btn text-decoration-none">Записаться
                            на экскурсию</a>
                    </div>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'bullets'): ?>
        <section class="imagine color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="row">
                    <?php
                    while (have_rows('bullets_row')) : the_row(); ?>
                        <div class="col-md-4">
                            <div class="imagine__item">
                                <img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" alt="" loading="lazy" width="91" height="90">
                                <?php the_sub_field('text'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'year'): ?>
        <section class="year">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="row">
                    <?php
                    while (have_rows('year_row')) : the_row(); ?>
                        <div class="col-md-3">
                            <div class="year__item">
                                <img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" alt="" loading="lazy" width="120" height="120">
                                <?php the_sub_field('text'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <p class="year__text">
                    <?php the_sub_field('text'); ?>
                </p>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'gallery_1'): ?>
        <section class="gallery-inter color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="gallery-1">
                    <div class="swiper swiper1">
                        <div class="swiper-wrapper">
                            <?php
                            while (have_rows('gallery_1_row')) : the_row();
                                $full_url = testerossa_get_image_url(get_sub_field('img'));
                                $thumb_url = testerossa_get_thumb_url($full_url);
                            ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo $full_url; ?>" data-fancybox="gallery-2" aria-label="Открыть фотографии интерьеров"><img
                                            src="<?php echo $thumb_url; ?>" alt="" width="240" height="300" loading="lazy"></a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <p class="inter__text">
                        <?php the_sub_field('text'); ?>
                    </p>
                    <a href="#cta" class="green-btn">Узнать о садике больше</a>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'programm'): ?>
        <section class="programm" id="prog">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>

                <div class="schema__row">
                    <?php while (have_rows('programm_row')) : the_row(); ?>
                        <div class="schema__item <?php the_sub_field('color'); ?>-border">
                            <div class="schema__head <?php the_sub_field('color'); ?>-bg"><?php the_sub_field('title'); ?></div>
                            <div class="schema__body">
                                <?php while (have_rows('list')) : the_row(); ?>
                                    <div class="schema__list">
                                        <span></span>
                                        <div class="schema__content">
                                            <p class="title"><?php the_sub_field('title'); ?></p>
                                            <p class="body"><?php the_sub_field('text'); ?></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'osnova'): ?>
        <section class="method color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="method__block">
                    <img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" alt="" loading="lazy" width="800" height="500">
                    <?php the_sub_field('text'); ?>
                </div>

            </div>
        </section>
    <?php  elseif (get_row_layout() == 'history'): ?>
        <section class="history">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="schema__row">
                    <div class="schema__item green-border schema__item-1">
                        <div class="schema__head green-bg"><?php the_sub_field('title_1'); ?></div>
                        <div class="schema__body">

                            <?php the_sub_field('text_1'); ?>

                        </div>
                    </div>
                    <div class="schema__item green-border borrad-20 h-100 schema__item-2">
                        <img src="<?php echo testerossa_get_image_url(get_sub_field('img_1')); ?>" alt="" loading="lazy" width="400" height="400">
                    </div>
                    <div class="schema__item green-border borrad-20 h-100 schema__item-3">
                        <img src="<?php echo testerossa_get_image_url(get_sub_field('img_2')); ?>" alt="" loading="lazy" width="400" height="400">
                    </div>
                    <div class="schema__item green-border schema__item-4">
                        <div class="schema__head green-bg"><?php the_sub_field('title_2'); ?></div>
                        <div class="schema__body">
                            <?php the_sub_field('text_2'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'boss'): ?>
        <section class="boss color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="three-elem__row">
                    <div class="item item-1">
                        <p class="title-1"><?php the_sub_field('text_1'); ?>
                        </p>
                    </div>
                    <div class="item item-2"><img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" class="boss-img" loading="lazy" width="400" height="400" alt="Фото руководителя">
                    </div>
                    <div class="item item-3">
                        <p class="title-2"><?php the_sub_field('text_2'); ?></p>
                    </div>
                </div>
                <div class="boss__info">
                    <p class="title"><?php the_sub_field('boss_title'); ?></p>
                    <p class="desc"><?php the_sub_field('desc'); ?></p>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'flat'): ?>
        <section class="gallery-inter">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <p class="subtitle tac"><?php the_sub_field('desc'); ?></p>
                <div class="gallery-1">
                    <div class="swiper swiper1">
                        <div class="swiper-wrapper">
                            <?php $images = get_sub_field('gallery');
                            foreach ($images as $image) :
                                $full_url = testerossa_get_image_url($image);
                                $thumb_url = testerossa_get_thumb_url($full_url);
                            ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo $full_url; ?>" data-fancybox="gallery-1" aria-label="Открыть фотографии помещения"><img
                                            src="<?php echo $thumb_url; ?>" alt="" width="240" height="300" loading="lazy"></a>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <a href="#cta" class="green-btn">Узнать о садике больше</a>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'review'): ?>
        <section class="gallery-inter color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="gallery-1">
                    <div class="swiper swiper2">
                        <div class="swiper-wrapper">

                            <?php while (have_rows('review_row')) : the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="review__item">
                                        <a data-fancybox="gallery" href="<?php the_sub_field('video'); ?>" aria-label="Отзыв <?php the_sub_field('name'); ?>">
                                            <img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" alt="" loading="lazy" width="240" height="300">
                                            <svg class="icon-play" width="48" height="48" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                        </a>
                                        <p class="title"><?php the_sub_field('name'); ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>



                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'price'): ?>
        <section class="price" id="price">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="schema__row">
                    <?php while (have_rows('price_row')) : the_row(); ?>
                        <div class="schema__item <?php the_sub_field('color'); ?>-border">
                            <div class="schema__head <?php the_sub_field('color'); ?>-bg"><?php the_sub_field('title'); ?></div>
                            <div class="schema__body">
                                <div>
                                    <?php the_sub_field('text'); ?>
                                </div>
                                <div class="price__item">
                                    <p class="old-price"><?php the_sub_field('old_price'); ?></p>
                                    <p class="regular-price"><?php the_sub_field('price'); ?></p>
                                    <a href="#cta" class="green-btn">Купить абонемент</a>
                                    <p class="price__item-bonus">Скидка на абонемент для второго ребёнка</p>
                                    <p class="price__item-bonus">Предусмотрен ежегодный взнос</p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'bonus'): ?>
        <section class="bonus">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="bonus__table">
                    <div class="bonus__item">
                        <div class="bonus__head bonus__head-1"><?php the_sub_field('bonus_title-1'); ?></div>
                        <?php the_sub_field('bonus_text-1'); ?>
                    </div>
                    <div class="bonus__item">
                        <div class="bonus__head bonus__head-2"><?php the_sub_field('bonus_title-2'); ?></div>
                        <?php the_sub_field('bonus_text-2'); ?>
                    </div>
                </div>
                <p class="bonus__text"><?php the_sub_field('text'); ?></p>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'garantee'): ?>
        <section class="garantee color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <p class="subtitle"><?php the_sub_field('subtitle'); ?></p>
                <div class="three-elem__row">
                    <div class="item item-1">
                        <p class="title-1"><?php the_sub_field('text_1'); ?>
                        </p>
                    </div>
                    <div class="item item-2"><img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" class="boss-img" loading="lazy" width="400" height="400" alt="Фото руководителя">
                    </div>
                    <div class="item item-3">
                        <p class="title-2"><?php the_sub_field('text_2'); ?></p>
                    </div>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'faq'): ?>
        <section class="faq" id="faq">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="accordeon">
                    <?php while (have_rows('faq_row')) : the_row(); ?>
                        <div class="accordeon__item">
                            <div class="accordeon__head">
                                <div class="icon">
                                    <img src="/wp-content/uploads/2025/04/down-arrow.png" alt="" width="90" height="90" loading="lazy">
                                </div>
                                <p><?php the_sub_field('title'); ?></p>
                            </div>
                            <div class="accordeon__body">
                                <?php the_sub_field('text'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php  elseif (get_row_layout() == 'adv'): ?>
        <section class="three last-three color-bg">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>
                <div class="row">
                    <?php while (have_rows('adv_row')) : the_row(); ?>
                        <div class="col-md-4">
                            <div class="three__item">
                                <img src="<?php echo testerossa_get_image_url(get_sub_field('img')); ?>" alt="" loading="lazy" width="120" height="120">
                                <?php the_sub_field('text'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php elseif (get_row_layout() == 'cta'): ?>
        <div class="cta" id="cta" style="background-image: url('/wp-content/uploads/2024/07/footer-img.png');">
            <div class="container">
                <h2><?php the_sub_field('title'); ?></h2>

                <div class="cta__row">
                    <div class="cta__item cta__item-1">
                        <img src="<?php echo testerossa_get_image_url(get_sub_field('img_1')); ?>" alt="" loading="lazy" width="300" height="400">
                        <p class="name"><?php the_sub_field('title_1'); ?></p>
                        <p class="desc"><?php the_sub_field('desc_1'); ?></p>
                    </div>
                    <div class="cta__item cta__item-2">
                        <div class="cta__contact-wrap">
                            <p class="text"><?php the_sub_field('text'); ?></p>
                            <a href="tel:<?php the_field('tel_link', 'option'); ?>" class="tel"><?php the_field('tel', 'option'); ?></a>
                            <div class="icon__wrap text-decoration-none">
                                <a href="<?php the_field('wa', 'option'); ?>" class="text-decoration-none wa" aria-label="WhatsApp"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                                        <path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"></path>
                                        <path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"></path>
                                        <path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"></path>
                                        <path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"></path>
                                        <path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"></path>
                                    </svg></a>
                                <a href="<?php the_field('tg', 'option'); ?>" class="text-decoration-none tg" aria-label="Telegram"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                                        <path fill="#29b6f6" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path>
                                        <path fill="#fff" d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z"></path>
                                        <path fill="#b0bec5" d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z"></path>
                                        <path fill="#cfd8dc" d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z"></path>
                                    </svg></a>
                                <a href="<?php the_field('vk', 'option'); ?>" class="text-decoration-none vk" aria-label="ВКонтакте"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                                        <path fill="#1976d2" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path>
                                        <path fill="#fff" d="M35.937,18.041c0.046-0.151,0.068-0.291,0.062-0.416C35.984,17.263,35.735,17,35.149,17h-2.618 c-0.661,0-0.966,0.4-1.144,0.801c0,0-1.632,3.359-3.513,5.574c-0.61,0.641-0.92,0.625-1.25,0.625C26.447,24,26,23.786,26,23.199 v-5.185C26,17.32,25.827,17,25.268,17h-4.649C20.212,17,20,17.32,20,17.641c0,0.667,0.898,0.827,1,2.696v3.623 C21,24.84,20.847,25,20.517,25c-0.89,0-2.642-3-3.815-6.932C16.448,17.294,16.194,17,15.533,17h-2.643 C12.127,17,12,17.374,12,17.774c0,0.721,0.6,4.619,3.875,9.101C18.25,30.125,21.379,32,24.149,32c1.678,0,1.85-0.427,1.85-1.094 v-2.972C26,27.133,26.183,27,26.717,27c0.381,0,1.158,0.25,2.658,2c1.73,2.018,2.044,3,3.036,3h2.618 c0.608,0,0.957-0.255,0.971-0.75c0.003-0.126-0.015-0.267-0.056-0.424c-0.194-0.576-1.084-1.984-2.194-3.326 c-0.615-0.743-1.222-1.479-1.501-1.879C32.062,25.36,31.991,25.176,32,25c0.009-0.185,0.105-0.361,0.249-0.607 C32.223,24.393,35.607,19.642,35.937,18.041z"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <?php /*
                    <div class="cta__item cta__item-3">
                        <img src="<?php echo testerossa_get_image_url(get_sub_field('img_2')); ?>" alt="">
                        <p class="name"><?php the_sub_field('title_2'); ?></p>
                        <p class="desc"><?php the_sub_field('desc_2'); ?></p>
                    </div> */ ?>
                </div>
                <div class="cta_row-row">
                    <?php echo do_shortcode(get_sub_field('form')); ?>
                </div>
            </div>
        </div>


<?php endif;
endwhile;
?>
</main>
<?php get_footer(); ?>