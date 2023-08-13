<?php
session_start();
include_once('connect.php');
$email = $_POST['email'];
$passwd = $_POST['pwd'];
$name = $_POST['uname'];
$telno = $_POST['telno'];
$height = $_POST['height'];
$weight = $_POST['weight'];

$sql = "update user set passwd = '$passwd', name = '$name', telno = '$telno', 
height = '$height', weight = '$weight' where email = '$email'";

if($conn->query($sql)) {
    $_SESSION['uname'] = $name;
    echo "<script>alert('회원정보수정 성공'); location.href='index.php';</script>";
}
else
    echo "회원정보수정 중 오류 발생".$conn->error;

?>