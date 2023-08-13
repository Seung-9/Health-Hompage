<!DOCTYPE html>
<html>
    <head>
        <title>게시판</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="board.css">
    </head>
    <body>
        <script> 
        function submit2(frm) { 
            frm.action='delboard.php'; 
            frm.submit(); 
            return true; 
        } 
        </script> 
        <?php
        session_start();
        include_once('connect.php');
        $mail = $_GET['email'];
        $logged = false;
        if(isset($_SESSION['uid'])) {
            $logged = true;
            $email = $_SESSION['uid'];
			$name = $_SESSION['uname'];
            $no = $_GET['no'];
            if($_SESSION['role'] != 'user')    $admin = true;
            else $admin = false;
		}
        $sql = "SELECT * FROM board WHERE email='$mail' and no = $no";
        $result=$conn->query($sql);
        if($result->num_rows > 0) {
            while($row=$result->fetch_assoc()) {
                $hit = $row['hit'];
                $hit += 1;
                $sql = "UPDATE board SET hit = '$hit' WHERE no = $no";
                $conn->query($sql);
                ?>
                    <div class="wrap">
                        <h1>게시글</h1>
                        <h4>자유게시판</h4>
                        <div class="container">
                            <form action="modboard.php" method="post" enctype="multipart/form-data">
                                <div class="no" hidden>
                                    <input type="text" name="no" value=<?=$row['no']?> readonly>
                                </div> 
                                <div class="email" hidden>
                                    <input type="text" name="email" value=<?=$row['email']?> readonly>
                                </div>
                                <div class="title">
                                    <input type="text" name="title" value=<?=$row['title']?> readonly>
                                </div>
                                <hr>
                                <div class="name">
                                    <input type="text" name="name" value="<?=$row['name']?>" readonly>
                                </div>
                                <hr>
                                <div class="content">
                                    <input type="text" name="content" value="<?=$row['content']?>"readonly>
                                </div>
                                <?php if(isset($row['photo'])) { ?>
                                <div class="content">
                                        <label for="lname">첨부파일</label>
                                    <div class="content">
                                        <p><a href='filedownload.php?file=<?=$row['photo']?>'><?=$row['photo']?></a></p>
                                        <img src="./boardImg/<?=$row['photo']?>" style="width:100px; height:100px; position:absolute;">
                                    </div>
                                </div>
                                <?php }
                                if($admin || $email==$mail) { // admin이거나 해당 글을 작성한 사용자만 수정 및 삭제를 할 수 있음 ?> 
                                <div class="btn">
                                    <button type="submit" name="submit" onclick="locaton.href='modboard.php'" style=>수정하기</button>
                                    <button type="submit" class="btn" onclick='return submit2(this.form);'>삭제하기</button>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                <?php } ?>
            <?php } ?>
    </body>
</html>