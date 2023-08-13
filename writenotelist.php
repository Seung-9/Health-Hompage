<!DOCTYPE html>
<html>
    <head>
        <title>운동일지</title>
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
        <?php
        session_start();

        $logged = false;
        if(isset($_SESSION['uid'])) {
            $email = $_SESSION['uid'];
            $uname = $_SESSION['uname'];
            $logged = true;
            if($_SESSION['role'] == 'user') $admin = false;
            else    $admin = true;
            if($_SESSION['regis'] != 'X')   $register = true;
            else    $register = false;
        }
        include_once('connect.php');

        if(!$register || !$logged)
            echo "<script>alert('헬스장 등록 후 이용 가능합니다.'); location.href='register.php';</script>";
        else if($register && !$admin){
            echo "<h1 style='text-align:center';>{$uname}님의 운동일지</h1>";
            $sql = "SELECT * FROM note WHERE email = '$email' order by date asc"; // 오름차순
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $no = 1;    ?>
                <hr>
                <script> 
                function submit2(frm) { 
                    frm.action='notemodify.php'; 
                    frm.submit(); 
                    return true; 
                } 
                </script> 
                <form action="delnote.php" method="post">
                <table class="wrap">
                    <tr>
                    <th></th><th>NO</th><th>이름</th><th>운동일자</th><th>종목</th><th>세트</th><th>무게/횟수</th><th>노트</th><th>피드백(관리자)</th><th>삭제</th><th>수정</th>
                    </tr>
                <?php
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?=$row['no']?>"></td>
                    <td><?=$no++?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['date']?></td>
                    <td><?=$row['subject']?></td>
                    <td>
                    <?php
                    for($i=1; $i<=$row['sets']; $i++) { ?>
                        <?=$i?>세트<br>
                    <?php } ?>
                    </td>
                    <td>
                    <?php
                        for($i=0; $i<$row['sets']; $i++) {
                             $weight[$i] = substr($row['weight'], 3*$i, 2);
                             $cnt[$i] = substr($row['cnt'], 3*$i, 2);
                            echo "$weight[$i]kg/$cnt[$i]회<br>";
                        }
                    ?>
                    </td>
                    <td><?=$row['note']?></td>
                    <td><?=$row['fedback']?></td>
                    <td><button type="submit" class="btn2" onclick="location.href='delnote.php'">삭제</button></td>
                    <td><button type="submit" class="btn2" onclick='return submit2(this.form);'>수정</button></td>
                </tr>
                <?php } ?> <!-- while -->
                </table>
                </form>
            <?php } ?> <!-- if -->
        <?php } // else if
        else if($admin) {
            $email = $_GET['email'];
            $name = $_GET['name'];
            echo "<h1 style='text-align:center';>{$name}님의 운동일지</h1>";
            $sql = "SELECT * FROM note where email ='$email'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $no = 1;    ?>
                <hr>
                <script> 
                function submit2(frm) { 
                    frm.action='notemodify.php'; 
                    frm.submit(); 
                    return true; 
                } 
                </script> 
                <form action="delnote.php" method="post">
                <table class="wrap">
                    <tr>
                    <th></th><th>NO</th><th>이름</th><th>운동일자</th><th>종목</th><th>세트</th><th>무게/횟수</th><th>노트</th><th>피드백(관리자)</th><th>삭제</th><th>수정</th>
                    </tr>
                <?php
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?=$row['no']?>"></td>
                    <td><?=$no++?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['date']?></td>
                    <td><?=$row['subject']?></td>
                    <td>
                    <?php
                    for($i=1; $i<=$row['sets']; $i++) { ?>
                        <?=$i?>세트<br>
                    <?php } ?>
                    </td>
                    <td>
                    <?php
                        for($i=0; $i<$row['sets']; $i++) {
                             $weight[$i] = substr($row['weight'], 3*$i, 2);
                             $cnt[$i] = substr($row['cnt'], 3*$i, 2);
                            echo "$weight[$i]kg/$cnt[$i]회<br>";
                        }
                    ?>
                    </td>
                    <td><?=$row['note']?></td>
                    <td><?=$row['fedback']?></td>
                    <td><button type="submit" class="btn2" onclick="location.href='delnote.php'">삭제</button></td>
                    <td><button type="submit" class="btn2" onclick='return submit2(this.form);'>수정</button></td>
                </tr>
                <?php } ?> <!-- while -->
                </table>
                </form>
                <?php } ?> <!--if -->
            <?php } ?> <!-- else if -->
        <button type="submit" class="btn" onclick="location.href='umain.php'">메인으로</button>
    </body>
</html>