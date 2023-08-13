<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="index2.css">
        <title>몬스터짐</title>
    </head>
    <body>
        <?php
			session_start();
			$logged = false;
			if(isset($_SESSION['uid'])) {  // 세션에 uid 키가 정의되어 있으면 
				$uid = $_SESSION['uid'];
				$uname = $_SESSION['uname'];
				$logged = true;
                if($_SESSION['role'] == 'user') $admin = false;
                else    $admin = true;
			}
		include_once('connect.php');
        if($logged && !$admin) { ?>
        <div class = "intro_bg" id="link_header">
            <div class = "pagename">
                <h2><a href="index.php"><img src="image/homeicon.png">Monster Gym</a></h2>
            </div>
            <div class = "header">
                <ul class="nav">
                    <li class="nav-item1"><a href="index.php">Home</a></li>
                    <li class="nav-item2"><a href="javascript:void(0)">Health Note</a>
                        <div class="nav-menu">
                            <a href="writenote.php">Write</a>
                            <a href="inbody.php">InBody</a>
                        </div>
                    </li>
                    <li class="nav-item3"><a href="register.php">Register</a></li>
                    <li class="nav-item4"><a href="trainerlist.php">PT reserve</a></li>                        
                    <li class="nav-item5"><a href="boardlist.php">Board</a></li>
                </ul>
            </div>
            <div class="intro_text">
                <h3>최 &nbsp&nbsp적 &nbsp의 &nbsp&nbsp서 &nbsp&nbsp비 &nbsp&nbsp스 &nbsp&nbsp로&nbsp 모&nbsp&nbsp 시&nbsp&nbsp 겠&nbsp&nbsp 습&nbsp&nbsp 니&nbsp&nbsp 다</h3>
                <h1>You Can Do It</h1>
                <h1>With</h1>
                <h1>Monster Gym</h1>
            </div>
            <?php }
            else if($logged && $admin) { ?>
            <div class = "intro_bg" id="link_header">
            <div class = "pagename">
                <h2><a href="index.php"><img src="image/homeicon.png">Monster Gym</a></h2>
            </div>
            <div class = "header">
                <ul class="nav">
                    <li class="nav-item1"><a href="index.php">Home</a></li>
                    <li class="nav-item2"><a href="userlist.php">User list</a></li>
                    <li class="nav-item4"><a href="trainer_schedule.php">Trainer Schedule</a></li>
                    <li class="nav-item5"><a href="regis_trainer.php">Trainer register</a></li>
                    <li class="nav-item5"><a href="boardlist.php">Board</a></li>
                </ul>
            </div>
            <div class="intro_text">
                <h3>최 &nbsp&nbsp적 &nbsp의 &nbsp&nbsp서 &nbsp&nbsp비 &nbsp&nbsp스 &nbsp&nbsp로&nbsp 모&nbsp&nbsp 시&nbsp&nbsp 겠&nbsp&nbsp 습&nbsp&nbsp 니&nbsp&nbsp 다</h3>
                <h1>You Can Do It</h1>
                <h1>With</h1>
                <h1>Monster Gym</h1>
            </div>
            <?php } ?>
            <script>
                let mainText = document.querySelector(".intro_text");
                window.addEventListener('scroll',function() {
                    let value = window.scrollY;
                    console.log("scrollY", value);

                    if(value>400) {
                        mainText.style.animation='fadeOutLeft 1.5s';
                    } else {
                        mainText.style.animation='fadeInLeft 1.5s';
                    }
                });
            </script>
        </div>
    </body>
</html>