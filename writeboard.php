<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>게시판</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="board.css">
    </head>
    <body>
        <?php
        if(isset($_SESSION['uid'])) {
            $email = $_SESSION['uid'];
			$name = $_SESSION['uname'];
		}
        ?>
        <div class="wrap">
            <h1>게시글 작성</h1>
            <h4>자유게시판</h4>
            <div class="container"></div>
                <form action="writeboardproc.php" method="post" enctype="multipart/form-data">
                    <div class="title">
                        <input type="text" name="title" placeholder="제목" required>
                    </div>
                    <hr>
                    <div class="name">
                        <input type="text" name="name" value="<?=$name?>" readonly>
                    </div>
                    <hr>
                    <div class="content">
                        <input type="text" name="content" placeholder="내용" required>
                    </div>
                    <div class="password">
                        <input type="checkbox" value="1" name="lockpost">비밀글입니다
                        <input type="password" name="password" placeholder="비밀번호">  
                    </div>
                    <div class="file">
                        <input type="file" name="photo">
                    </div>
                    <div class="btn">
                        <input type="submit" name="submit" onclick="locaton.href='writeboardproc.php'"; value="등록하기">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>