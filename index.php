<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="index.css">
        <title>몬스터짐</title>
    </head>
    <body>
        <!-- 팝업창 모달-->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:pink;">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:black;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background-color:white; height:500px;" id="popup">
                        <button type="button" class="btn btn-primary" id = "modal-close" style="position:absolute; margin-left:300px; margin-top:440px;">오늘 하루 닫기</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="position:absolute; margin:440px;">닫기</button>
                    </div>
                </div>
            </div>
        </div>
    <script>
        // 쿠키 생성
        function setCookie(name, value, expiredays){
        var today = new Date();
        today.setDate(today.getDate() + expiredays);
        document.cookie = name + '=' + escape(value) + '; expires=' + today.toGMTString();
        }
        // 쿠키 가져오기
        function getCookie(name) {
            var cookie = document.cookie;
            if (document.cookie != "") {
                var cookie_array = cookie.split("; ");
                for ( var index in cookie_array) {
                    var cookie_name = cookie_array[index].split("=");
                    if (cookie_name[0] == "mycookie") {
                        return cookie_name[1];
                    }
                }
            }
            return;
        }

        $("#modal-close").click(function() {
            $("#myModal").modal("hide");
            setCookie("mycookie", 'popupEnd', 1);
        })

        var checkCookie = getCookie("mycookie");

        // 만약 value에 popupEnd 가 들어가있으면 hide, 없으면 show
        if(checkCookie == 'popupEnd') {
            $("#myModal").modal("hide");
        } else {
            $('#myModal').modal("show");
        }
    </script>

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
		?>
        <div class = "intro_bg" id="link_header">
            <div class = "header">
                <div class = "pagename">
                    <h2><a href="#link_header" style="text-decoration: none;"><img src="image/homeicon.png">Monster Gym</a></h2>
                </div>
                <!-- 로그인 안 했을 때-->
                <?php if(!$logged) { ?> 
                    <ul class="nav">
                        <li class="nav-item"><a href="#link_header" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">Program</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">Facility</a></li>
                        <li class="nav-item"><a href="#link_main_text2" class="nav-link">Notice</a></li>
                        <li class="nav-item"><a href="#link_main_text3" class="nav-link">Contact</a></li>
                    </ul>
            </div>
            <div class="intro_text">
                <h3>최 &nbsp&nbsp적 &nbsp의 &nbsp&nbsp서 &nbsp&nbsp비 &nbsp&nbsp스 &nbsp&nbsp로&nbsp 모&nbsp&nbsp 시&nbsp&nbsp 겠&nbsp&nbsp 습&nbsp&nbsp 니&nbsp&nbsp 다</h3>
                <h1>You Can Do It</h1>
                <h1>With</h1>
                <h1>Monster Gym</h1>

                <button type="submit" class="btn" onclick="location.href='signin.html'">로그인</button>
                <button type="submit" class="btn" onclick="location.href='signup.html'">회원가입</button>
            </div>
            <?php }
            // user가 로그인 했을 때
            else if($logged && !$admin) { ?>
                    <ul class="nav">
                        <li class="nav-item"><a href="#link_header" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="umain.php" class="nav-link">UserPage</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">Program</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">Facility</a></li>
                        <li class="nav-item"><a href="#link_main_text2" class="nav-link">Notice</a></li>
                        <li class="nav-item"><a href="#link_main_text3" class="nav-link">Contact</a></li>
                    </ul>
            </div>
            <div class="intro_text">
                <h3>최 &nbsp&nbsp적 &nbsp의 &nbsp&nbsp서 &nbsp&nbsp비 &nbsp&nbsp스 &nbsp&nbsp로&nbsp 모&nbsp&nbsp 시&nbsp&nbsp 겠&nbsp&nbsp 습&nbsp&nbsp 니&nbsp&nbsp 다</h3>
                <h1>You Can Do It</h1>
                <h1>With</h1>
                <h1>Monster Gym</h1>
                <h3>환영합니다. <?=$uname?>님</h3>
                <button type="submit" class="btn" onclick="location.href='signmodify.php'">회원정보변경</button>
                <button type="submit" class="btn" onclick="location.href='signdel.php'">회원탈퇴</button>
                <button type="submit" class="btn" onclick="location.href='signout.php'">로그아웃</button>
            </div>
            <!-- admin이ㅣ 로그인 했을 때 -->
            <?php }
            else { ?>
                    <ul class="nav">
                        <li class="nav-item"><a href="#link_header" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="umain.php" class="nav-link">AdminPage</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">Program</a></li>
                        <li class="nav-item"><a href="#link_main_text1" class="nav-link">Facility</a></li>
                        <li class="nav-item"><a href="#link_main_text2" class="nav-link">Notice</a></li>
                        <li class="nav-item"><a href="#link_main_text3" class="nav-link">Contact</a></li>
                    </ul>
            </div>
            <div class="intro_text">
                <h3>최 &nbsp&nbsp적 &nbsp의 &nbsp&nbsp서 &nbsp&nbsp비 &nbsp&nbsp스 &nbsp&nbsp로&nbsp 모&nbsp&nbsp 시&nbsp&nbsp 겠&nbsp&nbsp 습&nbsp&nbsp 니&nbsp&nbsp 다</h3>
                <h1>You Can Do It</h1>
                <h1>With</h1>
                <h1>Monster Gym</h1>
                <h3>환영합니다. <?=$uname?>님</h3>
                <button type="submit" class="btn" onclick="location.href='signout.php'">로그아웃</button>
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
        <!-- (header)intro end-->
        <!-- introduce start -->
        <div class="introduce" id="link_main_text2">
            <div class="introduce_main">
                <div class=introduce_img>
                    <img src="image/motive.jpg">
                </div>
                <div class="introduce_content">
                    <h3>Monster Gym과 함께 精進</h3>
                    <p>1. 근력운동은 뼈와 관련된 질환들을 예방합니다.<br>
                    2. 기초대사량과 신진대사율의 증가로 살이 찌지 않습니다.<br>
                    3. 몸과 마음이 건강해집니다.<br>
                    4. 자신감이 생겨 자존감 또한 높아져 삶의 질이 높아집니다.
                    </p>
                    <button type="submit" class="btn4" onclick="location.href='program.html'">+</button>
                </div>
            </div>
        </div>

        <script>
                $(function () {
                    // actvie 활성화 
                    $(".nav > .active").css("color", "red");
                    $('.nav-link').click(function () {
                        // .nav-link 클릭시 이전의 active 값 해제 후, 
                        $(".nav-item > .active").css("color", "rgb(149, 121, 42);");
                        $('.nav-link').removeClass('active');
                        // 클릭한 위치 active 적용 
                        $(this).addClass('active');
                        $(".nav-item > .active").css("background-color", "rgba(0, 0, 0, 0.8)");
                    });
                });
            </script>

        <script>
            let mainText2 = document.querySelector(".introduce_main");
            window.addEventListener('scroll',function() {
                let value2 = window.scrollY;
                console.log("scrollY", value2);

                if(value2>1000 || value2 < 250) {
                    mainText2.style.animation='fadeOutRight 1s';
                } else {
                    mainText2.style.animation='fadeInRight 1s';
                }
            });
        </script>

        <!-- introduce end-->

        <!-- content start-->
        <article>
        <div class = "content">
            <div class = "content_main" id="link_main_text1">
                <div class = "facility">
                    <div id="cont">Facility</div>
                    <button type="submit" class="btn2" onclick="location.href='facility.html'">+ 자세히 보기</button>
                </div>
                <div class="section">
                    <input type="radio" name="slide" id="slide01" checked>
                    <input type="radio" name="slide" id="slide02">
                    <input type="radio" name="slide" id="slide03">
                    
                    <div class="slide-wrap">
                        <ul class="slidelist">
                            <li>
                                <a>
                                    <label for="slide03" class="left"></label>
                                    <div class="textbox">
                                        <h3>1:1 Personal Traning</h3>
                                        <p>1:1 개인 맞춤 전문 트레이닝으로
                                        <br>회원님들이 원하시는 목표를 이루어
                                        <br>드립니다.</p>
                                        <button type="submit" class="btn3" onclick="location.href='program.html'" style="transform:translate(-100%,30%);">+ 자세히 보기</button>
                                    </div>
                                    <img src="image/program.jpg">
                                    <label for="slide02" class="right"></label>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <label for="slide01" class="left"></label>
                                    <div class="textbox">
                                        <h3>Group Traning</h3>
                                        <p>여러명의 회원분들과 함께하는 진행하는
                                        <br>프로그램입니다. 꼼꼼한 관리와 케어로
                                        <br>보답하겠습니다.</p>
                                        <button type="submit" class="btn3" onclick="location.href='program.html'" style="transform:translate(-83%,30%);">+ 자세히 보기</button>
                                    </div>
                                    <img src="image/grouppt.jpg">
                                    <label for="slide03" class="right"></label>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <label for="slide02" class="left"></label>
                                    <div class="textbox">
                                        <h3>Pilates</h3>
                                        <p>필라테스 강사와 함께 체계적이고 수
                                        <br>준높은 프로그램으로 구성되어있습니다.
                                        <br>몸이 건강해야 마음도 건강해집니다.</p>
                                        <button type="submit" class="btn3" onclick="location.href='program.html'" style="transform:translate(-83%,30%);" >+ 자세히 보기</button>
                                    </div>
                                    <img src="image/pilates.jpg">
                                    <label for="slide01" class="right"></label>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class = "map">
                    <div id="cont">About</div>
                    <button type="submit" class="btn2" onclick="location.href='about.html'">+ 자세히 보기</button>
                </div>
            </div>
        </div>

        <script>
            let mainText3 = document.querySelector(".content_main");
            window.addEventListener('scroll',function() {
                let value3 = window.scrollY;
                console.log("scrollY", value3);

                if(value3>1000 && value3 < 1945) {
                    mainText3.style.animation='fadeIn 3s';
                } else {
                    mainText3.style.animation='fadeOut 1s';
                }
            });
        </script>
        </article>
        <!-- content end-->

        <!-- content2 start-->
        <article>
        <div class="trainer">
            <div class="text">
                <h3>OUR TRAINER</h3>
            </div>
            <div class="grid-container">
                <div class="grid-items">
                    <img src="images_trainer/trainer1_이용승.jpeg">
                    <a href="#dialog1" style="color: rgb(149, 121, 42); text-decoration: none;"><h2 class="name" data-toggle="modal" data-target="#dialog">Lee Young Seung</a></h2>
                </div>
                <div class="grid-items">
                    <img src="images_trainer/trainer2_최은총.jpeg">
                    <a href="#dialog2" style="color: rgb(149, 121, 42); text-decoration: none;"><h2 class="name" data-toggle="modal" data-target="#dialog2">Choe Eun Chong</a></h2>
                </div>
                <div class="grid-items">
                    <img src="images_trainer/trainer3_최봉석.png">
                    <a href="#dialog3" style="color: rgb(149, 121, 42); text-decoration: none;"><h2 class="name" data-toggle="modal" data-target="#dialog3">Choe Bong Seok</a></h2>
                </div>
            </div>
        </div>
        <script>
            let mainText4 = document.querySelector(".grid-container");
            window.addEventListener('scroll',function() {
                let value4 = window.scrollY;
                console.log("scrollY", value4);

                if(value4>1750 && value4 < 2650) {
                    mainText4.style.animation='fadeIn 3s';
                } else {
                    mainText4.style.animation='fadeOut 1s';
                }
            });
        </script>
        <!-- Lee Young Seung Modal -->
        <div id="dialog" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3>프로필</h3>
                    </div>
                    <div class="modal-body">
                        <p>
                        이름 : 이용승<br>
                        출생 : 1994년 02월 14일<br>
                        신체 : 173cm, 73kg
                        </p>
                        <h3 style="color: rgb(149, 121, 42);">수상 경력</h3>
                        <p>
                        2019아시아인최초 ICN 미스터유니버스 보디빌딩챔피언<br>
                        2019ICN 이태리 미스터유니버스 보디빌딩 그랑프리 / 두체급 1위, 1위<br>
                        2019ICN 바디빌딩 오버롤<br>
                        2019ICN 바디빌딩1위 / 클래식피지크 1위<br>
                        2019WNC 바디빌딩 오버롤<br>
                        2019WNC 바디빌딩 1위 / 클래식피지크 1위<br>
                        2020 나바코리아 AOC 보디빌딩 체급 1위<br>
                        2021 WNBF Korea -80kg 1위, 그랑프리
                        <br>
                        2021AGP 아시아그랑프리 본선 클래식피지크 4위<br>
                        2021NPC 리저널 인천 클래식피지크 2위<br>
                        2021 NPC 내추럴 경남 클래식피지크 1위<br>
                        2021 NPC Natural Pro Qualifier 클래식 피지크 1위
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </article>
        <!-- Kim Eun Chong Modal -->
        <div id="dialog2" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>프로필</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>
                            이름 : 최은총<br>
                            출생 : 1985년 02월 14일<br>
                            신체 : 178cm, 75kg
                            </p>
                            <h3 style="color: rgb(149, 121, 42);">수상 경력</h3>
                            <p>
                            2018미스터춘천 1등<br>
                            2018WNBF KOREA 내츄럴 피지크 체급 1위 그랑프리 3위
                            </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

        <!-- Chae Bong Suck Modal -->
        <div id="dialog3" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3>프로필</h3>
                    </div>
                    <div class="modal-body">
                        <p>
                        이름 : 최봉석<br>
                        출생 : 1985년 05월 15일<br>
                        신체 : 185cm, 95kg
                        </p>
                        <h3 style="color: rgb(149, 121, 42);">수상 경력</h3>
                        <p>
                        2022 AGP 프로 맨즈피지크 부문 우승 (2022 미스터 올림피아 진출권 획득)<br>
                        2022 아놀드 클래식 맨즈피지크 부문 5위<br>
                        2021 AGP 프로 맨즈피지크 부문 우승 (2021 미스터 올림피아 진출권 획득)<br>
                        2019 IFBB 재팬 프로 맨즈피지크 부문 우승 (2020 미스터 올림피아 진출권 획득)<br>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- content2 end-->
        <script>
            $(function () {
              $('.nav li a').on('click', function (e) {
                console.log(this.hash);
                if (this.hash !== '') {
                  e.preventDefault();
                  const hash = this.hash;

                  $('html, body').animate({
                    scrollTop: $(hash).offset().top },
                  800);
                }
              });
            });
        </script>
        <script>$(window).fadeThis();</script>

        <!-- contact start -->
        <div class="contact" id="link_main_text3">
            <div class="contact_container">
                <div class="contact_items1">
                    <div class="icon">
                        <hr class="hr_1">
                        <span class="material-icons">location_on</span>
                        <hr class="hr_2">
                    </div>
                    <div class="text_container">
                        <a href="about.html" style="text-decoration:none;"><div>Directions<br>오시는길&nbsp&nbsp&nbsp</div></a>
                    </div>
                </div>
                <div class="contact_items2">
                    <div class="bg_img"></div>
                    <div class="contact_container2">
                        <div class="contact_text">
                            <div id="p1">몬스터짐</div>
                            <div id="p2">재오픈이벤트!</div>
                            <br>
                            <div id="p3">회원권 30% 할인!</div>
                            <button type="submit" class="contact_btn" onclick="location.href='notice.html'">+</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let mainText5 = document.querySelector(".contact_container");
            window.addEventListener('scroll',function() {
                let value5 = window.scrollY;
                console.log("scrollY", value5);

                if(value5>2500 && value5 < 3700) {
                    mainText5.style.animation='fadeIn 2s';
                } else {
                    mainText5.style.animation='fadeOut 1s';
                }
            });
        </script>
        <!-- contact end -->

        <!-- footer start -->
        <footer>
            <div>
                <div>LOGO</div>
                <img src="image/homeicon.png" style="width:50px; height:50px;">
            </div>
            <div>
                CEO. 몬스터짐
                <br>Addr. 경기도 포천시 선단동 호국로 1007 KR 대진대학교
                <br>Fax/Tel. 031 - 539 - 1114
                <p>&copy;Copyright 2022. Sun. All rights reserved.</p>
            </div>
        </footer>
        <!-- footer end -->
    </body>
</html>