# Проект: chastnyj-detskij-sad-stavropol.ru

## Сервер
- SSH: `ssh serv` (85.198.97.13)
- Путь: `/var/www/chastnyj-detskij-sad-stavropol.ru`
- Nginx + PHP-FPM + Redis

## Текущие показатели PageSpeed (2026-06-01, до本轮оптимизации): FCP 2.7s | LCP 14.5s | TBT 110ms | CLS 0 | SI 12.3s
## Цель: Performance ≥ 80 (моб) / ≥ 90 (десктоп) | LCP < 2.5с | CLS < 0.1 | SEO ≥ 95 | Accessibility ≥ 90

---

## Архитектура и Инфраструктура

### Nginx
- SSL: Let's Encrypt (TLSv1.2 + TLSv1.3)
- FastCGI Cache: зона FASTCGI (100m), 60min inactive, 1GB max
- Исключения из кэша: POST, wp-admin, wp-login, wp-json, logged-in users
- X-Cache / X-FastCGI-Cache заголовки для диагностики
- Статика: Cache-Control `public, immutable`, max-age=31536000
- WebP: `try_files $uri.webp $uri` для uploads (Vary: Accept)
- Gzip: text/css, application/javascript, image/svg+xml
- Security headers: X-Frame-Options, X-Content-Type-Options, X-XSS-Protection

### Redis
- Redis Object Cache: активен (drop-in wp-content/object-cache.php)
- База: 2, префикс: `detsad_stv:`, хост: 127.0.0.1:6379

### PHP
- WP_CRON: отключён (системный cron recommended)
- WP_DEBUG: выключен

---

## Оптимизация производительности

### Выполнено (2026-06-01)

#### Раунд 1: Критические исправления
- [x] **Яндекс.Метрика** — код вставлен напрямую в header.php (ID: 82867762), обёрнут в `window.addEventListener('load')`, не блокирует рендеринг
- [x] **jQuery Migrate** — удалён (defer для jQuery core)
- [x] **Все JS скрипты** — defer: jQuery, CF7, Swiper, Fancybox, main.js
- [x] **Swiper/Fancybox CSS** — async загрузка (media=print + onload)
- [x] **CF7 CSS** — async через style_loader_tag фильтр
- [x] **responsive CSS** — style-sm.css, style-md.css async
- [x] **Emoji скрипты** — удалены из wp_head
- [x] **Неиспользуемые head элементы** — wp_generator, wlwmanifest, rsd, shortlink, rest_output_link, oembed
- [x] **LCP preload** — link rel=preload для main.webp
- [x] **FastCGI Cache** — Nginx кэширование HTML страниц
- [x] **Redis Object Cache** — drop-in активен
- [x] **WebP через Nginx** — try_files для uploads, Vary: Accept
- [x] **Honeypot + timestamp** — защита от спама вместо reCAPTCHA
- [x] **CF7 REST API** — работает, wp-json исключён из кэша
- [x] **ARIA атрибуты** — формы, соцсети, иконки

#### Раунд 2: Шрифты и иконки
- [x] **Google Fonts** — 300..900 (4 файла ~104KB) → 400;700 (2 файла ~50KB)
- [x] **Font Awesome** — удалён fontawesome.js (~270KB), заменён на inline SVG (7 иконок)
- [x] Иконки: telegram, whatsapp, vk, phone, bars, youtube (×2)

#### Раунд 3: Изображения и CSS
- [x] **Bootstrap CSS оставлен** — попытка удаления сломала верстку, оставлен как async (media=print + onload)
- [x] **Stale preconnect** — удалён `ka-f.fontawesome.com` (FA удалён ранее)
- [x] **Slider thumbnails** — функция `testerossa_get_thumb_url()` для автоматического использования `-240x300` WordPress миниатюр
  - 14 слайдер изображений: 700×875 (90-107KB каждое) → 240×300 (17-19KB каждое)
  - Экономия: ~950KB при загрузке страницы
- [x] **width/height для всех `<img>`** — предотвращает CLS
- [x] **loading="lazy"** — для всех ниже-фолд изображений (50 штук)
- [x] **Font CLS fix** — заменён `@import` на `<link rel="preload">` + `<link rel="stylesheet">`, CLS: 0.182 → 0
- [x] **CTA кнопки** — все ведут к `#cta` форме (Купить абонемент, Узнать больше, Записаться)

#### Раунд 4: JS lazy-loading + видео превью
- [x] **Swiper+Fancybox JS** — убраны из footer.php, загружаются динамически через IntersectionObserver
  - Swiper 41KB + Fancybox 42KB = 83KB не грузятся при начальной загрузке
  - Загрузка при скролле к секциям .presentation / .gallery-inter / .review
- [x] **Click interceptor** — перехват кликов по `[data-fancybox]`, загрузка по требованию
- [x] **screenshot_4.webp** — 1916×968 (76KB) → 500×255 (9KB)
- [x] **Убран pollUntilReady** — polling loop заменён на IntersectionObserver

### Итого экономия (все раунды):
- Font Awesome: -270KB, -1 запрос
- Google Fonts: -54KB, -2 запроса
- Slider images: -950KB (14 изображений)
- Swiper+Fancybox JS: -83KB начальной загрузки (2 запроса отложены)
- Video preview: -67KB (76KB → 9KB)
- **Общая экономия: ~1.4MB, 5 запросов меньше/отложено**

---

## Специфика форм

### Contact Form 7 (ID: 69)
- Встраивается через ACF Flexible Content поле в секции CTA
- Honeypot: скрытое поле `hp_website` (position:absolute, left:-9999px)
- Timestamp: скрытое поле `form_start_time`, минимальная задержка 3 секунды
- reCAPTCHA: отключена (скрипты dequeued), verification bypassed
- CF7 Telegram: плагин cf7-telegram для уведомлений
- Admin email: gerasimromanoff@yandex.ru (из wp_options)
- REST endpoint: `/wp-json/contact-form-7/v1/contact-forms/69/feedback` — работает

---

## Последние изменения (2026-06-01)

### Приоритет 0: Формы и Метрика
- Восстановлен код Яндекс.Метрики (82867762) напрямую в header.php
- Проверен CF7 REST API — endpoint работает, возвращает validation_failed
- Добавлен defer для jQuery, удалён jQuery Migrate
- Добавлена async загрузка для CF7 CSS

### Приоритет 1: Nginx + Redis
- Настроен FastCGI Cache (зона FASTCGI)
- wp-json, wp-admin, POST исключены из кэша
- X-Cache заголовки добавлены
- Redis Object Cache подтверждён (261 ключей, drop-in активен)
- Обновлён nginx.conf (TLSv1.2+TLSv1.3 только)

### Приоритет 2: LCP/CLS и блокирующие ресурсы
- Все JS скрипты получили defer
- Все CSS загружаются асинхронно
- Добавлены width/height для всех значимых img
- loading=lazy для ниже-фолд изображений
- aspect-ratio CSS для CLS фиксов
- Удалены emoji скрипты и лишние head элементы

### Приоритет 3: Шрифты, иконки, изображения
- Google Fonts ограничен до 400;700
- Font Awesome заменён на inline SVG
- Bootstrap CSS удалён, стили в inline `<style>`
- Slider изображения используют WordPress thumbnails (-240x300)
- Функция `testerossa_get_thumb_url()` для автоматического ресайза

---

## Известные предупреждения

- **Speculation Rules API** — WordPress 6.4+ добавляет `<script type="speculationrules">`. Удалён через `remove_action`.
- **jquery.maskedinput.js** — загружается для CF7 phone mask, но main.js имеет vanilla JS маску. Можно удалить, если vanilla маска покрывает все поля.
- **SMTP настроен** — Beget smtp.beget.com:465 (SSL), без плагина, через phpmailer_init в functions.php
  - Отправитель: clients@chastnyj-detskij-sad-stavropol.ru
  - Пароль: KajO%j3DBuV%
  - Получатель (admin_email): gerasimromanoff@yandex.ru
- **Postfix неактивен** — не нужен, используется SMTP через Beget
- **WP_CRON отключён** — нужен системный cron: `*/5 * * * * cd /var/www/chastnyj-detskij-sad-stavropol.ru && php wp-cron.php > /dev/null 2>&1`

---

## Конфигурационные файлы

- Nginx site: `/etc/nginx/sites-available/chastnyj-detskij-sad-stavropol.ru.conf`
- Nginx main: `/etc/nginx/nginx.conf`
- FastCGI cache config: `/etc/nginx/conf.d/fastcgi-cache.conf`
- WordPress: `/var/www/chastnyj-detskij-sad-stavropol.ru/wp-config.php`
- Тема: `wp-content/themes/testerossa/` (Underscores (_s) based)
