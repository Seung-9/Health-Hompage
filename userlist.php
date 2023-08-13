<!DOCTYPE html>
<html>
    <head>
        <title>회원리스트</title>
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
        <h1 style="text-align:center";>회원 리스트</h1>
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
            echo "<script>alert('접속 불가 페이지입니다..'); location.href='signout.php';</script>";
        else {
            $sql = "SELECT * FROM user WHERE role = 'user'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $no = 1;    ?>
                <hr>
                <form action="signdel.php" method="post">
                <table class="wrap">
                    <tr>
                    <th></th><th>NO</th><th>이메일</th><th>이름</th><th>생년월일</th><th>성별</th><th>전화번호</th><th>키/몸무게</th><th>헬스장 종료일</th><th>삭제</th>
                    </tr>
                <?php
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?=$row['name']?>@<?=$row['brith']?>"></td>
                    <td><?=$no++?></td>
                    <td><?=$row['email']?></td>
                    <td><a href='writenotelist.php?email=<?=$row['email']?>&name=<?=$row['name']?>'; style='text-decoration:none; color:black;'><?=$row['name']?></a></td>
                    <td><?=$row['brith']?></td>
                    <td><?=$row['gen']?></td>
                    <td><?=$row['telno']?></td>
                    <td><?=$row['height']?>cm/<?=$row['weight']?>kg</td>
                    <td><?=$row['regis']?></td>
                    <td><button type="submit" class="btn2" onclick="location.href='signdel.php'">삭제</button></td>
                </tr>
                <?php } ?> <!-- while -->
                </table>
                </form>
                <button type="submit" class="btn" onclick="location.href='umain.php'">메인으로</button>
            <?php } ?> <!-- if -->
        <?php } ?> <!-- else -->
    </body>
</html>