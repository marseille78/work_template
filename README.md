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
        * [getVars](https://github.com/marseille78/work_template#getvarstpl_name---Формирует-набор-данных-для-указанного-шаблона)
        * [render](https://github.com/marseille78/work_template#rendertpl_name-data-content-count-iteration---Сначала-формирует-массив-данных-для-отображения-затем-их-выводит)
        * [variable](https://github.com/marseille78/work_template#variabledata-key---Управляет-отображениями-данных-data-в-шаблоне)
    * [Дебаггинг](https://github.com/marseille78/work_template#Дебаггинг)
    * [Стандартные шаблоны](https://github.com/marseille78/work_template#Стандартные-шаблоны)
* [Сборка проекта](https://github.com/marseille78/work_template#Сборка-проекта)

## Технология

Для стилизации проекта за основу выбран препроцессор SCSS (для удобства дебаггинга версии не ниже 3.3). на каждый блок должен быть создан отдельный файл который именуется так же как и параграф этого блока.

Для шаблонизации HTML-структтуры принят язык программирования PHP

## Организация CSS

Внутри файла стилей должна быть организована базовая конструкция файла, в каждом разделе которого создается миксин, который должен называться по имени файла. А для адаптивной верстки: __*[имя файла]-[название периода viewport'a]*__ стили которого в нем находяться. (например: `block-adaptive-md`).

Стили под каждое разрешение экрана оборачиваются в соответствующие миксины, которые затем подключаются в нужных местах базового файла **`./css/scss/css.scss`**

**Общая рекомендация** - по возможности не дублировать классы на уровне одного файла, дублированные стили группировать при помощи плейсхолдеров.

По возможности группировать общие локальные стили в локальные плейсхолдеры

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
@media only screen and (min-width: 560px) {
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

@media only screen and (min-width: 560px) and (max-width: 767px) {
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

**_Раздел/подраздел_**, который используем в папках именуем **категорией**

Для удобства разработки в каждой категории пространство для подключений миксинов _`(@include)`_ оборачиваем в комментарии:
```scss
// CATEGORY [ИМЯ КАТЕГОРИИ] START
…
// CATEGORY [ИМЯ КАТЕГОРИИ] END
```

### Создание SCSS-файла для блока

```scss
// @include {{name-block}}-xs();
// @include {{name-block}}-sm();
// @include {{name-block}}-md();
// @include {{name-block}}-lg();
// @include {{name-block}}-xl();
// @include {{name-block}}-dev();
// @include {{name-block}}-mob();
// @include {{name-block}}-xso();
// @include {{name-block}}-smo();
// @include {{name-block}}-mdo();
// @include {{name-block}}-lgo();

// BLOCK VARIABLES BELOW

@mixin {{name-block}}-xs(){
/* {{name-block}} xs /
    .{{name-class}}{$END$}
}
@mixin {{name-block}}-sm(){
/* {{name-block}} sm /
    .{{name-class}}{}
}
@mixin {{name-block}}-md(){
/* {{name-block}} md /
    .{{name-class}}{}
}
@mixin {{name-block}}-lg(){
/* {{name-block}} lg /
    .{{name-class}}{}
}
@mixin {{name-block}}-xl(){
/* {{name-block}} xl /
    .{{name-class}}{}
}
@mixin {{name-block}}-dev(){
/* {{name-block}} dev /
    .{{name-class}}{}
}
@mixin {{name-block}}-mob(){
/* {{name-block}} mob /
    .{{name-class}}{}
}
@mixin {{name-block}}-xso(){
/* {{name-block}} xso /
    .{{name-class}}{}
}
@mixin {{name-block}}-smo(){
/* {{name-block}} smo /
    .{{name-class}}{}
}
@mixin {{name-block}}-mdo(){
/* {{name-block}} mdo /
    .{{name-class}}{}
}
@mixin {{name-block}}-lgo(){
/* {{name-block}} lgo /
    .{{name-class}}{}
}
```

Live-Template для PHPStorm:

```scss
// @include $PARAGRAPH$-xs();
// @include $PARAGRAPH$-sm();
// @include $PARAGRAPH$-md();
// @include $PARAGRAPH$-lg();
// @include $PARAGRAPH$-xl();
// @include $PARAGRAPH$-dev();
// @include $PARAGRAPH$-mob();
// @include $PARAGRAPH$-xso();
// @include $PARAGRAPH$-smo();
// @include $PARAGRAPH$-mdo();
// @include $PARAGRAPH$-lgo();

// BLOCK VARIABLES BELOW

@mixin $PARAGRAPH$-xs(){
/* $PARAGRAPH$ xs /
    .$NAME${$END$}
}
@mixin $PARAGRAPH$-sm(){
/* $PARAGRAPH$ sm /
    .$NAME${}
}
@mixin $PARAGRAPH$-md(){
/* $PARAGRAPH$ md /
    .$NAME${}
}
@mixin $PARAGRAPH$-lg(){
/* $PARAGRAPH$ lg /
    .$NAME${}
}
@mixin $PARAGRAPH$-xl(){
/* $PARAGRAPH$ xl /
    .$NAME${}
}
@mixin $PARAGRAPH$-dev(){
/* $PARAGRAPH$ dev /
    .$NAME${}
}
@mixin $PARAGRAPH$-mob(){
/* $PARAGRAPH$ mob /
    .$NAME${}
}
@mixin $PARAGRAPH$-xso(){
/* $PARAGRAPH$ xso /
    .$NAME${}
}
@mixin $PARAGRAPH$-smo(){
/* $PARAGRAPH$ smo /
    .$NAME${}
}
@mixin $PARAGRAPH$-mdo(){
/* $PARAGRAPH$ mdo /
    .$NAME${}
}
@mixin $PARAGRAPH$-lgo(){
/* $PARAGRAPH$ lgo /
    .$NAME${}
}
```

### Использование переменных

Переменные проекта должны использовать в названии _`camelCamp`_. Название глобальной основной переменной выглядит так: _`$g_varName`_.

Для удобства стоит группировать переменные в мапы и создавать функции с соответствующими названиями для простоты их использования.

Например: 

* _`/project/_project_vars.scss`_
```scss
$g_Fonts:(
        base: "'proxima-nova',Helvetica,Arial,sans-serif",
        second: "Georgia, 'Times New Roman', Times, serif"
);
```
* _`/project/_project_functions.`_ (**!!! Названия ф-й для получения базовой глобальной переменной должны начинаться с `_`**)
```scss
@function _font($var){
  @return map_get($g_fonts,$var);
}
```

Список глобальных мапов с объединениями переменных по типу:

* **_`$g_FontWeight`_** - нужно записывать ширины шрифтов исключительно с привязкой к проекту (`normal`, `bold`, `light`, `...`)
* **_`$g_FontFamily`_** - подключаем семейства шрифтов по абстрактному названию (`base`, `second`, `third`, `...`)
* **_`$g_LineHeight`_** - исключительно для величины кегля основного шрифта. Возможно добавление дополнительных кеглей, использщуемых по всему сайту с соответствующим пояснением в комментарии (`base-xs`, `...`)
* **_`$g_FontSize`_** - значение размера основного шрифта. Допустимо добавление размеров шрифтов, используемых по всему сайту с соответствующим пояснением в комментарии (`base-xs`, `...`)
* **_`$colorMap`_** - для всех цветов, используемых на протяжении проекта
* **_`$g_Color`_** - для значений основных цветов текста, используемых на протяжении проекта. В качестве значений ключей принимаем значения цветов из `map-палитры` `$colorMap`
    * `accent` - акцентирующий цвет (для выделения участка текста)
    * `border` - основной цвет рамки, используемый по всему сайту
    * `link` - основной цвет ссылок, используемых по всему сайту
    * `link-hover` - цвет основных ссылок, используемых по всему сайту. При наведении на них курсора
    * `text` - цвет основного текста, используемого по всему сайту
    * `btn` - цвет текста базовых кнопок, используемых по всему сайту
* **_`$g_Width`_** - базовые ширины используемые на протяжении проекта
    * `size` - размер контента сайта
    * `...` - другие ширины (только глобальные)
* **_`$g_Height`_** - базовые размеры, используемые на протяжении проекта
    * `site` - высота контента сайта (напр. <html>, <body>)
    * `header` - высота шапки
    * `footer` - высота подвала
    * `input` - высота поля ввода
    * `...` - другие базовые высоты, используемые по всему проекту
* **_`$g_Size`_** - указание базовых размеров используемых по всему проекту, не одходящие под определение "ширины" или "высоты"
    * bdrs - величина свойства `border-radius`
    * `...` - другие базовые размеры, используемые на протяжении проекта
* **_`$_Indentations`_** - отступы между структурными частями сайта и используемые на протяжении всего проекта
* **_`$_BgColors`_** - для значений основных фоновых цветов, используемых на протяжении проекта. В качестве значений ключей принимаем значения цветов из `map-палитры` `$colorMap`
    * `base` - базовый фоновый цвет сайта
    * `bg-colored` - фоновый цвет контентной части сайта
    * `form` - фоновый цвет формы
    * `form-field` - фоновый цвет поля ввода
    * `btn` - фоновый цвет базовых кнопок
    * `btn-hover` - фоновый цвет базовых кнопок при наведении
    * `line` - фоновый цвет блоков разделителей

**Положения по использованию переменных в блоках:**

* Переменные, используемые в блоках, непосредственно в них и объявляются
* При использовании глобальных переменных в отдельно взятых облоках, они переопределяются в переменные местного значения
* В локальных переменных допускается использование значений из палитры цветов `$colorMap`
* Локальная переменная создается при использовании значения не менее 2-х раз
* Локальные стили объединяем в локальные мапы с именем `$e_[имя-файла]`
* Локальные мапы с функциями для получения значений объявляем вверху файла, перед определениями стилей

**Пример создания набора переменных для отдельно-взятого блока с функцией получения значения из этого набора:**

```php
$e_{{file-name}}:(
    key: value
);

@function {{file-name}}($var){
    @return map_get($e_{{file-name}}, $var);
}
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
// fn $BLOCKFNNAME$
$USD$e_$VARNAME$:(
// _color(){$USD$g_Colors},_bgc(){$USD$g_BackgroundColors},
// _bgi(){$USD$g_BackgroundImages},_width(){$USD$g_Width},_height(){$USD$g_Height},
// _font([w|f|s|lh],key){$USD$g_FontWeight|Size|Famely|LineHeight},_ind(){$USD$g_Indentations},

);
@function $BLOCKFNNAME$($USD$var){
    @return map_get($USD$e_$VARNAME$,$USD$var);
}
```

**Базовые scss-функции для получения значений переменных:**

* `_palette([name-color])` - Для получения значения из палитры цветов `$colorMap`, используемых на сайте
* `_color([name-color])` - Для получения значения из набора основных цветов
    * _[name-color]_ - ключ значения цвета из набора `$g_Color`
* `_bgc([name-backgroundColor])` - Для получения значения из набора основных фоновых цветов
    * _[name-backgroundColor]_ - ключ значения фонового цвета из набора `$g_BgColors`
* `_bgi([name-backgroundImage])` - Для получения значения адреса местоположения фонового изображения из набора основных фоновых изображений
    * _[name-backgroundImage]_ - ключ значения фонового цвета из набора `$g_BgImages`
* `_width([name-width])` - Для получения значения из набора основных значений ширин
    * _[name-width]_ - ключ значения ширины из набора `$g_Width`
* `_height([name-height])` - Для получения значения из набора основных значений высот
    * _[name-height]_ - ключ значения высоты из набора `$g_Height`
* `_size([name-size])` - Для получения значения из набора основных значений размеров
    * _[name-size]_ - ключ значения размера из набора `$g_Size`
* `_font([name-props], [value-props])` - Для получения значения указанного шрифтового свойства из указанного набора
    * _[name-props] = fw_ - получаем значение `[value-props]` толщины шрифта из набора `$g_FontWeight`
    * _[name-props] = fz_ - получаем значение `[value-props]` размера шрифта из набора `$g_FontSize`
    * _[name-props] = lh_ - получаем значение `[value-props]` высоты кегля из набора `$g_LineHeight`
    * _[name-props] = ff_ - получаем значение `[value-props]` названия импользуемого шрифта из набора `$g_FontFamily`
* `_ind([name-indentation])` - Для получения значения из набора основных значений отступов
    * _[name-indentation]_ - ключ значения отступа из набора `$g_Indentations`

### Адаптивная верстка

Для адаптивной верстки выбрана схема *mobile-first*. Также были установлены следующие периоды:

* без _`@media`_ - **`xs`** (Базовые стили для всех)
* _`min-width: 560px`_ - **`sm`** (стили для мобильных с большим экраном типа iphone 6s plus)
* _`min-width: 768px`_ - **`md`** (планшеты)
* _`min-width: 1025px`_ - **`lg`** (десктопы)
* _`min-width: 1260px`_ - **`xl`** (большие экраны)
* _`max-width: 1024px`_ - **`dev`** (для девайсов)
* _`max-width: 767px`_ - **`mob`** (только для всех мобильных)
* _`max-width: 499px`_ - **`xso`** (только для мобильных с маленьким экраном)
* _`(min-width: 560px) and (max-width: 767px)`_ - **`smo`** (только для мобильных с большим экраном типа iphone+)
* _`(min-width: 768px) and (max-width: 1024px)`_ - **`mdo`** (только для планшетов)
* _`(min-width: 1025px) and (max-width: 1259px)`_ - **`lgo`** (только для десктопов с большими экранами)

Для каждого периода в категориях и компонентах стоит добавлять суффикс названия периода в котором эта категория находится.

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

Файл элемента: *`_[имя-категории]_[имя-класса].scss`*

Например:

1. `/lists/_lists_tag.scss`
2. `/blocks/_blocks_author.scss`
3. `/helpers/_helpers_video-container`

Если *имя-категории* и *префикс имени-класса* совпадают, допускается имя категории опустить

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

Рекомендуемая организация структуры категорий и именования файлов:

```scss
/**
## Typography
styles for default html tags and similar classes
*/

_tpg_tags.scss
// базовые стили для тегов конструктивного (body,html,*) и текстового назначения

_tpl_texts.scss
// Стили для примерных классов
// Рекомендуемые к использованию именования классов: .text-[name-class],
// .label-[name-class], .message-[name-class], .link-[name-class]

/**
## helpers
*/
_hlp_[class-name].scss // напр. _hlp_clearfix.scss

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
_forms.scss
_form-[class-name].scss

/*
    tables
*/
_tables.scss
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

Миксины должны именоваться по названию компонента, который они описывают с учетом секции `media-queries`, с объяснением в виде комментария в одну строку с указанием файла и секции `media-queries`

Например: _`//** [Категория]_[example2-class-name]_xs */`_

Комментарии пишутся с двойным слешем, чтобы они не рендерились. При вставке один слеш убираем для его отображения в результирующем коде.

Все нетипичные заготовленные блоки должны храниться в своем файле (**_`/core/mixins/_[cat-name]-[mixin-name].scss`_**) и подключаються _`(@import)`_ в заглавный файл для миксинов (**_`/core/_project_mixins.scss`_**) и первое слово миксина должно содержать **название роздела** в котором он находиться.

Например:

1. _`@mixin structure_col(…){…}`_
2. _`@mixin structure_col_flex(…){…}`_
3. _`@mixin helpers_clearfix(…){…}`_

Для подключения нужно:

1. Подключить новый файл к основному _`(css.scss)`_ _`(@import)`_
2. Сделать подключение _`(@include)`_ соответствующего миксина в соответствующую ему категорию и секцию вьюпорта

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
// @include pl_{{name-placeholder}}-xs;
// @include pl_{{name-placeholder}}-sm;
// @include pl_{{name-placeholder}}-md;
// @include pl_{{name-placeholder}}-lg;
// @include pl_{{name-placeholder}}-xl;
// @include pl_{{name-placeholder}}-xso;
// @include pl_{{name-placeholder}}-mob;
// @include pl_{{name-placeholder}}-dev;
// @include pl_{{name-placeholder}}-smo;
// @include pl_{{name-placeholder}}-mdo;
// @include pl_{{name-placeholder}}-lgo;

@mixin pl_{{name-placeholder}}{
  //some css was here
}

//---------------------------//
@mixin pl_{{name-placeholder}}-xs{
  %pl_{{name-placeholder}}-xs{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-sm{
  %pl_{{name-placeholder}}-sm{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-md{
  %pl_{{name-placeholder}}-md{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-lg{
  %pl_{{name-placeholder}}-lg{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-xl{
  %pl_{{name-placeholder}}-xl{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-xso{
  %pl_{{name-placeholder}}-xso{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-mob{
  %pl_{{name-placeholder}}-mob{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-dev{
  %pl_{{name-placeholder}}-dev{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-smo{
  %pl_{{name-placeholder}}-smo{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-mdo{
  %pl_{{name-placeholder}}-mdo{
    @include pl_{{name-placeholder}};
  }
}
@mixin pl_{{name-placeholder}}-lgo{
  %pl_{{name-placeholder}}-lgo{
    @include pl_{{name-placeholder}};
  }
}
```
3. Подключить (_`@import`_) новый файл в _`/core/_project_placeholders.scss`_
4. Подключить (_`@include`_) новый файл в
    1. _`/core/_project_placeholders.scss`_ в соответствующий _`pl-multyblock`_ если надо чтобы групировка происходила в начале медиа роздела
    2. или _`/core/placeholders/category/_[category-name].scss`_ если надо чтобы группировка происходила в начале соответствующей **категории**
    
**Локальные/Местные**

Так же для локальных группировок стилей между несколькими блоками внутри одного блока можно создавать так называемые локальные плейсхолдеры название которых должно состоять из: _`%pll-[base-class-name]`_.

Стили для такого плейсхолдера прописываются внутри соответствующего миксина в файле блока.

**Примерный LiveTemplate для созданий плейсхолдера:**

```scss
// @include pl_$NAME$-xs;
// @include pl_$NAME$-sm;
// @include pl_$NAME$-md;
// @include pl_$NAME$-lg;
// @include pl_$NAME$-xl;
// @include pl_$NAME$-dev;
// @include pl_$NAME$-mob;
// @include pl_$NAME$-xso;
// @include pl_$NAME$-smo;
// @include pl_$NAME$-mdo;
// @include pl_$NAME$-lgo;

@mixin pl_$NAME${
  $VAL$
}

//---------------------------//
@mixin pl_$NAME$-xs{
  %$NAME$-xs{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-sm{
  %$NAME$-sm{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-md{
  %$NAME$-md{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-lg{
  %$NAME$-lg{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-xl{
  %$NAME$-xl{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-dev{
  %$NAME$-dev{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-mob{
  %$NAME$-mob{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-xso{
  %$NAME$-xso{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-smo{
  %$NAME$-smo{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-mdo{
  %$NAME$-mdo{
    @include pl_$NAME$;
  }
}
@mixin pl_$NAME$-lgo{
  %$NAME$-lgo{
    @include pl_$NAME$;
  }
}
```

### Именование классов

Первое слово в классе должно быть определена категория или блоком css, кроме категорий _`other`_ и _`structure`_.

Классы блоков стоит именовать по принципу **уникального** и **понятного** названия блока.

Примеры именования классов:

* Для стилизации _типографики_
    * `.text-[name-class]` - для стилизации блоков текста
    * `.label-[name-class]` - для стилизации меток
    * `.message-[name-class]` - для стилизации сообщений
    * `.link-[name-class]` - для стилизации уникальных ссылок
* `.hlp-[name-class]` - для стилизации классов-хелперов
* `.form-[name-class]` - для стилизации форм
* `.tbl-[name-class]` - для стилизации таблиц
* `btn-[name-class]` - для стилизации кнопок
* Для стилизации _списков_
    * `.list-[name-class]` - для стилизации уникальных списков
    * `.nav-[name-class]` - для стилизации навигаций
* `.block-[name-class]` - для стилизации блоков

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

При помощи функции [render()](https://github.com/marseille78/work_template#rendertpl_name-data-content-count-iteration---Сначала-формирует-массив-данных-для-отображения-затем-их-выводит) создается шаблон нужной страницы _`page-[параметр GET-запроса].php`_

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

2. Шаблон страницы открывается из файла _`page-[name].php`_, где `name` передается как значение `$_GET['page]` и значение имени ключа данных шаблона через запятую. При помощи функции [render(tpl_name, key_data)](https://github.com/marseille78/work_template#rendertpl_name-data-content-count-iteration---Сначала-формирует-массив-данных-для-отображения-затем-их-выводит) подключаются нужные файлы шаблона блока `/templates/tpl_name.php`.



```php
<!-- page-example START -->
<h1>Example page</h1>

<?=render(tpl_name, data_key); ?>

<!-- page-example END -->
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
<?=render('$VAR$',variable($var,'data_$VAR$')); ?>
```

3. Шаблон блока _`/templates/tpl_name.php`_. В нем выводится содержимое выводимого шаблона блока при помощи функции [variable()](https://github.com/marseille78/work_template#variabledata-key---Управляет-отображениями-данных-data-в-шаблоне). В массив `$var` можно передать данные для вложенного шаблона при помощи ключа `data`.

```php
variable($var, 'data')
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
<?=variable($var, '$END$'); ?>
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

Привер содержимого шаблона:
```php
...
HTML-code
...
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
<?php
/**
 * @rendered at: $RENDERED$
 * @param
 */
?>
<!-- $FILENAME$ START -->
$END$
<!-- $FILENAME$ END -->
```

**Вероятный вариант LiveTemplate для PHPStorm для описания параметров для переменной типа `array`:**

```php
@param array 'data_$END$'
```

**Вероятный вариант LiveTemplate для PHPStorm для описания параметров для переменной в цикле:**

```php
@param string 'for_$NAME$_start'
* @param string 'for_$NAME$_end'
```

**Вероятный вариант LiveTemplate для PHPStorm для описания параметров для переменной с условием if:**

```php
@param bool 'use_$NAME$'
* @param string 'if_$NAME$_start'
* @param string 'if_$NAME$_end'
```

**Вероятный вариант LiveTemplate для PHPStorm для описания параметров для переменной с условием if-else:**

```php
@param bool 'use_$NAME$'
* @param bool 'use_$NAME$_else'
* @param string 'if_$NAME$_start'
* @param string 'if_$NAME$_else'
* @param string 'if_$NAME$_end'
```

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
  <p><?=variable($var, 'content'); ?></p>
  <?=render('sasscat_example2',variable($var, 'data')); ?>
</div>
<!-- sasscat_example END -->
```

В шаблонах с запланированным циклом устанавливается переменная-пустышка [variable($var,'foreach')](https://github.com/marseille78/work_template#variabledata-key---Управляет-отображениями-данных-data-в-шаблоне)

**Условие `if` в шаблоне:**

```php
<? if(variable($var,'use_var-name')){ ?>
    <?=variable($var,'if_var-name_start'); ?>
    <!-- code -->
    <?=variable($var,'if_var-name_end'); ?>
<? } ?>
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
<? if(variable($var,'use_$VAR$')){ ?>
    <?=variable($var,'if_$VAR$_start'); ?>
    $END$
    <?=variable($var,'if_$VAR$_end'); ?>
<? } ?>
```

**Условие `if-else` (по сути, двойной `if`) в шаблоне:**

```php
<?=variable($var,'if_{{var-name}}_start'); ?>
    <? if(variable($var,'use_{{var-name}}')){ ?>
        <!-- code для перового условия -->
    <? } ?>
    <?=variable($var,'if_{{var-name}}_else'); ?>
    <? if(variable($var,'use_{{var-name}}_else')){ ?>
        <!-- code для второго условия -->
    <? } ?>
<?=variable($var,'if_{{var-name}}_end'); ?>
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
<?=variable($var,'if_$VAR$_start'); ?>
<? if(variable($var,'use_$VAR$')){ ?>
    $END$
<? } ?>
<?=variable($var,'if_$VAR$_else'); ?>
<? if(variable($var,'use_$VAR$_else')){ ?>
    
<? } ?>
<?=variable($var,'if_$VAR$_end'); ?>
```

**Циклический вывод файла в шаблоне:**

```php
<?=variable($var,'for_{{file-name}}_start'); ?>
<!-- code -->
<?=variable($var,'for_{{file-name}}_end'); ?>
```

**Вероятный вариант LiveTemplate для PHPStorm:**

```php
<?=variable($var,'for_$VAR$_start'); ?>
$END$
<?=variable($var,'for_$VAR$_end'); ?>
```

### Данные

Данные для шаблона хранятся в файле `php/config.php` в котором находится глобальный массив данных `$_VARS`

Ключи первого уровня массива `$_VARS` указывают на используемый шаблон

```php
//templates
$_VARS['preview_form'] = [];
$_VARS['preview_table'] = [];
$_VARS['preview_tpg'] = [];
```
В ячейках шаблонов находятся массивы ассоциативных массивов, в которых _ключи_ - имена переменных, данны из которых получить, а их _значения_ - непосредственно сами данные

Пример без учета вложенности

```php
$_VARS['sasscat_example'] = [
    [
        'content'=>'I am sasscat_example content 1',
    ],
],
```

Пример с учетем вложенности

```php
$_VARS['sasscat_example'] = [
    [
        'content'=>'',
        'data'=> [
            ['content'=>'I am sasscat_example2 inside sasscat_example 1'],
            ['content'=>'I am sasscat_example2 inside sasscat_example 2'],
            ['content'=>'I am sasscat_example2 inside sasscat_example 3'],
        ],
    ],
]
```

Для того, чтобы не отображать вложенный шаблон, то передаем пустой массив. Например:

```php
$_VARS['sasscat_example'] = [
    [
        'content'=>'I am sasscat_example content 1',
        'data'=> [],
    ],
]
```

**Вероятный вариант LiveTemplate для PHPStorm для создания данных для файла в файле `php/config.php`:**

```php
$_VARS['$FILE$'] = [
    'type'=>'$TYPE$',
    'file'=>[
        'name'=>'$FILE2$',
        'ext'=>'$EXT$',
        'skip'=>$SKIP$,
    ],
    [
        $END$
    ],
];
```

**Создание поля переменной для данных `php/config.php`:**

```php
'data_{{file-name}}'=>[
    [
        <!-- data -->
    ],
],
```

**Вероятный вариант LiveTemplate для PHPStorm для создания данных для полей данных в файле `php/config.php`:**

```php
'$DATA$'=>[
    [
        $END$
    ],
//    [
//        
//    ],
],
```

Рекомендации к именованию переменных, отвечающих за отображение данных:

* `data_[tpl-name]` - для отображения данных
* `if_[tpl_name]_start` и `if_[tpl_name]_end` - пустые переменные, которыми оборачиваем вывод данных, где нужно условие для его отображения или скрытия
* `for_[tpl_name]_start` и `for_[tpl_name]_end` - пустые переменные, которыми оборачиваем вывод данных, который предположительно будет выводиться в цикле
* `cycle_[tpl_name]_start` и `cycle_[tpl_name]_start` - пустые переменные, которыми оборачиваем вывод данных, который будет выводится в цикле, в виде "рыбы", при помощи 3-го необязательного аргумента

### Функции

###### **_`getVars(tpl_name)`_** - Формирует набор данных для указанного шаблона
    * `tpl_name` - название используемого шаблона
###### **_`render(tpl_name[, data-content[, count-iteration]])`_** - Сначала формирует массив данных для отображения, затем их выводит
    * `tpl_name` - _(тип string)_ Название полдключаемого блока
    * `data-content` - _(тип array)_ Данные о содержимом текущего блока, которые беруться из файла `config.php`
    * `count-iteration` - _(тип int)_ Принудительное количество повторений отображения текущего блока, для его визуального восприятия. После окончания работы его следует удалить

Управление стилем отображения шаблона блока функцией `render()` происходит из файла `config.php` комбинацией передаваемых данных:

* Если передано только `tpl_name`, то данные будут браться, из поля `tpl_name` в глобальном массиве данных `$_VARS`, который также мы может получить используя функцию `getVars(‘tpl_name’)`
* Если указан 3-й параметр _принудительное количество повторений_, то содержимое выводится указанное количество повторений. Причем если количество повторений превышает количество переданых данных, то они беруться из 1-й итерации данных текущего блока, если же количество повторений меньше передаваемых данных, то выводится по очереди указанное количество, остальное отбрасывается. **_По окончании работы этот параметр из вызова функции удалить!!!_**

```php
// Для данной ситуации результат выполнения следующих строк будет одинаковый
<?=render("tpl_name"); ?>
<?=render("tpl_name",getVars('tpl_name')); ?>
```

###### **_`variable(data, key)`_** - Управляет отображениями данных `data` в шаблоне
    * `data` - данные, которые генерируется при помощи функции [render()](https://github.com/marseille78/work_template#rendertpl_name-data-content-count-iteration---Сначала-формирует-массив-данных-для-отображения-затем-их-выводит) и передаются для данной страницы
    * `key` - ключ используемых данных

### Дебаггинг

Для процесса разработки всегда включен режим предупреждений (файл `/php/functions.php`):
```php
ini_set('display_errors', 1);
```

Также для отладки присутствует закомментированная функция `debug()`, которая позволяет выводить для просмотра нужные данные


### Стандартные шаблоны

Для того чтобы учесть базовые элементы используються стандартные шаблоны:

* _`preview_form.php`_
* _`preview_table.php`_
* _`preview_tpg.php`_

Эти файлы содержат полный набор часто используемых стандартных элементов.

Увидеть эти шаблоны можно на тестовой странице `page-preview.php`

Также в случае создания какого-то блока который заведомо не будет использован (например блок определяющий какие-то особенные стили внутри статьи которая будет находиться в базе либо еще где-то) стоит поместить его в файл _`tmp_[sass-cat-name]_[main-class-name].php`_

### Очередность разработки проекта

1. Конструкция
    1. Основные цвета сайта
    2. Конструкция контента
    3. Другое
2. Блоки
    1. Кнопки
    2. Другое
3. Тексты, формы, таблицы
    1. Основные характеристики шрифта (размер, цвет, высота строки, название шрифта)
    2. Ссылки
    3. Другое

## Сборка проекта _(is working draft)_

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