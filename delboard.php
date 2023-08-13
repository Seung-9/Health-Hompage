<?php
session_start();
include_once('connect.php');
$no = $_POST['no'];
$name = $_POST['name'];
$email = $_POST['email'];
$logged = false;
if(isset($_SESSION['uid'])) { // 로그인 체크
    if($email == $_SESSION['uid'])  $logged = true;
    if($_SESSION['role'] != 'user') $admin = true;
    else    $admin = false;
}
if($logged || $admin) {
    $sql = "DELETE FROM board WHERE no= '$no' and name = '$name'";
    if(!$conn->query($sql))
        echo "<script>alert('삭제 중 오류가 발생하였습니다.'); location.href='boardlist.php'</script>";
    else
        echo "<script>alert('삭제가 완료되었습니다.'); location.href='boardlist.php'</script>";
}
?>