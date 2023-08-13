<?php
session_start();
include_once('connect.php');
if($_SESSION['role'] == 'user') $admin = false;
else    $admin = true;

if(!$admin) { // 유저일 경우
    $no = $_POST['no'];
    $email = $_SESSION['uid'];
    $date = $_POST['date'];
    $subject =$_POST['subject'];
    $sets = $_POST['sets'];
    $weight = $_POST['weight'];
    $cnt = $_POST['cnt'];
    $note = $_POST['note'];

    $sql = "UPDATE note set date = '$date', subject = '$subject', sets = '$sets', 
    weight = '$weight', cnt = '$cnt', note = '$note' where no = $no and email = '$email'";

    if($conn->query($sql)) {
        echo "<script>alert('운동일지 수정 성공'); location.href='writenotelist.php';</script>";
    }
    else
    "<script>alert('운동일지 수정 중 오류 발생'); location.href='writenotelist.php';</script>";
}
else { // 어드민일 경우
    $no = $_POST['no'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $subject =$_POST['subject'];
    $sets = $_POST['sets'];
    $weight = $_POST['weight'];
    $cnt = $_POST['cnt'];
    $note = $_POST['note'];
    $fedback = $_POST['fedback'];
    $sql = "UPDATE note set date = '$date', subject = '$subject', sets = '$sets', 
            weight = '$weight', cnt = '$cnt', note = '$note', fedback = '$fedback' where no = $no and email = '$email'";
    if($conn->query($sql)) {
        echo "<script>alert('운동일지 수정 성공'); location.href='userlist.php';</script>";
    }
    else
    "<script>alert('운동일지 수정 중 오류 발생'); location.href='userlist.php';</script>";
}

?>