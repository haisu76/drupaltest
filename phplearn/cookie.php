<? php


$value = time();

//在这里设置一个名为test的Cookie

setcookie("test",$value);

$s=$_COOKIE['test'];

if (isset($_COOKIE['test'])) {

    echo 'success';

    echo $s;

>