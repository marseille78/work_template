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