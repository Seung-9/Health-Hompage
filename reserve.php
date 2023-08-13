<!DOCTYPE html>
<html>
<head>
    <title>PT 예약</title>
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
        margin-left: 65px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color:rgba(0, 0, 0, 0.5);
        color:white;
    }
    label {
        margin-left:30px;
        padding: 12px 0px 12px 50px;
        display: inline-block;
        color:white;
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
        include_once('connect.php');
        $email = $_SESSION['uid'];
        $name = $_SESSION['uname'];
        $logged = false;
        if(isset($_SESSION['uid'])) $logged = true;
        if(!$logged)
            echo "<script>alert('로그인 후 이용하세요..'); location.href='signin.php';</script>";
        else {
            $chk = $_POST['chk'];
            if(isset($chk)) {
                $pos = strpos($chk[0], '@');
                $tname = substr($chk[0], 0, $pos);
                $telno = substr($chk[0], $pos+1, 11);
                $photo = substr($chk[0], $pos+13, 45);
            }
        }
        $sql = "SELECT * FROM user WHERE email = '$email'";

        $result = $conn->query($sql);

        if($result->num_rows > 0) { ?>
        <div class="warp">
            <header class="header">
                <div class="header_inner">
                    <a href="index.php" class="logo"><img src="image/homeicon.png" style="width: 300px; height: 60px;"></a>
                    <p>PT 예약하기</p>
                </div>
            </header>
            <div class="container"  style="background-image:url('uploads/<?=$photo?>'); background-size:cover; background-attachment:none; background-position:center;">
              <form action="reserveproc.php" method="post">
                    <div class="row">
                        <div class="col-25">
                          <label for="fname">회원 이메일</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="email" value="<?=$email?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">회원 이름</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="name" value="<?=$name?>" readonly>
                        </div>
                      </div>
                      <br>
                      <hr>
                      <br>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">트레이너 이름</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="tname" value="<?=$tname?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">트레이너 번호</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="telno" value="<?=$telno?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">PT 날짜</label>
                        </div>
                        <div class="col-75">
                          <input type="date" name="schedule">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">프로그램</label>
                        </div>
                        <div class="col-75">
                          <select name="program">
                            <option value="solo">1:1PT/120만원</option>
                            <option value="group">1:4PT/60만원</option>
                            <option value="pilates">필라테스PT/120만원</option>
                          </select>
                        </div>
                      </div>
                      <input type="submit" onclick="locaton.href='reserveproc.php';" value="등록하기">
                </form>
            </div>
        </div>
        <?php } ?>
    </body>
</html>