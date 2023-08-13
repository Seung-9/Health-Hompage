<?php
session_start();
include_once('connect.php');
$chk = $_POST['chk'];
$no = substr($chk[0],0,10);
$logged = false;
if(isset($_SESSION['uid'])) { // 로그인 체크
    $logged = true;
    if($_SESSION['role'] != 'user') $admin = true;
    else    $admin = false;
}
if($logged || $admin) {
    if(isset($chk)) {
    $sql = "DELETE FROM note WHERE no= '$no'";

    if(!$conn->query($sql))
        echo "<script>alert('삭제 중 오류가 발생하였습니다.'); location.href='writenotelist.php'</script>";
    else
        echo "<script>alert('삭제가 완료되었습니다.'); location.href='writenotelist.php'</script>";
    }
}
?>