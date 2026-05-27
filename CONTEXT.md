# Проект: chastnyj-detskij-sad-stavropol.ru

## Сервер
- SSH: ssh serv (85.198.97.13)
- Путь: /var/www/chastnyj-detskij-sad-stavropol.ru

## Текущие показатели (Мобильные): Performance: 62 | Accessibility: 83 | SEO: 85
## Цель: Performance: 90+ | Accessibility: 95+ | SEO: 100

## Инфраструктура
- Nginx + Redis
- SSL: Let's Encrypt

---

## ВЫПОЛНЕНО
- [x] Изображения 404 (скопированы main-arrow.png, down-arrow.png)
- [x] WebP редирект удален (nginx конфиг упрощен)
- [x] WebP файлы созданы (cwebp)
- [x] Fancybox настроен для галерей и видео
- [x] CONTEXT.md добавлен в репозиторий
- [x] Видео стриминг: mp4 модуль + Accept-Ranges (HTTP 206)

---

## ПРИОРИТЕТ 1: Серверная оптимизация (Nginx + Redis) - ВЫПОЛНЕНО
- [x] Cache-Control для статики
- [x] Gzip включen
- [x] Redis Object Cache активен

---

## ПРИОРИТЕТ 2: Удаление Google reCAPTCHA - В РАБОТЕ
- [ ] Удалить плагин reCAPTCHA
- [ ] Добавить honeypot + timestamp защиту в формы

---

## ПРИОРИТЕТ 3: Создание страницы 404
- [ ] Создать 404.php в теме
- [ ] Легковесный дизайн без тяжелых скриптов

---

## ПРИОРИТЕТ 4: Оптимизация изображений и LCP
- [x] Favicon создан
- [ ] Адаптивные размеры галереи
- [ ] LCP оптимизация

---

## ПРИОРИТЕТ 5: Блокирующий рендеринг CSS/JS
- [ ] Critical CSS для шапки
- [ ] Async CSS
- [ ] Preconnect
- [ ] Defer для JS

---

## ПРИОРИТЕТ 6: Accessibility
- [ ] ARIA атрибуты в форме
- [ ] Alt для изображений
- [ ] Aria-label для иконок
- [ ] Контрастность кнопок

---

## ПРИОРИТЕТ 7: SEO
- [ ] Meta description
