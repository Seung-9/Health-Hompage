<?php
$server = "localhost:3306";
$user = "root";
$passwd = "tmdrnsla123~!";
$dbname = "healthweb";

$conn = new mysqli($server, $user, $passwd, $dbname);
if($conn -> connect_error) {
    die("Health DB 접속 오류");
}
?>