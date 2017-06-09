# Документация

### Оглавление

* CSS
    * Технология
    * Структура базового CSS-файла
    * Использование переменных
    * Адаптивная верстка
    * Колоночная структура
    * Именование файлов стилей
    * Именование компонентов и их миксинов
    * Placeholders
    * Именование классов
* Шаблоны
    * Структура
    * Переменные в шаблонах
    * Стандартные шаблоны

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

##### Использование переменных

Переменные проекта должны начинаться с _`$g_varName`_ и использовать _`camelCamp`_ в названии. Название глобальной основной переменной выглядит так: _`$g_varName`_.

Для удобства стоит группировать переменные в мапы/хэши и создавать функции с соответствующими названиями для простоты их использования.

Например: 

* _`/project/_project_vars.scss`_
```scss
$g_fonts:(
        proxima: "'proxima-nova',Helvetica,Arial,sans-serif",
        georgia: "Georgia, 'Times New Roman', Times, serif"
);
```
* _`/project/_project_functions.`_ (**!!! Названия ф-й для получения базовой глобальной переменной должны начинаться с `_`**)
```scss
@function font($var){
  @return map_get($g_fonts,$var);
}
```

* _`/block/_block_advertisement.scss`_
```scss
@mixin advertisement-xs(){
  /** google ad xs */
  .advertisement{
    …

    .text{
      …
      font-family: font(proxima);
…
    }
  }
}
```

Переменные, используемые в компоненте, объявляются непосредственно в нем, при помощи шаблона (с названиями полей соответствующими _emmet-сокращениями_ аналогичных _css-свойств_) и прилегающей к нему функции:

```scss
// fn exa
$e_Exa:(
  c: color(empty),

  bgc: bgc(empty),
  bgi: bgi(empty),

  w: width(empty),
  h: height(empty),

  fw: font(w,empty),
  ff: font(f,empty),
  fz: font(s,empty),
  lh: font(lh,empty),

  pl: ind(empty),
  pr: ind(empty),
  pt: ind(empty),
  pb: ind(empty),

  ml: ind(empty),
  mr: ind(empty),
  mt: ind(empty),
  mb: ind(empty)
);
@function exa($var){
    @return map_get($e_Exa,$var);
}
```

Для подключения нужно:

1. Подключить новый файл к основному _`(css.scss)`_
2. Сделать подключение _`(@include)`_ соответствующего миксина в соответствующую ему секцию вьюпорта

##### Адаптивная верстка

Для адаптивной верстки выбрана схема *mobile-first*. Также были установлены следующие периоды:

* без _`@media`_ - **`xs`** (Базовые стили для всех)
* _`min-width: 500px`_ - **`sm`** (стили для мобильных с большим экраном типа iphone 6s plus)
* _`min-width: 768px`_ - **`md`** (планшеты)
* _`min-width: 1025px`_ - **`lg`** (десктопы)
* _`min-width: 1260px`_ - **`xl`** (большие экраны)
* _`max-width: 1024px`_ - **`dev`** (для девайсов)
* _`max-width: 767px`_ - **`mob`** (только для всех мобильных)
* _`max-width: 499px`_ - **`xso`** (только для мобильных с маленьким экраном)
* _`(min-width: 500px) and (max-width: 767px)`_ - **`smo`** (только для мобильных с большим экраном типа iphone+)
* _`(min-width: 768px) and (max-width: 1024px)`_ - **`mdo`** (только для планшетов)
* _`(min-width: 1025px) and (max-width: 1259px)`_ - **`lgo`** (только для десктопов с большими экранами)

Для каждого периода в разделах и подразделах и компонентах стоит добавлять суффикс названия периода в котором этот раздел находиться.

##### Колоночная структура

За основу принята 12-ти колоночная структура, где классы колонок именуются следующим образом: 

_`.col-[[xs|sm|md|lg|xl|xso|mob|dev|smo|mdo|lgo]-]N`_

где `N` это номер колонки от 1 до 12.

Разменость колонок принята классическая:

```css
.col-1 {
    width: 8.333333333%;
}

.col-2 {
    width: 16.666666667%;
}

.col-3 {
    width: 25%;
}

.col-4 {
    width: 33.333333333%;
}

.col-5 {
    width: 41.666666667%;
}

.col-6 {
    width: 50%;
}

.col-7 {
    width: 58.333333333%;
}

.col-8 {
    width: 66.666666667%;
}

.col-9 {
    width: 75%;
}

.col-10 {
    width: 83.333333333%;
}

.col-11 {
    width: 91.666666667%;
}

.col-12 {
    width: 100%;
}
```

##### Именование файлов стилей

Файл элемента: *`_[имя-категории]_[имя-класса].scss`*

Например:

1. `/lists/_lists_tag.scss`
2. `/blocks/_blocks_author.scss`
3. `/helpers/_helpers_video-container`

Если *имя-категории* и *имя-класса* совпадают, допускается имя категории опустить

##### Приставки файлов _[имя-категории]_ файлов по разделам

Ниже приведен список категорий с соответствующими им _именами-категорий_ или их _сокращениями_

* **Typography** - _`tpg`_ (стили базовой типографики, базовые списки, базовые ссылки, стилизация тегов `html` и `body`)
* **Helpers** - _`hlp`_ (стили вспомагательных классов, так называемые *хелперы*)
* **Structure** - _`str`_ (стилизация структуры страницы)
* **Form** - _`form`_ (стилизация форм)
* **Table** - _`tbl`_ (стилизация таблиц)
* **Buttons** - _`btn`_ (стилизация кнопок, и отдельных декоративных ссылок)
* **Lists** - _`list`_, _`nav`_ (стилизация кастомных списков и навигации)
* **Blocks** - _`block`_, _`blocks`_ (стилизация отдельно взятых блоков и их групп)
* **Other** - _`page`_ (уникальные стили для отдельных страниц)

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

##### Именование компонентов и их миксинов

Миксины должны именоваться по названию компонента, который они описывают с учетом разрешения экрана, с объяснением в виде комментария в одну строку с указанием файла и разрешения экрана

Например: _`/** paragraph example2-class-name xs */`_

Все нетипичные заготовленные блоки должны храниться в своем файле (**_`/core/mixins/_[cat-name]-[mixin-name].sass`_**) и подключаються в заглавный файл для миксинов (**_`/core/_project_mixins.sass`_**) и первое слово миксина должно содержать **название роздела** в котором он находиться.

Например:

1. _`@mixin structure-col(…){…}`_
2. _`@mixin structure-col-flex(…){…}`_
3. _`@mixin helpers-clearfix(…){…}`_

##### Placeholders

Используем для объединения групп одинаковых *CSS-стилей*

Используем 3 уровня привязки плейсхолдеров:

1. Базовые (которые подключаются сразу при создании проекта, по-умолчанию)
2. Проектные (которые создаются по необходимости и воздействуют на весь проект)
3. Локальные/Местные (которые применяются к конкретно-взятому определенному месту в проекте)

**Базовые:**

* **Path:** _`/core/base/placeholders/elements/`_
* **File Name mask:** _`_plb_[category-name]_[placeholder-name].scss`_
* **Placeholder (mixin) Name mask:** _`plb_[category-name]_[placeholder-name]`_
* **Placeholder name mask:** _`%plb_[category-name]_[placeholder-name]`_

Подключение аналогично плейсхолдера проекта только в папке _`/core/base/placeholders/`_

**Проектные**

* **Path:** _`/core/placeholders/elements/`_
* **File Name mask:** _`_pl_[category-name]_[placeholder-name].scss`_
* **Placeholder (mixin) Name mask:** _`pl_[category-name]_[placeholder-name]`_
* **Placeholder name mask:** _`%pl_[category-name]_[placeholder-name]`_

Подключение нового placeholder в проекте:

1. Создаем файл в _`/core/placeholders/elements/`_
2. Заготовка (содержание файла _`css/sass/core/placeholders/elements/_pl-example2.scss`_):
```scss
// @include pl_blocks_example-name-xs;
// @include pl_blocks_example-name-sm;
// @include pl_blocks_example-name-md;
// @include pl_blocks_example-name-lg;
// @include pl_blocks_example-name-xl;
// @include pl_blocks_example-name-xso;
// @include pl_blocks_example-name-mob;
// @include pl_blocks_example-name-dev;
// @include pl_blocks_example-name-smo;
// @include pl_blocks_example-name-mdo;
// @include pl_blocks_example-name-lgo;

@mixin pl_blocks_example-name{
  //some css was here
}

//---------------------------//
@mixin pl_blocks_example-name-xs{
  %pl_blocks_example-name-xs{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-sm{
  %pl_blocks_example-name-sm{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-md{
  %pl_blocks_example-name-md{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-lg{
  %pl_blocks_example-name-lg{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-xl{
  %pl_blocks_example-name-xl{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-xso{
  %pl_blocks_example-name-xso{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-mob{
  %pl_blocks_example-name-mob{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-dev{
  %pl_blocks_example-name-dev{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-smo{
  %pl_blocks_example-name-smo{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-mdo{
  %pl_blocks_example-name-mdo{
    @include pl_blocks_example-name;
  }
}
@mixin pl_blocks_example-name-lgo{
  %pl_blocks_example-name-lgo{
    @include pl_blocks_example-name;
  }
}
```
3. Подключить (_`@import`_) новый файл в _`/core/_project_placeholders.scss`_
4. Подключить (_`@include`_) новый файл в
    1. _`/core/_project_placeholders.scss`_ в соответствующий _`pl-multyblock`_ если надо чтобы групировка происходила в начале медиа роздела
    2. или _`/core/placeholders/category/_[category-name].scss`_ если надо чтобы группировка происходила в начале соответствующего **раздела/подраздела**
    
**Локальные/Местные**

Так же для локальных группировок стилей между несколькими блоками внутри одного блока можно создавать так называемые локальные плейсхолдеры название которых должно состоять из: _`%pll-[base-class-name]`_.

Стили для такого плейсхолдера прописываются внутри соответствующего миксина в файле блока.

##### Именование классов

Первое слово в классе должно быть определено разделом или подразделом css, кроме подразделов _`other`_ и _`structure`_.

Классы блоков стоит именовать по принципу **уникального** и **понятного** названия блока.

Классы внутри блока стоит именовать по принципу **ОО** _(обектно-ориентированого)_ стиля.

Также могут быть использованы универсальные названия классов (например `.description`), но к таким классам **должно быть каскадное указание блока в котором этот класс находиться**.

Умеренное использование каскадов имеет место быть. **Умеренным количеством каскада можно считать 3 уровня +-1**.

Типичный пример: 
1. _`.list-block-name .item .title`_
2. _`.list-block-name > .item > .title`_
3. _`.list-block-name .item + .item`_

### Шаблоны

В качестве предворительной шаблонизации был выбран язык **PHP**.

##### Структура

1. Основной шаблон _`index.php`_

```php
<?
ini_set('error_reporting', E_ALL);

if($_GET['compile']==1){
    chmod(__DIR__.'/html/',0777);
    $dirs = scandir('./');
    foreach ($dirs as $dir) {
        if($dir == '.' || $dir == '..' || !preg_match('/page\-(.*)\.php/',$dir,$page)) continue;
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/';
        $html = file_get_contents($url.'?page='.$page[1]);
        file_put_contents(__DIR__.'/html/page-'.$page[1].'.html',$html);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/css/css.css" />

    <script src="/js/js.js"></script>
</head>
<body>
        <?
        include "page-".$_GET['page'].".php";
        ?>
</body>
</html>
```

2. Шаблон страницы _`page-[name].php`_
```php
<!-- page-example START -->
<h1>Example page</h1>
<? include __DIR__ . "/templates/sasscat_example.php"; ?>
<? include __DIR__ . "/templates/sasscat_example2.php"; ?>
<!-- page-example END -->
```

3. Шаблон блока _`/templates/[sass-category]_[main-class-name].php`_
```php
<!-- sasscat_example START -->
Html code was here
<!-- sasscat_example END —>
```

##### Переменные в шаблонах

В шаблонах можно использовать переменную для каких-то особенностей шаблона или передачи стандартных данных для визуализации. Название этой переменной должно быть по названию файла (только вместо - стоит использовать _`_`_). Тип: **ассоциативный массив**.

В начале шаблона должно быть описание переменной. 
В начале и в конце верстки **должен присутствовать комментарий с указанием начала и конца блока**.

Пример:

/templates/sasscat_example.php

```php
<?php
/**
 * @param
 */
// дефолтные данные
$sasscat_example_def = array(
);


if(!empty($sasscat_example)){
    $sasscat_example = array_merge($sasscat_example_def,$sasscat_example);
}else{
    $sasscat_example = $sasscat_example_def;
}
?>
<!-- sasscat_example START -->
<p>Example text was here</p>
<!-- sasscat_example END -->
<?php
if(!empty($sasscat_example)) {
    $sasscat_example = $sasscat_example_def;
}
?>
```

Чтобы подключить шаблон нужно просто сделать _`include`_:

```php
<div class="site page-product">
    <section class="article clearfix">
        <!-- Page Header START -->
        <header class="page-header clearfix">
            <div class="col-sm col-sm-8 ind-col-left">
                <h1>GOLO Reviews</h1>
                <?
                $block_review['shema.org'] = 1;
                include "templates/block_review.php";
                ?>
            </div>
…
```

##### Стандартные шаблоны

Для того чтобы учесть базовые элементы используються стандартные шаблоны:

* _`preview_form.php`_
* _`preview_table.php`_
* _`preview_tpg.php`_

Эти файлы содержат полный набор часто используемых стандартных элементов.

Также в случае создания какого-то блока который заведомо не будет использован (например блок определяющий какие-то особенные стили внутри статьи которая будет находиться в базе либо еще где-то) стоит поместить его в файл _`tmp_[sass-cat-name]_[main-class-name].php`_