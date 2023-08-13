<!DOCTYPE html>
<html>
<head>
    <title>운동일지 기록하기</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
    * {
        font-family: sans-serif;
        box-sizing: border-box;
        margin: 0px;
        padding: 0px;
    }
    body {
        background-color: rgb(243, 243, 242);
    }
    .wrap {
        width: 100%;
    }
    header {
        width: 100%;
    }
    .header > .header_inner {
        padding-top: 5%;
        margin: 0px 40%;
    }
    .header_inner > p {
        color: rgb(149, 121, 42);;
        font-size: 20px;
        padding-left: 60px;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 25px 25px 15px 25px;
        margin-top: 25px;
        border: 0.5px solid rgb(149, 121, 42);
        margin-left: 25%;
        width: 50%;
        height: 100%;
    }
    input, select {
        width: 70%;
        margin-left: 70px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    label {
        padding: 12px 12px 12px 90px;
        display: inline-block;
    }
    input[type=submit] {
      font-size: 20px;
      background-color: rgba(0, 0, 0, 0.8);
      width: 74%;
      color: rgb(149, 121, 42);
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 20px;
      margin-left: 90px;
    }
    input[type=submit]:hover {
        background-color: rgba(0, 0, 0, 0.5);
        color: black;
    }

    .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
    }
    .col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;
    }
    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    </style>
    </head>
    <body>
        <?php
        session_start();
        $logged = false;
        if(isset($_SESSION['uid'])) {
            $chk = $_POST['chk'];
            $email = $_SESSION['uid'];
            for($i=0; $i<count($chk); $i++) $no = substr($chk[0], 0, 10);
            $logged = true;

            if($_SESSION['role'] == 'user') $admin = false;
            else    $admin = true;

            if($_SESSION['regis'] != 'X')   $register = true;
            else    $register = false;
        }
        if($register == false) {
            echo "<script>alert('헬스장 등록 후 이용 가능합니다.'); location.href='register.php';</script>";
        }
        include_once('connect.php');
        $sql = "SELECT * FROM note WHERE no = '$no'";

        $result = $conn->query($sql);

        if($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) { ?>
        <div class="warp">
            <header class="header">
                <div class="header_inner">
                    <a href="index.php" class="logo"><img src="image/homeicon.png" style="width: 300px; height: 60px;"></a>
                    <p> 나만의 운동일지</p>
                </div>
            </header>
            <script> 
            function submit2(frm) { 
                frm.action='writenotelist.php'; 
                frm.submit(); 
                return true; 
            } 
            </script>
            <?php if(!$admin) { ?>
            <div class="container">
              <form action="notemodifyproc.php" method="post">
                    <div class="row" hidden>
                        <div class="col-25">
                          <label for="fname">No</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="no" value="<?=$row['no']?>">
                        </div>
                      </div>
                    <div class="row" hidden>
                        <div class="col-25">
                          <label for="fname">이메일</label>
                        </div>
                        <div class="col-75">
                          <input type="text" value="<?=$row['email']?>">
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-25">
                          <label for="fname">이름</label>
                        </div>
                        <div class="col-75">
                          <input type="text" value="<?=$row['name']?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">운동일자</label>
                        </div>
                        <div class="col-75">
                          <input type="date" name="date" value="<?=$row['date']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">운동 종목</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="subject" value="<?=$row['subject']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">세트</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="sets" value="<?=$row['sets']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">무게</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="weight" value="<?=$row['weight']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">횟수</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="cnt" value="<?=$row['cnt']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">메모</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="note" value="<?=$row['note']?>">
                        </div>
                      </div>
                      <input type="submit" onclick="locaton.href='notemodifyproc.php';" value="수정하기">
                      <input type="submit" onclick='return submit2(this.form);' value="돌아가기">
                </form>
            </div>
        </div>
        <?php } // if
        else if($admin) { ?>
        <div class="container">
              <form action="notemodifyproc.php" method="post">
                    <div class="row" hidden>
                        <div class="col-25">
                          <label for="fname">No</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="no" value="<?=$row['no']?>">
                        </div>
                      </div>
                    <div class="row" hidden>
                        <div class="col-25">
                          <label for="fname">이메일</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="email" value="<?=$row['email']?>">
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-25">
                          <label for="fname">이름</label>
                        </div>
                        <div class="col-75">
                          <input type="text" value="<?=$row['name']?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">운동일자</label>
                        </div>
                        <div class="col-75">
                          <input type="date" name="date" value="<?=$row['date']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">운동 종목</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="subject" value="<?=$row['subject']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">세트</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="sets" value="<?=$row['sets']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">무게</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="weight" value="<?=$row['weight']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">횟수</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="cnt" value="<?=$row['cnt']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">메모</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="note" value="<?=$row['note']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">피드백</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="fedback">
                        </div>
                      </div>
                      <input type="submit" onclick="locaton.href='notemodifyproc.php';" value="수정/피드백 남기기">
                      <input type="submit" onclick='return submit2(this.form);' value="돌아가기">
                </form>
            </div>
        <?php } ?>
        <?php } ?> <!-- while -->
        <?php } ?> <!-- if -->
    </body>
</html>