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
            frm.action='boardlist.php'; 
            frm.submit(); 
            return true; 
        } 
        </script> 
        <?php
        session_start();
        include_once('connect.php');
        $logged = false;
        if(isset($_SESSION['uid'])) {
            $no = $_POST['no'];
            $logged = true;
            $email = $_POST['email'];
			$name = $_POST['name'];
		}
        $sql = "SELECT * FROM board WHERE email='$email' and no = $no";
        $result=$conn->query($sql);
        if($result->num_rows > 0) {
            while($row=$result->fetch_assoc()) {
                $hit = $row['hit'];
                $hit += 1;
                ?>
                    <div class="wrap">
                        <h1>게시글</h1>
                        <h4>자유게시판</h4>
                        <div class="container">
                            <form action="modboardproc.php" method="post" enctype="multipart/form-data">
                                <div class="no" hidden>
                                    <input type="text" name="no" value=<?=$row['no']?>>
                                </div> 
                                <div class="email" hidden>
                                    <input type="text" name="email" value=<?=$row['email']?>>
                                </div> 
                                <div class="title">
                                    <input type="text" name="title" value=<?=$row['title']?>>
                                </div>
                                <hr>
                                <div class="name">
                                    <input type="text" name="name" value="<?=$row['name']?>" readonly>
                                </div>
                                <hr>
                                <div class="content">
                                    <input type="text" name="content" value="<?=$row['content']?>">
                                </div>
                                <div class="btn">
                                    <button type="submit" name="submit" onclick="locaton.href='boardlist.php'">수정하기</button>
                                    <button type="submit" class="btn" onclick='return submit2(this.form);'>돌아가기</button>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
            <?php } ?>
    </body>
</html>