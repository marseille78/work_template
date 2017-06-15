# Документация

## Оглавление

* [Технология](https://github.com/marseille78/work_template#Технология)
* [Организация CSS](https://github.com/marseille78/work_template#Организация-css)
    * [Структура базового CSS-файла](https://github.com/marseille78/work_template#Структура-базового-css-файла)
    * [Использование переменных](https://github.com/marseille78/work_template#Использование-переменных)
    * [Адаптивная верстка](https://github.com/marseille78/work_template#Адаптивная-верстка)
    * [Колоночная структура](https://github.com/marseille78/work_template#Колоночная-структура)
    * [Именование файлов стилей](https://github.com/marseille78/work_template#Именование-файлов-стилей)
    * [Приставки файлов [имя-категории] файлов по разделам](https://github.com/marseille78/work_template#Приставки-файлов-имя-категории-файлов-по-разделам)
    * [Именование Миксинов](https://github.com/marseille78/work_template#Именование-Миксинов)
    * [Placeholders](https://github.com/marseille78/work_template#placeholders)
    * [Именование классов](https://github.com/marseille78/work_template#Именование-классов)
* [Организация HTML](https://github.com/marseille78/work_template#Организация-html)
    * [Структура](https://github.com/marseille78/work_template#Структура)
    * [Данные](https://github.com/marseille78/work_template#Данные)
    * [Функции](https://github.com/marseille78/work_template#Функции)
        * [getVars]()
        * [render]()
        * [variable]()
    * [Дебаггинг](https://github.com/marseille78/work_template#Дебаггинг)
    * [Стандартные шаблоны](https://github.com/marseille78/work_template#Стандартные-шаблоны)
* [Сборка проекта](https://github.com/marseille78/work_template#Сборка-проекта)

## Технология

Для стилизации проекта за основу выбран препроцессор SCSS (для удобства дебаггинга версии не ниже 3.3). на каждый блок должен быть создан отдельный файл который именуется так же как и параграф этого блока.

Для шаблонизации HTML-структтуры принят язык программирования PHP

## Организация CSS

Внутри файла стилей должна быть организована базовая конструкция файла, в каждом разделе которого создается миксин, который должен называться по имени файла. А для адаптивной верстки: __*[имя файла]-[название периода viewport'a]*__ стили которого в нем находяться. (например: `block-adaptive-md`).

Стили под каждое разрешение экрана оборачиваются в соответствующие миксины, которые затем подключаются в нужных местах базового файла **`./css/css.css`**

### Структура базового CSS-файла

Базовая конструкция основного файла css должна иметь вид:

Структуру комментариев:

```scss
1. Разделы. Например:
/**
## Typography
styles for default html tags and similar classes
*/
2. Подразделы. Например:
/*
  forms
*/
3. Параграфы. Например:
/*
  section-list-blog
*/
```

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
// CATEGORY [ИМЯ РАЗДЕЛА/ПОДРАЗДЕЛА] START
…
// CATEGORY [ИМЯ РАЗДЕЛА/ПОДРАЗДЕЛА] END
```

### Использование переменных

Переменные проекта должны использовать в названии _`camelCamp`_. Название глобальной основной переменной выглядит так: _`$g_varName`_.

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
@function _font($var){
  @return map_get($g_fonts,$var);
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

### Адаптивная верстка

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

### Колоночная структура

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

### Именование файлов стилей

Файл элемента: *`_[имя-раздела|имя-категории]_[имя-класса].scss`*

Например:

1. `/lists/_lists_tag.scss`
2. `/blocks/_blocks_author.scss`
3. `/helpers/_helpers_video-container`

Если *имя-раздела|имя-категории* и *имя-класса* совпадают, допускается имя категории опустить

### Приставки файлов _[имя-категории]_ файлов по разделам

Ниже приведен список категорий с соответствующими им _именами-категорий_ или их _сокращениями_

* **Typography** - _`tpg`_ (стили базовой типографики, базовые списки, базовые ссылки, стилизация тегов `html` и `body`)
* **Helpers** - _`hlp`_ (стили вспомагательных классов, так называемые *хелперы*)
* **Structure** - _`str`_ (стилизация структуры страницы)
* **Form** - _`form`_ (стилизация форм)
* **Table** - _`tbl`_ (стилизация таблиц)
* **Buttons** - _`btns`_ (стилизация кнопок, и отдельных декоративных ссылок)
* **Lists** - _`list`_, _`nav`_ (стилизация кастомных списков и навигации)
* **Blocks** - _`block`_, _`blocks`_ (стилизация отдельно взятых блоков и их групп)
* **Other** - _`page`_ (уникальные стили для отдельных страниц)

Примеры использования:

```scss
/**
## Typography
styles for default html tags and similar classes
*/

_tpg_tags.scss
// базовые стили для тегов конструктивного (body,html,*) и текстового назначения

// _tpg_text-[name-class], _tpg_label-[name-class], _tpg_message-[name-class], _tpg_link-[name-class]

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

/**
## elements
styles for different blocks and elements on site
*/

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
_btns.scss

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

/*
    other
*/
_page-[class-name].scss
// уникальные стили для страниц и может быть чего-то еще =)
```

### Именование Миксинов

Миксины должны именоваться по названию компонента, который они описывают с учетом разрешения экрана, с объяснением в виде комментария в одну строку с указанием файла и разрешения экрана

Например: _`//** [Раздел/Категория] example2-class-name xs */`_

Комментарии пишутся с двойным слешем, чтобы они не рендерились. При вставке один слеш убираем для его отображения в результирующем коде.

Все нетипичные заготовленные блоки должны храниться в своем файле (**_`/core/mixins/_[cat-name]-[mixin-name].scss`_**) и подключаються _`(@import)`_ в заглавный файл для миксинов (**_`/core/_project_mixins.scss`_**) и первое слово миксина должно содержать **название роздела** в котором он находиться.

Например:

1. _`@mixin structure-col(…){…}`_
2. _`@mixin structure-col-flex(…){…}`_
3. _`@mixin helpers-clearfix(…){…}`_

Для подключения нужно:

1. Подключить новый файл к основному _`(css.scss)`_ _`(@import)`_
2. Сделать подключение _`(@include)`_ соответствующего миксина в соответствующую ему секцию вьюпорта

### Placeholders

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

### Именование классов

Первое слово в классе должно быть определено разделом/подразделом или блоком css, кроме подразделов _`other`_ и _`structure`_.

Классы блоков стоит именовать по принципу **уникального** и **понятного** названия блока.

Классы внутри блока стоит именовать по принципу **ОО** _(обектно-ориентированого)_ стиля.

Также могут быть использованы универсальные названия классов (например `.description`), но к таким классам **должно быть каскадное указание блока в котором этот класс находиться**.

Умеренное использование каскадов имеет место быть. **Умеренным количеством каскада можно считать 3 уровня +-1**.

Типичный пример: 
1. _`.list-block-name .item .title`_
2. _`.list-block-name > .item > .title`_
3. _`.list-block-name .item + .item`_

## Организация HTML

### Структура

1. Основной шаблон _`index.php`_

При помощи функции [render()](link) создается шаблон нужной страницы _`page-[параметр GET-запроса].php`_

```php
<?
include 'php/functions.php';
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
        <?=render("page-".$_GET['page']); ?>
</body>
</html>
```

2. Шаблон страницы открывается из файла _`page-[name].php`_, где `name` передается как значение `$_GET['page]`. При помощи функции [render(tpl_name)](link) подключаются нужные файлы шаблона блока `/templates/tpl_name.php`.



```php
<!-- page-example START -->
<h1>Example page</h1>

<?=render(tpl_name); ?>

<!-- page-example END -->
```

3. Шаблон блока _`/templates/tpl_name.php`_. В нем выводится содержимое выводимого шаблона блока при помощи функции [variable()](link). В массив `$var` можно передать данные для вложенного шаблона при помощи ключа `data`.

```php
variable($var, 'data')
```

Именование шаблона `tpl_name` производится по принципу: _`[sass-category]_[main-class-name].php`_

В верху шаблона устанавливаются комментарии с значениями `@rendered at` - указывающими шаблоны, в которых подключается данный шаблон, `@param` - описыващие применяемые в шаблоне данные
```php
<?php
/**
 * @rendered at: [tpl_name1], [tpl_name2], [tpl_name3]
 * @param array $var['name'] - name of categories
 * @param array $var['selected'] - class selected
 */
?>
```

Содержимое шаблона оборачиваем в объясняющие комментарии
```php
<!-- [tpl_name] START -->
<!-- HTML-code -->
<!-- [tpl_name] END -->
```

В поле `content`, полученного при помощи функции [render()](link), массива `$var` содержится контент непосредственно самого блока. Если этот блок является родительским для более мелких, то они подключаются при помощи функции [render()](link)

Пример отображения содержимого шаблона без вложенности указан в файле `/dev/templates/sasscat_example2.php`
```php
<!-- sasscat_example2 START -->
<div>
  <p><?=variable($var, 'content'); ?></p>
</div>
<!-- sasscat_example2 END -->
```

Пример отображения содержимого шаблона с вложенными данными указан в файле `/dev/templates/sasscat_example.php`
```php
<!-- sasscat_example START -->
<div>
  <p><?=variable($var['content']); ?></p>
  <?=render('sasscat_example2',variable($var, 'data')); ?>
</div>
<!-- sasscat_example END -->
```

В шаблонах с запланированным циклом устанавливается переменная-пустышка `variable($var,'foreach')`

### Данные

Данные для шаблона хранятся в файле `php/config.php` в котором находится глобальный массив данных `$_VARS`

### Функции

###### **_`getVars(tpl_name)`_** - Формирует набор данных для указанного шаблона
    * `tpl_name` - название используемого шаблона
###### **_`render(tpl_name[, data-content[, count-iteration]])`_** - Сначала формирует массив данных для отображения, затем их выводит
    * `tpl_name` - _(тип string)_ Название полдключаемого блока, из которого берутся данные по-умолчанию, если поле `data` отсутствует, единственный обязательный аргумент
    * `data-content` - _(тип array)_ Данные о содержимом текущего блока, которые беруться из файла `config.php`
    * `count-iteration` - _(тип int)_ Принудительное количество повторений отображения текущего блока, для его визуального восприятия. После окончания работы его следует удалить

Управление стилем отображения шаблона блока функцией `render()` происходит из файла `config.php` комбинацией передаваемых данных:

* Если передано только `tpl_name`, то данные будут браться, из поля `tpl_name` в глобальном массиве данных `$_VARS`, который также мы может получить используя функцию `getVars(‘tpl_name’)`
```php
// Для данной ситуации результат выполнения следующих строк будет одинаковый
<?=render("tpl_name"); ?>
<?=render("tpl_name",getVars('tpl_name')); ?>
```
* Если для текущего блока было передано поле `data` с массивом данных, то они выводятся по очереди
    * Если поле `data` передано не было, то берутся данные по-умолчанию, из поля переданного 1-м аргументом
    * Для того, чтобы принудительно не отображать вложенное содержимое, в поле `data` передаем пустой массив `[]`
* Если указан 3-й параметр _принудительное количество повторений_, то содержимое выводится указанное количество повторений. Причем если количество повторений превышает количество переданых данных, то они беруться из 1-й итерации данных текущего блока, если же количество повторений меньше передаваемых данных, то выводится по очереди указанное количество, остальное отбрасывается. **_По окончании работы этот параметр из вызова функции удалить!!!_**

###### **_`variable(data, key)`_** - Управляет отображениями данных `data` в шаблоне
    * `data` - данные , которые генерируется при помощи функции `render()` и передаются для данной страницы
    * `key` - ключ используемых данных

### Дебаггинг

Для процесса разработки всегда включен режим предупреждений (файл `/php/functions.php`):
```php
ini_set('display_errors', 1);
```

Также для отладки присутствует закомментированная функция `debug()`, которая позволяет выводить для просмотра нужные данные


### Стандартные шаблоны

Для того чтобы учесть базовые элементы используються стандартные шаблоны, которые выводятся на странице `preview`:

* _`preview_form.php`_
* _`preview_table.php`_
* _`preview_tpg.php`_

Эти файлы содержат полный набор часто используемых стандартных элементов.

Также в случае создания какого-то блока который заведомо не будет использован (например блок определяющий какие-то особенные стили внутри статьи которая будет находиться в базе либо еще где-то) стоит поместить его в файл _`tmp_[sass-cat-name]_[main-class-name].php`_

## Сборка проекта

В качестве сборщика проекта используем *task-manager* **Gulp** `gulpfile.js` с соответствующими настройками прилагается

Используемые плагины:

* _`gulp-sass`_ - для работы с `SCSS`
* _`gulp-autoprefixer`_ - для автоматической подстановки браузерных префиксов в CSS-файлах
* _`browser-sync`_ - для прослушивания изменений в файлах и автоматической пересборки проекта (для использования с PHP  нужен дополнительно локальный хостинг)
* _`gulp-concat`_ - для объединения файлов
* _`gulp-cssnano`_ - для минификации CSS-файлов
* _`gulp-uglify`_ - для минификации JS-файлов
* _`gulp.spritesmith`_ - для создания спрайтов изображений. Использовать в группе с имеющимся миксином (файл _`_blocks_icon.scss`_)

Файлы конфигурации (`package.json`, `gulpfile.js`) находятся в корне проекта. Непосредственно файлы разработки находятся в директории `dev`, которая также находится в корне.