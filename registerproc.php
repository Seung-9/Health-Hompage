<?php
session_start();
include_once('connect.php');
$email = $_SESSION['uid'];
$start = $_POST['start']; // 시작일자
$months = $_POST['months']; // 등록 기간
$chkregis = $_SESSION['regis'];

if($chkregis == 'X') {
    if($months == "3month") {
        $regis = date("Y/m/d", strtotime($start.'+3month')); // 끝나는 날짜 계산
    }
    if($months == "6month") {
        $regis = date("Y/m/d", strtotime($start.'+6month')); // 끝나는 날짜 계산
    }
    if($months == "12month") {
        $regis = date("Y/m/d", strtotime($start.'+12month')); // 끝나는 날짜 계산
    }
}
else {
    if($months == "3month") {
        $regis = date("Y/m/d", strtotime($chkregis.'+3month')); // 끝나는 날짜 계산
    }
    if($months == "6month") {
        $regis = date("Y/m/d", strtotime($chkregis.'+6month')); // 끝나는 날짜 계산
    }
    if($months == "12month") {
        $regis = date("Y/m/d", strtotime($chkregis.'+12month')); // 끝나는 날짜 계산
    }
}

$sql = "UPDATE user SET regis = '$regis' where email = '$email'";

if($conn->query($sql))
    echo "<script>alert('등록이 완료되었습니다.'); location.href='umain.php'</script>";
else
    echo "<script>alert('등록중 오류가 발생하였습니다.'); location.href='register.php'</script>";
