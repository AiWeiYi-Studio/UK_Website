<?php
$count1=$DB->count("SELECT count(*) from ukyun_user WHERE 1");
$count2=$DB->count("SELECT count(*) from ukyun_daili WHERE 1");
$count3=$DB->count("SELECT count(*) from ukyun_log WHERE 1");
$count4=$DB->count("SELECT count(*) from ukyun_config WHERE 1");
$count5=$DB->count("SELECT count(*) from ukyun_list WHERE 1");
$count6=$DB->count("SELECT count(*) from ukyun_liar WHERE 1");
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from www.god-team.cn/ by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 11 Aug 2018 10:24:20 GMT -->
<head>
  <meta charset="utf-8">
  <title><?php echo $conf['title']?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="keywords" content="<?php echo $conf['keywords']?>"/>
  <meta name="description" content="<?php echo $conf['description']?>"/>
  <meta name="author" content="UK云工作室" />
  <link rel="icon" href="assets/favicon.ico" type="image/ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/animate.min.css" rel="stylesheet">
  <link href="<?php echo $conf['apiurl']?>/studio/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $conf['apiurl']?>/studio/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href="<?php echo $conf['apiurl']?>/studio/css/style.css" rel="stylesheet">
</head>
<body>
  <header id="header">
    <div class="container-fluid">
<div id="logo" class="pull-left">
        <h4 style="color:white"><?php echo $conf['title']?></h4>
      </div>

            <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#services">服务</a></li>
          <li><a href="#team">成员</a></li>
          <li><a href="#contact">联系我们</a></li>
          <li><a href="beg">赞助系统</a></li>
          <li><a href="user/liar.php">骗子大全</a></li>
          <li><a href="user/page.php">网址大全</a></li>
          <li><a href="user/login.php">用户登录</a></li>
          <li><a href="user/reg.php">用户注册</a></li>
          <li><a href="./shop.php">商城系统</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" style="background-image: url('http://www.god-team.cn/api/acgurl/acgurl.php');">
            <div class="carousel-container">
              <div class="carousel-content">
              <h2><?php echo $conf['title']?></h2>
              <p><?php echo $conf['title']?>，主营网站原创开发。秉持简洁、高效、人性化的原则，目前已为数家中小型网站提供各种在线服务。让您用最低廉的价格体会最优质的程序，欢迎您定制业务。</p>
                <a href=".$conf['kefu']" class="btn-get-started scrollto">联系我们</a>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </section>
  <main id="main">
    <section id="services">
      <div class="container">
        <header class="section-header wow fadeInUp">
          <h3>Services</h3>
          <p>不忘初心，方得始终.</p>
        </header>
        <div class="row">
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title"><a href="#">PHP程序开发</a></h4>
            <p class="description">丰富的经验，强硬的实力胜过一切广告</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="#">PHP程序二开</a></h4>
            <p class="description">您想个性化定制别人的程序？没问题。二次开发让您顺心顺手</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="#">PHP程序破解</a></h4>
            <p class="description">世界上是没有破解不了的PHP加密，如果有，那就是骗你的</p>
          </div>
        </div>
      </div>
    </section>
    <section id="facts"  class="wow fadeIn">
      <div class="container">

        <header class="section-header">
          <h3>旗下网站</h3>
        </header>
        <div class="row counters">
  				<div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1</span>
            <p>代挂网</p>
  				</div>
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1</span>
            <p>代刷网</p>
  				</div>
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1</span>
            <p>易支付</p>
  				</div>
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1</span>
            <p>云互联</p>
  		  </div>
  		</div>
      </div>
    </section>
 <section id="team">
      <div class="container">
        <div class="section-header wow fadeInUp">
          <h3>Team</h3>
		  <p>年龄小但不代表我们实力差，沉默是金.</p>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="http://q1.qlogo.cn/g?b=qq&amp;nk=2874992246&amp;s=100" class="img-fluid" alt="">
			  <center><h3 class="member-name">陆少</h3></center>
			  <center><font>现开发人员<br />对PHP有独特的看法</font></center>
              <div class="member-info">
                <div class="member-info-content">
                  <h4>QQ:2874992246</h4>
                  <span>Email：2874992246@qq.com</span>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
	  </div>
    </section>
  </main>
 <section id="contact">
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>关于我们</h4>
            <p><?php echo $conf['title']?>-是一个个由几名热爱网络的中学生联合起来的一个小团队，我们一直在前进，一直在进步。不管如何，我们的初心不变</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>友情链接</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i><a href="<?php echo $conf["url1"]?>"><?php echo $conf["urlname1"]?></a></li>
              <li><i class="ion-ios-arrow-right"></i><a href="<?php echo $conf['url2']?>"><?php echo $conf['urlname2']?></a></li>
              <li><i class="ion-ios-arrow-right"></i><a href="<?php echo $conf['url3']?>"><?php echo $conf['urlname3']?></a></li>
              <li><i class="ion-ios-arrow-right"></i><a href="<?php echo $conf['url4']?>"><?php echo $conf['urlname4']?></a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>数据统计</h4>
            <ul>
            <li>站长数量：<?php echo $count1 ?></li>
            <li>用户数量：<?php echo $count2 ?></li>
            <li>网站日志：<?php echo $count3 ?></li>
            <li>网站配置：<?php echo $count4 ?></li>
            <li>网址数量：<?php echo $count5 ?></li>
            <li>骗子数量：<?php echo $count6 ?></li>
            <li>网站总数据：<?php echo $count1+$count2+$count3+$count4+$count5+$count6 ?></li>
            <?php echo $conf["tongji"]?>
            </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
            <h4>联系方式</h4>
             <ul>
                <li><span class="footer_cotact_type">QQ：</span>
                <span class="footer_cotact_content">
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']?>&site=qq&menu=yes"><?php echo $conf['qq']?></a></span></li>
                <li><span class="footer_cotact_type">QQ群：</span>
                <span class="footer_cotact_content">
                <a href="<?php echo $conf['qqqunurl']?>"><?php echo $conf['qqqun']?></a></span></li>
                <li><span class="footer_cotact_type">邮箱：</span>
                <spanclass="footer_cotact_content">
                <a href="mailto:<?php echo $conf['mail']?>"><?php echo $conf['mail']?></a></span></li>
                <li><span class="footer_cotact_type">电话：</span>
                <span class="footer_cotact_content">
                <a href="tel:<?php echo $conf['dianhua']?>"><?php echo $conf['dianhua']?></a></span></li>
                <li><span class="footer_cotact_type">备案：</span>
                <span class="footer_cotact_content">
                <a href="http://icp.chinaz.com/<?php echo $conf["weburl"]?>"><?php echo $conf['beian']?></a></span></li>
        </li>
    </ul>
    </div>
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><?php echo $conf['banquan']?></strong>
  </footer>
  </section>
<!--百度商桥客服代码-->
<?php echo $conf["kefu"]?>

<!--背景音乐代码-->
<audio src="<?php echo $conf["music1"]?>" autoplay loop></audio>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/easing/easing.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/superfish/superfish.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/wow/wow.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/lightbox/js/lightbox.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/contactform/contactform.js"></script>
  <script src="<?php echo $conf['apiurl']?>/studio/js/main.js"></script>
</body>
</html>
