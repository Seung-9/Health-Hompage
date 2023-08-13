<?php
session_start();
include_once('connect.php');

$email = $_POST['email'];
$passwd = $_POST['pwd'];

$sql = "SELECT * FROM user WHERE email = '$email' and passwd = '$passwd'";

$result = $conn->query($sql);
if(isset($result) && $result->num_rows) {
    $row = $result->fetch_assoc();
    $_SESSION['uid'] = $email;
    $_SESSION['uname'] = $row['name'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['regis'] = $row['regis'];
    echo "<script>location.href='index.php'</script>";
} else
echo "<script>alert('아이디 또는 비밀번호가 올바르지 않습니다.'); location.href='signin.html';</script>";
?>