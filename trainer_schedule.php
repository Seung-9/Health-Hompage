<!DOCTYPE html>
<html>
    <head>
        <title>Trainer Schedule</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        body {
            background-color:antiquewhite;
        }
        .wrap {
            position:relative;
            text-align:center;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
        .wrap th {
            border: 1px solid black;
            padding-top:12px;
            padding-bottom:12px;
            background-color: bisque;
        }

        .wrap td {
            border: 1px solid black;
            background-color: antiquewhite;
        }
        .btn3 {
            position: absolute;
            margin-left:68%;
            background-color: orange;
            color: black;
            padding: 16px 20px;
            border: none;
            border-radius:4px;
            cursor: pointer;
            width: 10%;
            margin-top: 10px;
        }
        .btn2 {
            position: absolute;
            margin-left:78%;
            background-color: orange;
            color: black;
            padding: 16px 20px;
            border: none;
            border-radius:4px;
            cursor: pointer;
            width: 10%;
            margin-top: 10px;
        }
        .btn {
            position: absolute;
            margin-left:88.5%;
            background-color: orange;
            color: black;
            padding: 16px 20px;
            border: none;
            border-radius:4px;
            cursor: pointer;
            width: 10%;
            margin-top: 10px;
        }
    </style>
    <body>
        <h1 style="text-align:center";>스케줄 조회</h1>
        <?php
        session_start();

        $logged = false;
        if(isset($_SESSION['uid'])) {  // 세션에 uid 키가 정의되어 있으면 
            $uid = $_SESSION['uid'];
            $uname = $_SESSION['uname'];
            $logged = true;
            if($_SESSION['role'] == 'user') $admin = false;
            else    $admin = true;
        }
        include_once('connect.php');

        if(!$admin || !$logged)
            echo "<script>alert('접속 불가 페이지입니다..'); location.href='umain.php';</script>";
        else {
            $sql = "SELECT * FROM trainer";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $no = 1;    ?>
                <hr>
                <form action="trainer_schedulelist.php" method="post">
                <table class="wrap">
                    <tr>
                    <th></th><th>이름</th><th>나이/성별</th><th>전화번호</th>
                    </tr>
                <?php
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?=$row['tname']?>@<?=$row['telno']?>"></td>
                    <td><?=$row['tname']?></td>
                    <td><?=$row['age']?>/<?=$row['gen']?></td>
                    <td><?=$row['telno']?></td>
                </tr>
                <?php } ?> <!-- while -->
                </table>
                <button type="submit" class="btn2" onclick="location.href='trainer_schedulelist.php'">조회하기</button>
                </form>
                <button type="submit" class="btn" onclick="location.href='umain.php'">메인으로</button>
            <?php } ?> <!-- if -->
        <?php } ?> <!-- else -->
    </body>
</html>