<?php
function uploadFile() {
	$target_dir = "./boardImg/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "파일 ".basename($_FILES['photo']['name'])."을 업로드하였습니다.";
        return basename($_FILES['photo']['name']);
    }
}
session_start();
include_once('connect.php');
$email = $_SESSION['uid'];
$name = $_SESSION['uname'];
$wdate = date('Y/m/d');
$title = $_POST['title'];
$content = $_POST['content'];
$photo = uploadFile();
$password = $_POST['password'];

$sql2 = "ALTER TABLE board auto_increment=1";
$conn->query($sql2);

if(isset($_POST['lockpost'])) {
    $lock = 1;
    if(isset($photo)) $sql = "INSERT INTO board(email, name, wdate, title, content, password, photo, `lock`) VALUES('$email', '$name', '$wdate', '$title', '$content', '$password', '$photo', $lock)";
    else $sql = "INSERT INTO board(email, name, wdate, title, content, password, `lock`) VALUES('$email', '$name', '$wdate', '$title', '$content', '$password', $lock)";
} else {
    $lock = 0;
    if(isset($photo)) $sql = "INSERT INTO board(email, name, wdate, title, content, photo, `lock`) VALUES('$email', '$name', '$wdate', '$title', '$content', '$photo', $lock)";
    else $sql = "INSERT INTO board(email, name, wdate, title, content, `lock`) VALUES('$email', '$name', '$wdate', '$title', '$content', $lock)";
}
if($conn->query($sql))
echo "<script>alert('게시물이 등록되었습니다.'); location.href='boardlist.php'</script>";
else
echo "<script>alert('게시물이 등록 중 오류가 발생하였습니다.'); location.href='writeboard.php'</script>";
?>