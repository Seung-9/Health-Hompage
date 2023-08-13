<!DOCTYPE html>
<html>
<head>
    <title>Inbody</title>
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
            $email = $_SESSION['uid'];
            $logged = true;
            if($_SESSION['regis'] != 'X')   $register = true;
            else    $register = false;
        }
        if($register == false) {
            echo "<script>alert('헬스장 등록 후 이용 가능합니다.'); location.href='register.php';</script>";
        }
        include_once('connect.php');
        $sql = "SELECT * FROM user WHERE email = '$email'";

        $result = $conn->query($sql);

        if($result->num_rows > 0) { 
            $row = $result->fetch_assoc();  ?>
        <div class="warp">
            <header class="header">
                <div class="header_inner">
                    <a href="index.php" class="logo"><img src="image/homeicon.png" style="width: 300px; height: 60px;"></a>
                    <p> My InBody Note</p>
                </div>
            </header>
            <script> 
            function submit2(frm) { 
                frm.action='inbodygraph.php'; 
                frm.submit(); 
                return true; 
            } 
            </script> 
            <div class="container">
              <form action="inbodyproc.php" method="post">
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
                          <label for="fname">성별</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="gen" value="<?=$row['gen']?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">몸무게</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="weight" value="<?=$row['weight']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">작성 일자</label>
                        </div>
                        <div class="col-75">
                          <input type="date" name="date">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="fname">골격근량</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="muscle">
                        </div>
                      </div>
                      <input type="submit" onclick="locaton.href='inbodyproc.php';" value="등록하기">
                      <input type="submit" onclick='return submit2(this.form);' value="조회하기">
                </form>
            </div>
        </div>
        <?php } ?>
    </body>
</html>