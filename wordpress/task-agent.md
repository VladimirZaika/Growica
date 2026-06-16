# Задача: Уникализация дочерней wordpress темы wordpress\wp-content\themes\pure-theme (pure-theme) 

## Контекст задачи
Мы кастомизируем дочернюю тему `pure-theme`. Необходимо уникализировать дочернюю тему, обновить названия css классов в scss файлах и php шаблонах, обновить названия функций js и php

**Стек:** Docker, WordPress, Advanced Custom Fields (ACF Pro), PHP 8.1, JS, SCSS, MySQL.

---

## Критерии приемки (Definition of Done)
- [ ] Группа полей ACF зарегистрирована через acf-json и хранятся по пути `wordpress\wp-content\themes\pure-theme\acf-json`.
- [ ] Ключ key для каждой группы зарегестрированных json-acfполей должны быть обновлены в папке `wordpress\wp-content\themes\pure-theme\acf-json`.
- [ ] Во всех .scss, .css, .js, .php, .html, .json, .txt файлах нужно заменить placeholder brand на актуальный, настоящий brand.

---

## Placeholders и их значения
- `brand` => `nexus`.
- `domain` => `https://nexus.ai`.
- `gtag_id` => `G-444AW5568`.

---

## Пошаговый план реализации (Инструкция для ИИ)

### Шаг 1: Работа с полями 
ACF
- [ ] Открой файл `wordpress\wp-content\themes\pure-theme\acf-json`.
- [ ] Обнови названия json файлов и ключей `key` внутри каждого файла, для уникализации групп полей acf.

### Шаг 2: Замена всех placeholder на актуальные значения
- [ ] Переименуй название папки с темой `pure-theme` по пути `wordpress\wp-content\themes\pure-theme` на название `nexus-theme`.
- [ ] внутри темы `wordpress\wp-content\themes\pure-theme`, новый путь которой будет выглядеть теперь так `wordpress\wp-content\themes\nexus-theme` выполни следющие действия. Во всех файлах темы замени placeholders `brand`, `domain`, `gtag_id` на актуальные значения из раздела ## Placeholders и их значения.
- [ ] Уникализируй файл `style.css` по пути `wordpress\wp-content\themes\pure-theme\style.css`. Уникализируй и обнови следующие значения:
  - `Theme Name:` укажи актуальный brand
  - `Theme URI:` укажи актуальный domain
  - `Description:` сгенерируй короткое описание до 100 символов.
  - `Author:` сгенерируй имя автора.
  - `Author URI:` сгенерируй ссылку на сайт автора. 
  - `Template:` укажи название родительской темы.
  - `Version:` сгенерируй версию темы.
  - `Text Domain:` укажи актуальный brand

### Шаг 3: Стилизация (CSS)
- [ ] Открой файл `wp-content/themes/nexus-portal/style.css`.
- [ ] Добавь стили для таблицы в самый конец файла:
  - Границы таблицы, отступы (`padding: 12px`), чередующийся фон строк (`:nth-child(even)`).
  - Названия характеристик должны быть жирными.
  - Используй CSS-переменные родительской темы для цветов, если они доступны.

---

## Ограничения и правила для Агента
- **Безопасность:** Обязательно очищай вывод данных через `esc_html()` для текстовых полей внутри таблицы.
- **Стиль кода:** Придерживайся WordPress Web Dev Standards (пробелы внутри круглых скобок: `if ( ! empty( $var ) )`).
- **Запрещено:** Не изменяй файлы родительской темы. Работай строго внутри папки дочерней темы `pure-theme`.
- **Логирование:** Если плагин ACF не активен, функция не должна вызывать Fatal Error, делай мягкий `return $content`.