<?php
include_once('connect.php');
$name = $_POST['name'];
$brith = $_POST['brith'];
$telno = $_POST['telno'];

$sql = "SELECT * FROM user WHERE name = '$name' and brith = '$brith' and telno = '$telno'";

$result = $conn->query($sql);

if($result -> num_rows > 0) {
    $row = $result->fetch_assoc();
    $search_id = $row['email'];
    echo "<script>alert('$search_id'); location.href='signin.html'</script>'";
}
else
    echo "<script>alert('해당 데이터가 없습니다.'); location.href='searchemail.php'</script>";
?>