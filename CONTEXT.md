# Проект: chastnyj-detskij-sad-stavropol.ru

## Сервер
- SSH: `ssh serv` (85.198.97.13)
- Путь: `/var/www/chastnyj-detskij-sad-stavropol.ru`
- Nginx + PHP-FPM + Redis

## PageSpeed итог (2026-06-01, мобильный Moto G Power, 4G)
- FCP ~1.5s | LCP ~5s | TBT ~30ms | CLS 0 | SI ~5s
- Стартовые: FCP 2.7s | LCP 14.5s | TBT 110ms | CLS 0 | SI 12.3s
- **LCP -65% | SI -60% | TBT -73%**

---

## Архитектура

### Nginx
- SSL: Let's Encrypt (TLSv1.2 + TLSv1.3)
- FastCGI Cache: зона FASTCGI (100m), 60min inactive, 1GB max
- Статика: Cache-Control `public, immutable`, max-age=31536000
- WebP: `try_files $uri.webp $uri`

### Redis
- Redis Object Cache: активен (drop-in), база 2

---

## Выполненные оптимизации

### Шрифты и иконки
- Font Awesome (270KB) → inline SVG (7 иконок)
- Roboto self-hosted: variable woff2, cyrillic subsets (51KB), font-display: optional
- Google Fonts CDN убран (-750ms blocking, -2 DNS lookup)

### Изображения
- Slider thumbnails: 700×875 → 240×300 через testerossa_get_thumb_url() (-950KB)
- screenshot_4.webp: 1916×968 → 500×255 (76KB → 9KB)
- width/height на всех img, loading=lazy (50 изображений)

### JavaScript
- Swiper+Fancybox: загружаются через setTimeout(0) после paint (не блокируют LCP)
- Fancybox первым (видео), Swiper после (галереи)
- jQuery Migrate удалён, все скрипты defer
- main.js: vanilla (mask, offcanvas, accordion, tooltips, smooth scroll)

### CSS
- Bootstrap CSS async (media=print onload) — удаление ломает верстку
- Swiper/Fancybox CSS async
- Inline критический CSS в header.php

### Инфраструктура
- FastCGI Cache + Redis Object Cache
- WebP через nginx try_files
- Honeypot + timestamp вместо reCAPTCHA
- SMTP Beget без плагина

---

## Ключевые файлы темы

- `header.php` — inline CSS, Roboto @font-face, Метрика
- `footer.php` — offcanvas, bootstrap defer, main.js defer
- `templates/main.php` — ACF Flexible Content, slider thumbnails, CTA → #cta
- `js/main.js` — vanilla JS, setTimeout(Swiper+Fancybox)
- `functions.php` — testerossa_get_thumb_url(), SMTP, CF7, spam protection
- `style.css` — основной CSS
- `fonts/roboto-cyrillic-ext.woff2` + `fonts/roboto-cyrillic.woff2`

## Уроки

1. Bootstrap CSS удалять нельзя — десятки утилит
2. IntersectionObserver lazy-loading — нестабильно, setTimeout надёжнее
3. font-display: optional — убирает CLS, первый визит без кастомного шрифта
4. setTimeout(0) для неблокирующих скриптов — убирает LCP render delay
