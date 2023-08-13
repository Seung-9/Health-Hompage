<?php
session_start();
include_once('connect.php');
$email = $_SESSION['uid'];
$name = $_SESSION['uname'];
$date = $_POST['date'];
$subject =$_POST['subject'];
$sets = $_POST['sets'];
$weight = $_POST['weight'];
$cnt = $_POST['cnt'];
$note = $_POST['note'];

$sql = "INSERT INTO note(email, name, date, subject, sets, weight, cnt, note) VALUES('$email', '$name', '$date', '$subject', $sets, '$weight','$cnt', '$note')";

if($conn->query($sql))
    echo "<script>alert('기록이 완료되었습니다.'); location.href='umain.php'</script>";
else
    echo "<script>alert('기록중 오류가 발생하였습니다..'); location.href='umain.php'</script>";
?>