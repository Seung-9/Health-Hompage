<?php
session_start();
$email = $_SESSION['uid'];
$chk = isset($_POST['chk']) ? $_POST['chk'] : '';

include_once('connect.php');

// admin이 회원정보에서 탈퇴할 때
if($chk == '' && $_SESSION['role'] != 'user')
	echo "<script>alert('삭제할 데이터를 가져오세요'); location.href='userlist.php';</script>";

// user가 메인페이지에서 탈퇴할 때
if($chk == '' && $_SESSION['role'] == 'user') {
	$sql = "DELETE FROM user WHERE email = '$email'";
	$conn->query($sql);
	if($conn->query($sql)) {
		session_destroy();
		echo "<script>alert('회원탈퇴 성공'); location.href='index.php';</script>";
	}
	else
		echo "회원탈퇴 처리 중에 오류가 발생했습니다.".$conn->error;
}
// admin이 회원정보에서 탈퇴할 때
if(count($chk)) {
	for($i=0; $i<count($chk); $i++) {
		$pos = strpos($chk[$i], "@");
		$name = substr($chk[$i], 0, $pos);
		$brith = substr($chk[$i], $pos+1, 20);
		$sql = "DELETE FROM user WHERE name = '$name' and brith = '$brith'";
		if($conn->query($sql)) {
			session_destroy();
			echo "<script>alert('회원탈퇴 성공'); location.href='umai.php';</script>";
		}
		else
			echo "회원탈퇴 처리 중에 오류가 발생했습니다.".$conn->error;
	}
}
?>