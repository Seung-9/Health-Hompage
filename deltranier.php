<?php
session_start();
include_once('connect.php');
$email = $_SESSION['uid'];
$chk = $_POST['chk'];
$logged = false;
if(isset($email)) { // 로그인 체크
    $logged = true;
    if($_SESSION['role'] != 'user') $admin = true;
    else    $admin = false;
}
if($logged && $admin) {
    for($i=0; $i<count($chk); $i++) {
        $pos = strpos($chk[$i], '@');
        $tname = substr($chk[$i], 0, $pos);
        $telno = substr($chk[$i], $pos+1, 11);
        $sql = "drop table $tname";
        $sql2 = "DELETE FROM trainer WHERE tname= '$tname' and telno = '$telno'";
        if(!$conn->query($sql))
            echo "<script>alert('삭제 중 오류가 발생하였습니다.'); location.href='umain.php'</script>";
        else
            $conn->query($sql2);
            echo "<script>alert('삭제가 완료되었습니다.'); location.href='umain.php'</script>";
    }
}
?>