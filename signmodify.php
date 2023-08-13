<!DOCTYPE html>
<html>
<head>
    <title>회원정보변경</title>
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
        $email = $_SESSION['uid'];
        include_once('connect.php');
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if(isset($result) && $result -> num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <div class="warp">
            <header class="header">
                <div class="header_inner">
                    <a href="index.html" class="logo"><img src="image/homeicon.png" style="width: 300px; height: 60px;"></a>
                </div>
            </header>
            <div class="container">
              <form action="signmodproc.php" method="post">
                    <div class="row">
                        <div class="col-25">
                          <label for="fname">이메일</label>
                        </div>
                        <div class="col-75">
                        <input type="text" name="email" value="<?=$row['email']?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">비밀번호</label>
                        </div>
                        <div class="col-75">
                        <input type="password" name="pwd" value="<?=$row['passwd']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">이름</label>
                        </div>
                        <div class="col-75">
                        <input type="text" name="uname" value="<?=$row['name']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">전화번호</label>
                        </div>
                        <div class="col-75">
                        <input type="text" name="telno" value="<?=$row['telno']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">키</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="height" value="<?=$row['height']?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">몸무게</label>
                        </div>
                        <div class="col-75">
                        <input type="text" name="weight" value="<?=$row['weight']?>">
                        </div>
                      </div>
                      <input type="submit" onclick="locaton.href='signup.php';" value="변경하기">
                </form>
            </div>
        </div>
        <?php } ?>
    </body>
</html>