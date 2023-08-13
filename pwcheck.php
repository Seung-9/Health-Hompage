<?php
include_once('connect.php');
$no = $_GET['no'];
$sql = "SELECT email, password FROM board WHERE no='$no'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row=$result->fetch_assoc()) {
        $email = $row['email'];
        $password = $row['password'];
    }
}
?>
<div id='writepass'>
	<form action="" method="post">
 		<p>비밀번호<input type="password" name="pw"> <input type="submit" value="확인"></p>
 	</form>
</div>
	 <?php
	 	if(isset($_POST['pw'])) {
	 		$pw = $_POST['pw'];
			if($pw == $password) echo "<script>location.href='showboard.php?no=$no&&email=$email';</script>";
			else  echo "<script>alert('비밀번호가 틀립니다');</script>";
         }
    ?>