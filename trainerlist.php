<!DOCTYPE html>
<html>
    <head>
        <title>PT 예약</title>
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
        .btn {
            margin-left:90%;
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
        <h1 style="text-align:center";>트레이너 리스트</h1>
        <?php
        session_start();

        $logged = false;
        if(isset($_SESSION['uid'])) {
            $logged = true;
            if($_SESSION['role'] == 'user') $admin = false;
            else    $admin = true;
        }
        include_once('connect.php');

        if(!$logged)
            echo "<script>alert('로그인 후 이용하세요.'); location.href='signin.php';</script>";
        else if($logged && !$admin) {
            $sql = "SELECT * FROM trainer";
            $result = $conn->query($sql);
            if($result->num_rows > 0) { ?>
                <hr>
                <form action="reserve.php" method="post">
                    <table class="wrap">
                        <tr>
                        <th></th><th>이름</th><th>사진</th><th>나이/성별</th><th>전화번호</th><th>확정</th>
                        </tr>
                    <?php
                    while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?=$row['tname']?>@<?=$row['telno']?>@<?=$row['photo']?>"></td>
                        <td><?=$row['tname']?></td>
                        <td><img src="uploads/<?=$row['photo']?>" style="width:70%; height:200px;"></td>
                        <td><?=$row['age']?>/<?=$row['gen']?></td>
                        <td><?=$row['telno']?></td>
                        <td><button type="submit" class="btn2" onclick="location.href='reserve.php'">확정</button></td>
                    </tr>
                    <?php } ?> <!-- while -->
                    </table>
                </form>
                <button type="submit" class="btn" onclick="location.href='umain.php'">메인으로</button>
            <?php } ?> <!-- if -->
        <?php } // else
        else if($logged && $admin) {
            $sql = "SELECT * FROM trainer";
            $result = $conn->query($sql);
            if($result->num_rows > 0) { ?>
                <hr>
                <form action="deltranier.php" method="post">
                    <table class="wrap">
                        <tr>
                        <th></th><th>이름</th><th>사진</th><th>나이/성별</th><th>전화번호</th><th>삭제</th>
                        </tr>
                    <?php
                    while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?=$row['tname']?>@<?=$row['telno']?>"></td>
                        <td><?=$row['tname']?></td>
                        <td><img src="uploads/<?=$row['photo']?>" style="width:70%; height:200px;"></td>
                        <td><?=$row['age']?>/<?=$row['gen']?></td>
                        <td><?=$row['telno']?></td>
                        <td><button type="submit" class="btn2" onclick="location.href='deltrainer.php'">삭제하기</button></td>
                    </tr>
                    <?php } ?> <!-- while -->
                    </table>
                </form>
                <button type="submit" class="btn" onclick="location.href='umain.php'">메인으로</button>
            <?php } ?>
        <?php } ?>
    </body>
</html>