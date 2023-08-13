<?php
session_start();
include_once('connect.php');

$email = $_SESSION['uid'];
$name = $_SESSION['uname'];
$logged = false;
if(isset($email)) $logged = true;

if(!$logged)
    echo "<script>alert('로그인 후 이용하세요..'); location.href='signin.php';</script>";
else {
    $tname = $_POST['tname'];    
    $schedule = $_POST['schedule'];
    $program = $_POST['program'];
    $check = true;
    if(isset($schedule)) { // 날짜 중복 체크
        $sql = "SELECT * FROM $tname";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['schedule'] == $schedule) {
                    $check = false;
                    echo "<script>alert('이미 해당 날짜에 예약이 있습니다.'); location.href='trainerlist.php';</script>";
                    break;
                }
            }
        }
    }
    if($check) {
        $sql = "INSERT INTO $tname(uname, program, schedule) VALUES('$name', '$program', '$schedule')";
        if($conn->query($sql))
            echo "<script>alert('성공적으로 예약했습니다.'); location.href='umain.php';</script>";
        else
            $conn->error;
    }
}
?>