<!DOCTYPE html>
<html>
    <head>
        <title>

        </title>
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
    </head>
    <body>
        <h1 style="text-align:center;"> 회원 스케쥴 </h1>
        <hr>
        <br>
        <br>
        <?php
        session_start();

        $logged = false;
        if(isset($_SESSION['uid'])) {
            $logged = true;
            
            if($_SESSION['role'] != 'user') $admin = true;
            else    $admin = false;
        }
        include_once('connect.php');

        if(!$logged || !$admin) {
            echo "<script>alert('접근 불가 페이지입니다.'); location.href='umain.php';</script>";
        }
        if($admin) {
            $chk = $_POST['chk']; ?>
            <table class="wrap">
                <tr>
                    <th>PT누적 횟수</th><th>담당 트레이너</th><th>회원이름</th><th>프로그램 내용</th><th>PT 날짜</th>
                </tr>
            <?php
            for($i=0; $i<count($chk); $i++) {
                $pos = strpos($chk[$i], '@');
                $tname = substr($chk[$i], 0, $pos);
                $telno = substr($chk[$i], $pos+1, 20);

                $sql = "SELECT * FROM $tname order by schedule asc";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?=$row['no']?></td>
                        <td><?=$tname?></td>
                        <td><?=$row['uname']?></td>
                        <?php if($row['program'] == 'solo') { ?>
                            <td>1:1 PT</td>
                        <?php } ?>
                        <?php if($row['program'] == 'group') { ?>
                            <td>1:4 PT</td>
                        <?php } ?>
                        <?php if($row['program'] == 'pilates') { ?>
                            <td>1:1 Pilates PT</td>
                        <?php } ?>
                        <td><?=$row['schedule']?></td>
                    </tr>
                    <?php } 
                } ?>
                </table>
                <button type="submit" class="btn" onclick="location.href='umain.php'">메인으로</button>
            <?php } ?>
    </body>
</html>