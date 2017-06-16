# Организация проекта

## Структура файлов

**Gulp+Pug+SASS**

* Install dev-dependencies `npm i`
* Install dependencies `bower i`
* Launch `gulp` to run watchers, server and compilers
* Launch `gulp production` to minify files for production

workshop
|-- /app/ # Для хранения HTML, который будет открываться на локальном сервере в процессе разработки
|------ /css/
|------ /fonts/
|------ /img/
|------ /js/
|------ /libs/
|------ index.html
|-- /blocks/ # Директория для хранения структурных блоков
|------ /_assets/ # Директория для плагинов и библиотек (то, что будет отдельно подключаться и сжиматься)
|------ /_base/
|------ /head/
|------ index.pug
|------ main.scss
|------ template.pug
|-- /build/ # Директория для компиляции продакшена (отправки на хостинг)
|-- .bowerrc
|-- .gitignore
|-- bower.json # для скачивания необходимых библиотек
|-- gulpfile.js
|-- LICENSE.md
|-- package.json
|-- README.md

## Зависимости проекта (package.json)

* **_`browser-sinc`_** - локальный сервер + live reload
* **_`gulp`_** - непосредственно сам gulp
* **_`gulp-autoprefixer`_** - автоматически проставляет css-префиксы
* **_`gulp-clean-css`_** - минификация css-файлов
* **_`gulp-concat`_** - позволяет соединять файлы
* **_`gulp-if`_** - 
* **_`gulp-imagemin`_** - минифицирует картинки
* **_`gulp-notify`_** - для уведомлений
* **_`gulp-plumber`_** - позволяет, чтобы не все ошибки вели к выскакиванию из консоли и прерыванию всех тасок
* **_`gulp-pug`_** - компилирует pug/jade в html
* **_`gulp-sass`_** - копилирует sass/scss в css
* **_`gulp-uglify`_** - минифицирует js-файлы
* **_`gulp-useref`_** - 
* **_`rimraf`_** - позволяет удалять папки (для очищения папки `build`)
* **_`vinyl-ftp`_** - для работы с ftp-соединением