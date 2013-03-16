<?php

if (!isset($_GET["dl"]))
    die("error");
$zip = $_GET["dl"];
$a = explode("/", $zip);
$file = $a[0] . "." . $a[1] . "." . $a[2];
if (!is_file($file))
    file_put_contents($file, "1");
else {
    $i = (int) file_get_contents($file);
    $i++;
    file_put_contents($file, "$i");
}
header("location: " . $_GET["dl"]);
?>
