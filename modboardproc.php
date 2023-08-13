<?php
session_start();
include_once('connect.php');
$no = $_POST['no'];
$email = $_POST['email'];
$title = $_POST['title'];
$content = $_POST['content'];
$wdate = date('Y/m/d');


$sql = "UPDATE board SET title = '$title', content = '$content', wdate = '$wdate' where no = '$no' and email='$email'";

if($conn->query($sql))  echo "<script>alert('수정 성공'); location.href='boardlist.php';</script>";
else    echo "수정 중 오류 발생".$conn->error;

?>