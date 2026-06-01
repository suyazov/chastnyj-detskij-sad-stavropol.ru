# Проект: chastnyj-detskij-sad-stavropol.ru

## Сервер
- SSH: `ssh serv` (85.198.97.13)
- Путь: `/var/www/chastnyj-detskij-sad-stavropol.ru`
- Nginx + PHP-FPM + Redis

## PageSpeed (2026-06-01, мобильный Moto G Power, 4G)
- **FCP: 0.9s** | **LCP: 2.2s** | **TBT: 10ms** | CLS: 0.182 | **SI: 1.6s**
- Performance: ~85 | Accessibility: 97 | SEO: 92
- Стартовые: FCP 2.7s | LCP 14.5s | TBT 110ms | CLS 0 | SI 12.3s

## Цель: ✅ LCP < 2.5s | ✅ TBT < 200ms | CLS = 0 | SEO ≥ 95 | Accessibility ≥ 90

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

## Выполненные оптимизации (2026-06-01)

### Раунд 1: Критические исправления
- Яндекс.Метрика — напрямую в header.php, `window.addEventListener('load')`
- jQuery Migrate — удалён, все JS — defer
- CSS async (swiper/fancybox/responsive) через media=print + onload
- Emoji/wp_head мусор — удалён
- LCP preload для main.webp, FastCGI Cache + Redis, WebP через nginx
- Honeypot + timestamp вместо reCAPTCHA, ARIA атрибуты

### Раунд 2: Шрифты и иконки
- Google Fonts: 300..900 → 400;700
- Font Awesome (270KB) → inline SVG (7 иконок)
- Stale preconnect к ka-f.fontawesome.com — удалён

### Раунд 3: Изображения и CSS
- Bootstrap CSS оставлен (попытка удаления ломает верстку)
- Slider thumbnails: `testerossa_get_thumb_url()` → 240x300 (-950KB)
- width/height на всех img, loading=lazy (50 изображений)
- CTA кнопки → `#cta`

### Раунд 4: Self-hosted шрифт + Accessibility
- **Roboto self-hosted** — variable woff2, cyrillic subsets (51KB)
- Убран Google Fonts CDN (-750ms render-blocking, -2 DNS lookup)
- screenshot_4.webp: 76KB → 9KB
- Accessibility: alt, aria-label на boss-img, review, CTA links

### Раунд 5: setTimeout lazy-loading (КЛЮЧЕВОЙ)
- **Swiper+Fancybox убраны из defer**, загружаются через `setTimeout(0)` в main.js
- Fancybox загружается первым (для видео), Swiper после (для галерей)
- Это убрало 2s LCP render delay: скрипты больше не блокируют первый paint
- `font-display: optional` вместо `swap` — убирает CLS от font swap

### Итого экономия:
- Font Awesome: -270KB
- Google Fonts CDN: -750ms blocking
- Slider thumbnails: -950KB
- Swiper+Fancybox: -2s LCP render delay (загрузка после paint)
- **LCP: 14.5s → 2.2s (-85%)**, **SI: 12.3s → 1.6s (-87%)**

---

## Оставшиеся проблемы

### CLS 0.182 (font swap → optional fix pending)
- `font-display: optional` применён — при следующем замере CLS должен быть 0
- Первый визит: системный шрифт (без сдвига), последующие: Roboto из кэша

### Unused CSS (30KB)
- bootstrap.min.css: 29.9KB unused — удалить нельзя (ломает верстку)

### Unused JS (109KB)
- fancybox.umd.js: 37KB unused — загружается после paint, не блокирует
- swiper-bundle.min.js: 25KB unused — загружается после paint
- Yandex Metrika: 46KB unused — сторонний, уже в window.load

### Accessibility (97)
- Контрастность: зелёные кнопки (.green-btn) и цветные цифры (.num) — низкий контраст
- Одинаковые aria-label у gallery ссылок

### SEO (92)
- Логотип logo.png: 64x53px при отображении 70x58 — нужен 2x вариант

---

## Ключевые файлы темы

- `header.php` — inline критический CSS, self-hosted Roboto @font-face, Метрика
- `footer.php` — offcanvas, только bootstrap defer
- `templates/main.php` — ACF Flexible Content, все секции, slider thumbnails
- `js/main.js` — vanilla: mask, offcanvas, accordion, tooltips, smooth scroll, setTimeout(Swiper+Fancybox)
- `functions.php` — testerossa_get_thumb_url(), SMTP, CF7, spam protection
- `style.css` — основной CSS (без @import)
- `fonts/roboto-cyrillic-ext.woff2` + `fonts/roboto-cyrillic.woff2`

## Уроки

1. **Bootstrap CSS удалять нельзя** — десятки утилит, попытка inlining сломала верстку
2. **Swiper+Fancybox lazy-loading через IO** — нестабильно, ломает галереи
3. **setTimeout(0) для неблокирующих скриптов** — надёжно и просто, убрал 2s LCP delay
4. **font-display: optional** вместо swap — убирает CLS, но первый визит без кастомного шрифта
5. **Приоритет стабильности** — 83KB Swiper+Fancybox после paint лучше чем ломать UX
