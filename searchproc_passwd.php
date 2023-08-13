<?php
include_once('connect.php');
$email = $_POST['email'];
$name = $_POST['name'];
$brith = $_POST['brith'];
$telno = $_POST['telno'];

$sql = "SELECT * FROM user WHERE email = '$email' and name = '$name' and brith = '$brith' and telno = '$telno'";

$result = $conn->query($sql);

if($result -> num_rows > 0) {
    $row = $result->fetch_assoc();
    $search_passwd = $row['passwd'];
    echo "<script>alert('$search_passwd'); location.href='signin.html'</script>'";
}
else
    echo "<script>alert('해당 데이터가 없습니다.'); location.href='searchpasswd.php'</script>";
?>