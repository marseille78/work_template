# Документация

### CSS

##### Технология

За основу выбран препроцессор SCSS (для удобства дебаггинга версии не ниже 3.3). на каждый блок должен быть создан отдельный файл который именуется так же как и параграф этого блока.

Внутри файла стилей должна быть организована базовая конструкция файла, в каждом разделе которого создается миксин, который должен называться по имени файла. А для адаптивной верстки: __*[имя файла]-[название периода viewport'a]*__ стили которого в нем находяться. (например: `block-adaptive-md`).

Стили под каждое разрешение экрана оборачиваются в соответствующие миксины, которые затем подключаются в нужных местах базового файла **`./css/css.css`**

##### Структура базового CSS-файла

Конечная структура выглядит следующим образом:

```css
/** IMPORT BLOCK FILES
## Vendor
    Import variables, functions, placeholders and mixins.
    
## Components
    Import files with component's styles
*/

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
