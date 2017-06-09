# Документация

### CSS

##### Технология

За основу выбран препроцессор SCSS (для удобства дебаггинга версии не ниже 3.3). на каждый блок должен быть создан отдельный файл который именуется так же как и параграф этого блока.

Внутри файла стилей должна быть организована базовая конструкция файла, в каждом разделе которого создается миксин, который должен называться по имени файла. А для адаптивной верстки: __*[имя файла]-[название периода viewport'a]*__ стили которого в нем находяться. (например: `block-adaptive-md`).

Стили под каждое разрешение экрана оборачиваются в соответствующие миксины, которые затем подключаются в нужных местах базового файла **`./css/css.css`**

##### Структура базового CSS-файла

Конечная структура выглядит следующим образом:

```css
/**
## Typography
    styles for default html tags and similar classes
*/

/**
## helpers
*/

/**
## common
universal classes what can be used every where on site
*/
/*
    structure
    styles for main page construction
*/

/*
    forms
*/

/*
    tables
*/

/*
    buttons
*/

/*
    lists
*/

/*
    blocks
*/

/**
## elements
styles for different blocks and elements on site
*/
/*
    other
*/

/**
## Media queries
mobile first structure
**/
@media only screen and (min-width: 500px) {
   …
}

@media only screen and (min-width: 768px) {
    …
}

@media only screen and (min-width: 1025px) {
    …
}

@media only screen and (min-width: 1260px) {
    …
}

@media only screen and (max-width: 1024px) {
    …
}

@media only screen and (max-width: 767px) {
    …
}

@media only screen and (max-width: 499px) {
    …
}

@media only screen and (min-width: 500px) and (max-width: 767px) {
    …
}

@media only screen and (min-width: 768px) and (max-width: 1024px) {
    …
}

@media only screen and (min-width: 1025px) and (max-width: 1259px) {
    …
}
```
Каждый *медиа-запрос* имеет такую же структуру комментариев

Для удобства разработки в каждом разделе/подразделе пространство для подключений миксинов _`(@include)`_ оборачиваем в комментарии:
```scss
// CATEGORY BLOCKS START
…
// CATEGORY BLOCKS END
```

##### Именование файлов

Файл элемента: *`_[имя-категории]_[имя-класса].scss`*

Например:

1. `/lists/_lists_tag.scss`
2. `/blocks/_blocks_author.scss`
3. `/helpers/_helpers_video-container`

Если *имя-категории* и *имя-класса* совпадают, допускается имя категории опустить

##### Приставки файлов _[имя-категории]_ файлов по разделам

Ниже приведен список категорий с соответствующими им _именами-категорий_ или их _сокращениями_

* Typography - tpg (стили базовой типографики, базовые списки, базовые ссылки, стилизация тегов `html` и `body`)
* Helpers - hlp (стили вспомагательных классов, так называемые *хелперы*)
* Structure - str (стилизация структуры страницы)
* Form - form (стилизация форм)
* Table - tbl (стилизация таблиц)
* Buttons - btn (стилизация кнопок, и отдельных декоративных ссылок)
* Lists - list, nav (стилизация кастомных списков и навигации)
* Blocks - block, blocks (стилизация отдельно взятых блоков и их групп)
* Other - page (уникальные стили для отдельных страниц)

Примеры использования:

```scss
/**
## Typography
styles for default html tags and similar classes
*/
_tpg_texts.scss
// .text-XXX, .label-XXX, .message-XXX, .link-XXX

_tpg_tags.scss
// базовые стили для тегов конструктивного (body,html,*) и текстового назначения

/**
## helpers
*/
_hlp_[class-name].scss

/**
## common
universal classes what can be used every where on site
*/
/*
    structure
    styles for main page construction
*/
_str_[class-name].scss

/*
    forms
*/
_form-[class-name].scss

/*
    tables
*/
_tbl-[class-name].scss

/*
    buttons
*/
_btn-[class-name].scss

/*
    lists
*/
_list-[class-name].scss
_nav-[class-name].scss

/*
    blocks
*/
_blocks_[class-name].scss
_block-[class-name].scss

/**
## elements
styles for different blocks and elements on site
*/
/*
    other
*/
_page-[class-name].scss
// уникальные стили для страниц и может быть чего-то еще =)
```
