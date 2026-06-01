# Проект: chastnyj-detskij-sad-stavropol.ru

## Сервер
- SSH: `ssh serv` (85.198.97.13)
- Путь: `/var/www/chastnyj-detskij-sad-stavropol.ru`
- Nginx + PHP-FPM + Redis

## Текущие показатели (до оптимизации): Performance: 62 | Accessibility: 83 | SEO: 85
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
- [x] **Яндекс.Метрика** — код вставлен напрямую в header.php (ID: 82867762), обёрнут в `window.addEventListener('load')`, не блокирует рендеринг
- [x] **jQuery Migrate** — удалён (defer для jQuery core)
- [x] **Все JS скрипты** — defer: jQuery, CF7, Swiper, Fancybox, FontAwesome, main.js
- [x] **Bootstrap CSS** — async загрузка (media=print + onload)
- [x] **Swiper/Fancybox CSS** — async загрузка
- [x] **CF7 CSS** — async через style_loader_tag фильтр
- [x] **responsive CSS** — style-sm.css, style-md.css async
- [x] **Emoji скрипты** — удалены из wp_head
- [x] **Неиспользуемые head элементы** — wp_generator, wlwmanifest, rsd, shortlink, rest_output_link, oembed
- [x] **LCP preload** — link rel=preload для screenshot_4.webp
- [x] **width/height для изображений** — logo, main-arrow, logo-big, main-icons, video preview, bullets, year, methods, reviews, faq, gallery
- [x] **loading=lazy** — для всех ниже-фолд изображений
- [x] **CLS fixes** — aspect-ratio для .main-section, .main__item, .imagine__item, .year__item, .review__item и др.
- [x] **FastCGI Cache** — Nginx кэширование HTML страниц
- [x] **Redis Object Cache** — drop-in активен, 261+ ключей
- [x] **WebP через Nginx** — try_files для uploads, Vary: Accept
- [x] **Honeypot + timestamp** — защита от спама вместо reCAPTCHA
- [x] **CF7 REST API** — работает, wp-json исключён из кэша
- [x] **ARIA атрибуты** — формы, соцсети, иконки

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

### Приоритет 3: Изображения и документация
- WebP автоматически через nginx try_files (63 webp из 318 изображений)
- Nginx отдаёт WebP с Vary: Accept
- main.js обновлён: polling для deferred библиотек, init guards

---

## Известные предупреждения

- **Speculation Rules API** — WordPress 6.4+ добавляет `<script type="speculationrules">`. Не блокирует рендеринг (JSON, не JS). Не удалён намеренно (полезен для prefetch).
- **jquery.maskedinput.js** — загружается для CF7 phone mask, но main.js имеет vanilla JS маску. Можно удалить, если vanilla маска покрывает все поля.
- **Postfix неактивен** — почтовый сервер не настроен. CF7 письма могут не отправляться. Рекомендуется: SMTP плагин (WP Mail SMTP) или активация Postfix.
- **WP_CRON отключён** — нужен системный cron: `*/5 * * * * cd /var/www/chastnyj-detskij-sad-stavropol.ru && php wp-cron.php > /dev/null 2>&1`

---

## Конфигурационные файлы

- Nginx site: `/etc/nginx/sites-available/chastnyj-detskij-sad-stavropol.ru.conf`
- Nginx main: `/etc/nginx/nginx.conf`
- FastCGI cache config: `/etc/nginx/conf.d/fastcgi-cache.conf`
- WordPress: `/var/www/chastnyj-detskij-sad-stavropol.ru/wp-config.php`
- Тема: `wp-content/themes/testerossa/` (Underscores (_s) based)
