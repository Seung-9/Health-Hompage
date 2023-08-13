<?php
function uploadFile() {
	$target_dir = "./uploads/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["photo"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		echo "오류 : 파일을 선택해주십시오.";
		$uploadOk = 0;
	}
	if ($_FILES["photo"]["size"] > 500000000) {
		echo "오류: 파일 크기가 500MB를 초과하였습니다.";
		$upload_ok = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "오류 : 이미지 확장자를 확인해주십시오.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "파일업로드를 종료합니다.";
		return null;
	} else {
		if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
			echo "파일 ".basename($_FILES['photo']['name'])."을 업로드하였습니다.";
			return basename($_FILES['photo']['name']);
		} else {
			echo "임사 파일을 이동 중에 오류가 발생하였습니다.";
			return null;
		}
	}
}
session_start();
include_once('connect.php');
$tname = $_POST['tname'];
$age = $_POST['age'];
$gen = $_POST['gen'];
$telno = $_POST['telno'];
$photo = uploadFile();

if($_SESSION['role'] == true) {
    $sql = "INSERT INTO trainer(tname, age, gen, telno, photo) VALUES('$tname', $age, '$gen', '$telno', '$photo')";
	$sql2 = "CREATE TABLE $tname (
		no INT NOT NULL AUTO_INCREMENT,
		uname VARCHAR(3) NULL,
		program VARCHAR(45) NULL,
		schedule VARCHAR(45) NULL,
		PRIMARY KEY(no)
		)";
    if($conn->query($sql)) {
		$conn->query($sql2);
        echo "<script>alert('트레이너가 등록되었습니다.'); location.href='umain.php'</script>";
    }
    else
        echo "<script>alert('트레이너가 등록 중 오류가 발생하였습니다.'); location.href='umain.php'</script>";
}
?>