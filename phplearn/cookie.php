<? php


$value = time();

//����������һ����Ϊtest��Cookie

setcookie("test",$value);

$s=$_COOKIE['test'];

if (isset($_COOKIE['test'])) {

    echo 'success';

    echo $s;

>