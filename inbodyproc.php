<?php
session_start();
include_once('connect.php');
$name = $_SESSION['uname'];
$gen = $_POST['gen'];
$date = $_POST['date'];
$weight = $_POST['weight'];
$muscle = $_POST['muscle'];

$sql = "INSERT INTO musclenote VALUES('$name', '$gen', '$date', $weight, $muscle)";

if($conn->query($sql)) {
$file = fopen('muscle.csv', 'w');
// $sql = "SELECT COUNT(*) FROM musclenote WHERE name = '$name'";
// $count = $conn->query($sql);
$sql = "SELECT date, weight, muscle FROM musclenote WHERE name = '$name'";
$result = $conn->query($sql);
    for($i=0; $i<$result->num_rows; $i++) {
        if($result->num_rows > 0) {
            $row = $result->fetch_row();
            if($gen == '여자')  $average = $row[1] * 0.36; // 여자는 자신의 체중 * 0.36 = 평균 골격근량
            else $average = $row[1] * 0.48; // 남자는 자신의 체중 * 0.48 = 평균 골격근량
            $date = $row[0];
            echo "$date : $row[1] : $row[2] : $average<br>";
        }
        if($i < $result->num_rows+1)
            $line = "$date, $row[1], $row[2], $average\n";
        else    $line = "$date, $row[1], $row[2], $average";
        fwrite($file, $line);
        echo "<script>alert('등록이 완료되었습니다.'); location.href='inbody.php'</script>";
    }
}
else
    echo "<script>alert('등록중 오류가 발생하였습니다..'); location.href='inbody.php'</script>";
?>