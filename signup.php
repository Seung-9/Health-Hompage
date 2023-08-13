<?php
include_once('connect.php');
$email = $_POST['email'];
$passwd = $_POST['pwd'];
$name = $_POST['name'];
$brith = $_POST['brith'];
$gen = $_POST['gen'];
$telno = $_POST['telno'];
$height = $_POST['height'];
$weight = $_POST['weight'];

$sql = "INSERT INTO user(email, passwd, name, brith, gen, telno, height, weight) VALUES('$email', '$passwd', '$name', '$brith', '$gen', '$telno', '$height', '$weight')";

if($conn->query($sql))
    echo "<script>alert('회원가입 성공'); location.href='index.php';</script>";
else
    echo "회원가입 중 오류가 발생하였습니다.".$conn->error;
?>