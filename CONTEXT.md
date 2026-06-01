# Проект: chastnyj-detskij-sad-stavropol.ru

## Сервер
- SSH: `ssh serv` (85.198.97.13)
- Путь: `/var/www/chastnyj-detskij-sad-stavropol.ru`
- Nginx + PHP-FPM + Redis

## PageSpeed (2026-06-01, мобильный Moto G Power, 4G)
- **Performance: 69** | Accessibility: 88 | SEO: 92
- FCP: 2.7s | LCP: 6.1s | TBT: 80ms | CLS: 0 | SI: 5.4s
- Стартовые: FCP 2.7s | LCP 14.5s | TBT 110ms | CLS 0 | SI 12.3s

## Цель
Performance ≥ 80 (моб) | LCP < 2.5s | CLS 0 | SEO ≥ 95 | Accessibility ≥ 90

---

## Архитектура и Инфраструктура

### Nginx
- SSL: Let's Encrypt (TLSv1.2 + TLSv1.3)
- FastCGI Cache: зона FASTCGI (100m), 60min inactive, 1GB max
- Исключения из кэша: POST, wp-admin, wp-login, wp-json, logged-in users
- Статика: Cache-Control `public, immutable`, max-age=31536000
- WebP: `try_files $uri.webp $uri` для uploads (Vary: Accept)
- Gzip: text/css, application/javascript, image/svg+xml
- Security headers: X-Frame-Options, X-Content-Type-Options, X-XSS-Protection

### Redis
- Redis Object Cache: активен (drop-in)
- База: 2, префикс: `detsad_stv:`, хост: 127.0.0.1:6379

### PHP
- WP_CRON: отключён (нужен системный cron)
- WP_DEBUG: выключен

---

## Выполненные оптимизации (2026-06-01)

### Раунд 1: Критические исправления
- [x] Яндекс.Метрика — напрямую в header.php, `window.addEventListener('load')`
- [x] jQuery Migrate — удалён
- [x] Все JS — defer
- [x] CSS (swiper/fancybox/responsive) — async через media=print + onload
- [x] Emoji/wp_head мусор — удалён
- [x] LCP preload для main.webp
- [x] FastCGI Cache + Redis Object Cache
- [x] WebP через nginx try_files
- [x] Honeypot + timestamp вместо reCAPTCHA
- [x] ARIA атрибуты

### Раунд 2: Шрифты и иконки
- [x] Google Fonts: 300..900 → 400;700
- [x] Font Awesome (270KB) → inline SVG (7 иконок: telegram, whatsapp, vk, phone, bars, youtube ×2)
- [x] Stale preconnect к ka-f.fontawesome.com — удалён

### Раунд 3: Изображения и CSS
- [x] **Bootstrap CSS оставлен** — попытка удаления сломала верстку (множество утилит)
- [x] Slider thumbnails — `testerossa_get_thumb_url()` для 240x300 WordPress миниатюр (-950KB)
- [x] width/height на всех img — CLS = 0
- [x] loading="lazy" на всех ниже-фолд (50 изображений)
- [x] Font CLS fix — `@import` → `<link rel="preload">` + `<link rel="stylesheet">`, CLS: 0.182 → 0
- [x] CTA кнопки → `#cta` (Купить абонемент, Узнать больше, Записаться)

### Раунд 4: Self-hosted шрифт + Accessibility
- [x] **Шрифт Roboto self-hosted** — variable woff2, cyrillic-ext + cyrillic subsets (51KB)
  - Убраны: Google Fonts CDN (750ms blocking), 2 DNS lookup, preconnect hints
  - `@font-face` с `font-display: swap` и `unicode-range` прямо в inline `<style>`
- [x] screenshot_4.webp: 1916×968 (76KB) → 500×255 (9KB)
- [x] Accessibility: boss-img `alt="Фото руководителя"`, aria-label на review и CTA social links

### Раунд 5: JS lazy-loading (откатан)
- [ ] Swiper+Fancybox lazy-loading через IntersectionObserver — **не работает стабильно**, откатан
- [x] Swiper+Fancybox загружаются через `defer` в footer.php — надёжно
- [x] main.js переписан начисто: только pollUntilReady для Swiper+Fancybox init
- [x] Удалены: initLazyLibraries, IntersectionObserver, loadScripts, loadLibs, click interceptor

### Итого экономия (все раунды):
- Font Awesome: **-270KB**, -1 запрос
- Google Fonts CDN: **-54KB**, -2 запроса, -750ms blocking
- Slider thumbnails: **-950KB** (14 изображений)
- Video preview: **-67KB** (76KB → 9KB)
- **Общая экономия: ~1.3MB**, 3 запроса меньше

---

## Оставшиеся проблемы (PageSpeed)

### Render-blocking (1170ms)
- `style.css` — 200ms, основной файл темы (невозможно отложить)
- Google Fonts CSS — **устранён** (self-hosted)

### LCP render delay 1.86s
- Элемент: `<div class="main-section">` с background-image
- TTFB: 0ms, load: 290ms, render delay: 1860ms
- Причина: JS выполнение до первой отрисовки
- Возможные решения: отложить bootstrap.js, уменьшить main.js

### Unused JS (108KB)
- fancybox.umd.js: 42KB (37KB unused) — загружается всегда, нужен только по клику
- swiper-bundle.min.js: 41KB (25KB unused)
- Yandex Metrika: 86KB (46KB unused) — уже в window.load

### Unused CSS (30KB)
- bootstrap.min.css: 31KB (29.9KB unused) — удалить нельзя (ломает верстку)

### Yandex Metrika
- tag.js: 87KB, 1ч кэш, 257ms main thread
- Кэш короткий, но повлиять нельзя (сторонний)

---

## Специфика форм

### Contact Form 7 (ID: 69)
- ACF Flexible Content → секция CTA
- Honeypot: `hp_website` | Timestamp: `form_start_time` (3с мин)
- reCAPTCHA: отключена | CF7 Telegram: уведомления
- Admin: gerasimromanoff@yandex.ru
- REST: `/wp-json/contact-form-7/v1/contact-forms/69/feedback`

---

## Конфигурационные файлы

- Nginx site: `/etc/nginx/sites-available/chastnyj-detskij-sad-stavropol.ru.conf`
- Nginx main: `/etc/nginx/nginx.conf`
- WordPress: `wp-config.php`
- Тема: `wp-content/themes/testerossa/` (Underscores _s based)

## Ключевые файлы темы

- `header.php` — inline критический CSS, self-hosted Roboto @font-face, Метрика
- `footer.php` — offcanvas, Swiper/Fancybox/Bootstrap defer scripts
- `templates/main.php` — ACF Flexible Content, все секции, thumbnails для слайдеров
- `js/main.js` — vanilla: phone mask, offcanvas, accordions, tooltips, smooth scroll, pollUntilReady(Swiper+Fancybox)
- `functions.php` — testerossa_get_thumb_url(), testerossa_get_image_url(), SMTP, CF7 logging
- `style.css` — основной CSS (без @import, шрифт через inline @font-face)
- `css/bootstrap.min.css` — async через media=print onload
- `fonts/roboto-cyrillic-ext.woff2` + `fonts/roboto-cyrillic.woff2` — variable Roboto

## Уроки / Что не работает

1. **Bootstrap CSS удалять нельзя** — 232KB, но содержит десятки утилит (col-md-*, offcanvas, ratio, flex, justify-content, h-100, w-100, text-decoration-none, responsive breakpoints). Попытка inlining сломала верстку.
2. **Swiper+Fancybox lazy-loading через IntersectionObserver** — нестабильно, ломает галереи. Polling через pollUntilReady работает надёжно.
3. **Приоритет стабильности над экономией** — 83KB Swiper+Fancybox лучше грузить всегда, чем ломать UX.
