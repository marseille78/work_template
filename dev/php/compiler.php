<?php

include "functions.php";

createTpls((empty($_GET['type']) ? 'page' : $_GET['type']));