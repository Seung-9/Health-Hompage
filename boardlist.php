<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="board.css">
</head>
<body>
<div class="wrap">
  <h1>자유게시판</h1>
  <br>
  <br>
  <hr>
    <table class="list_container">
        <tr>
            <th width="70">번호</th>
            <th width="500">제목</th>
            <th width="120">글쓴이</th>
            <th width="100">작성일</th>
            <th width="100">조회수</th>
        </tr>
        <?php
        session_start();
        include_once('connect.php');

        // admin 구분
        if($_SESSION['role'] != 'user') $admin = true;
        else    $admin = false;

        // 현재 Page 받아오기
        if(isset($_GET['page']))    $page = $_GET['page'];
        else    $page = 1;
        
        $sql = "SELECT * FROM board";  
        $result = $conn->query($sql);
        $row_num = mysqli_num_rows($result); // 전체 레코드 수
        $list = 5;
        $block_cnt = 5;

        $block_num = ceil($page/$block_cnt);
        $block_start = (($block_num - 1) * $block_cnt) + 1;
        $block_end = $block_start + $block_cnt - 1;

        $total_page = ceil($row_num / $list);
        if($block_end > $total_page)    $block_end = $total_page;
        $total_block = ceil($total_page / $block_cnt);
        $start_num = ($page -1) * $list;

        // 검색 기능
        if(isset($_GET['keyword']) && strpos($_GET['keyword'], "%") === false) {
            $keyword = $_GET['keyword'];
            $keyword = '%'.$keyword.'%';
        }
        else if(!isset($_GET['keyword'])) $keyword = "%";
        else $keyword = $_GET['keyword'];

        $sql = "SELECT * FROM board WHERE title like '$keyword' order by no desc limit $start_num, $list";
        if($result = $conn->query($sql)) {
            while($row=$result->fetch_assoc()) { ?>
            <tr>
                <td width="70"><?=$row['no']?></td>
                <td width="500">
                    <?php if(!$admin && $row['lock'] == 1) { ?>
                        <a href="pwcheck.php?no=<?=$row['no']?>&&email=<?=$row['email']?>>">
                        <?=$row['title']?></a>
                    <?php } else if($admin) { ?>
                        <a href="showboard.php?no=<?=$row['no']?>&&email=<?=$row['email']?>">
                        <?=$row['title']?></a>
                    <?php } else { ?>
                        <a href="showboard.php?no=<?=$row['no']?>&&email=<?=$row['email']?>">
                        <?=$row['title']?></a>
                    <?php } ?>
                </td>
                <td width="120"><?=$row['name']?></td>
                <td width="100"><?=$row['wdate']?></td>
                <td width="100"><?=$row['hit']?></td>
            </tr>
        <?php } ?>
        </table>
        <div class="btn">
            <a href="umain.php"><button>메인으로</button></a>
            <a href="writeboard.php"><button>글쓰기</button></a>
        </div>
        <div class="page_area">
            <ul>
                <?php
                if($page <= 1) {
                    echo "<li class='select'>처음</li>";
                } else {
                    echo "<li><a href='boardlist.php?page=1&keyword=$keyword'>처음</a></li>";
                }
                if($page <= 1) {

                } else {
                    $pre = $page - 1;
                    echo "<li><a href='boardlist.php?page=$pre&keyword=$keyword'>이전</a></li>";
                }
                for($i = $block_start; $i <= $block_end; $i++) {
                    if($page == $i) {
                        echo "<li class='select'>[$i]</li>";
                    } else {
                        echo "<li><a href='boardlist.php?page=$i&keyword=$keyword'>[$i]</a></li>";
                    }
                }
                if($block_num >= $total_block) {

                } else {
                    $next = $page + 1;
                    echo "<li><a href='boardlist.php?page=$next&keyword=$keyword'>다음</a></li>";
                }
                if($page >= $total_page) {
                    echo "<li class='select'>마지막</li>";
                } else {
                    echo "<li><a href='boardlist.php?page=$total_page&keyword=$keyword'>마지막</a></li>";
                }
                ?>
            </ul>
        </div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="search_area">
                <input type="text" name="keyword" placeholder="Search keyword">
                <button type="submit">Search</button>
            </form>
        <?php } ?>
  </div>
</body>
</html>