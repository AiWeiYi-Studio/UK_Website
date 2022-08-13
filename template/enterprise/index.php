<?php
$count1=$DB->count("SELECT count(*) from ukyun_user WHERE 1");
$count2=$DB->count("SELECT count(*) from ukyun_daili WHERE 1");
$count3=$DB->count("SELECT count(*) from ukyun_log WHERE 1");
$count4=$DB->count("SELECT count(*) from ukyun_config WHERE 1");
$count5=$DB->count("SELECT count(*) from ukyun_list WHERE 1");
$count6=$DB->count("SELECT count(*) from ukyun_liar WHERE 1");
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=yes">
    <title><?php echo $conf['title']?></title>
    <link rel="icon" href="assets/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['keywords']?>"/>
    <meta name="description" content="<?php echo $conf['description']?>"/>
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/base.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/responsive.css">
    <script src="<?php echo $conf['apiurl']?>/index/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo $conf['apiurl']?>/index/js/wow.min_1.js"></script>
    <script src="<?php echo $conf['apiurl']?>/index/js/owl.carousel.min.js"></script>
    <script src="<?php echo $conf['apiurl']?>/index/js/page.js"></script>
</head>
<body>
<div class="header">
    <div class="rowFluid">
        <div class="span2 col-md-12">
            <div class="logo"><a href="<?php echo $conf['weburl']?>" title="首页"> <img style="width:200px;" src="./assets/img/logo.png"> </a>
            </div>
        </div>
        <div class="span8">
            <div class="mobileMenuBtn"><span class="span1"></span><span class="span2"></span><span class="span3"></span>
            </div>
            <div class="mobileMenuBtn_shad"></div>
            <div class="header_menu">
                <ul id="menu">
                    <li><a href="/" class='active' title="首页">首页</a></li>
                    
                    <li><a href="/beg" title="站长后台">赞助系统</a></li>
                    
                    <li><a href="/user/page.php" title="站长后台">网址大全</a></li>

                    <li><a href="user/liar.php" title="骗子大全">骗子大全</a></li>

                    <li><a href="/shop.php" title="商城系统">商城系统</a></li>

                    <li><a href="user/login.php" title="用户登录">用户登录</a></li>

                    <li><a href="user/reg.php" title="用户注册">用户注册</a></li>
                </ul>
            </div>
        </div>
        <div class="span2"></div>
    </div>
</div>
<div class="page">
    <div class="rowFluid">
        <div class="span12">
            <div class="main">
                <div class="banner">
                    <div class="rowFluid">
                        <div class="span12">
                            <div class="owl-demo">
                                <div class="item">
                                    <h3 class="banner_title"><?php echo $conf['title']?></h3>
                                    <div class="banner_text">我们的综合服务站提供了<?php echo $conf['title']?>旗下程序的控制</div>

                                </div>
                                <div class="item">
                                    <h3 class="banner_title">全自助化管理产品</h3>
                                    <div class="banner_text">你订购的产品可在该页面进行管理</div>
                                </div>
                                <div class="item">
                                    <h3 class="banner_title">强大的云端API</h3>
                                    <div class="banner_text">我们的简单直观的管理平台允许您管理和扩展现有的产品，不需要额外的技术支持自己就可以轻松完成复杂的操作。</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="container" class="mpage">
                        <div id="anitOut" class="anitOut"></div>
                    </div>
                </div>
                <div class="index_product">
                    <div class="rowFluid">
                        <div class="span12">
                            <div class="container">
                                <div class="all_title1 wow fadeInDown">
                                    <h3 class="title">我们的优势</h3>
                                    <div class="text">简单易上手的控制面板</div>
                                </div>
                                <div class="rowFluid">
                                    <div class="index_product_content">
                                        <div class="span4 col-md-6 col-xs-12 wow fadeInDown"><a
                                                    class="index_product_list" title="网站管理">
                                                <div class="list_backimg list_backimg1">
                                                    <div class="list_img"><img src="<?php echo $conf['apiurl']?>/index/picture/045.png"
                                                                               alt="网站管理"></div>
                                                    <div class="list_txt">
                                                        <div class="list_title">网站管理</div>
                                                        <div class="list_text">在这里可以管理您在UK云工作室购买的产品</div>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="span4 col-md-6 col-xs-12 wow flipInX"><a class="index_product_list"
                                                                                             title="产品售后">
                                                <div class="list_backimg list_backimg2">
                                                    <div class="list_img"><img src="<?php echo $conf['apiurl']?>/index/picture/046.png"
                                                                               alt="产品售后"></div>
                                                    <div class="list_txt">
                                                        <div class="list_title">产品售后</div>
                                                        <div class="list_text">我们提供最全面的技术支持,保证产品正常使用.</div>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="span4 col-md-6 col-xs-12 wow fadeInRight"><a
                                                    class="index_product_list" title="高可用性">
                                                <div class="list_backimg list_backimg3">
                                                    <div class="list_img"><img src="<?php echo $conf['apiurl']?>/index/picture/047.png"
                                                                               alt="高可用性"></div>
                                                    <div class="list_txt">
                                                        <div class="list_title">高可用性</div>
                                                        <div class="list_text">我们的云平台拥有可靠的服务器，云端API</div>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="span4 col-md-6 col-xs-12 wow fadeInDown"><a
                                                    class="index_product_list" title="快速响应">
                                                <div class="list_backimg list_backimg4">
                                                    <div class="list_img"><img src="<?php echo $conf['apiurl']?>/index/picture/048.png"
                                                                               alt="快速响应"></div>
                                                    <div class="list_txt">
                                                        <div class="list_title">快速响应</div>
                                                        <div class="list_text">每天12小时为您倾心服务,提供最好的售后服务</div>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="span4 col-md-6 col-xs-12 wow flipInX"><a class="index_product_list"
                                                                                             title="APP">
                                                <div class="list_backimg list_backimg5">
                                                    <div class="list_img"><img src="<?php echo $conf['apiurl']?>/index/picture/049.png"
                                                                               alt="APP"></div>
                                                    <div class="list_txt">
                                                        <div class="list_title">手机客户端</div>
                                                        <div class="list_text">我们拥有自己的手机端APP，方便简洁</div>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="span4 col-md-6 col-xs-12 wow fadeInRight"><a
                                                    class="index_product_list" title="网络资源">
                                                <div class="list_backimg list_backimg6">
                                                    <div class="list_img"><img src="<?php echo $conf['apiurl']?>/index/picture/050.png"
                                                                               alt="网络资源"></div>
                                                    <div class="list_txt">
                                                        <div class="list_title">人才资源</div>
                                                        <div class="list_text">我们的工作室拥有自己的技术人员</div>
                                                    </div>
                                                </div>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="platform_advantage">
                    <div class="rowFluid">
                        <div class="span12">
                            <div class="container">
                                <div class="all_title2 wow fadeInUp">
                                    <h3 class="title"><?php echo $conf['title']?>优势</h3>
                                    <div class="text">独家自开发程序</div>
                                </div>
                                <div class="rowFluid">
                                    <div class="platform_advantage_content">
                                        <div class="span4 col-xm-6 col-xs-12 wow bounceInLeft">
                                            <div class="platform_advantage_list">
                                                <div class="platform_advantage_img"><img
                                                            src="<?php echo $conf['apiurl']?>/index/picture/008.png" alt="开发程序"></div>
                                                <div class="platform_advantage_brief">
                                                    <div class="brief_title">技术人员开发程序</div>
                                                    <div class="brief_text">故障率极低<br>安全有保障</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4 col-xm-6 col-xs-12 wow bounceIn">
                                            <div class="platform_advantage_list">
                                                <div class="platform_advantage_img"><img
                                                            src="<?php echo $conf['apiurl']?>/index/picture/009.png" alt="技术人员"></div>
                                                <div class="platform_advantage_brief">
                                                    <div class="brief_title">技术人员</div>
                                                    <div class="brief_text">非普通玩家开发的程序<br>
                                                        安全可靠
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4 col-xm-6 col-xs-12 wow bounceInRight">
                                            <div class="platform_advantage_list">
                                                <div class="platform_advantage_img"><img
                                                            src="<?php echo $conf['apiurl']?>/index/picture/010.png" alt="云端API"></div>
                                                <div class="platform_advantage_brief">
                                                    <div class="brief_title">云端API</div>
                                                    <div class="brief_text"><?php echo $conf['title']?>独家云端API<br>
                                                        更简单直观的管理您的产品
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4 col-xm-6 col-xs-12 wow bounceInLeft">
                                            <div class="platform_advantage_list">
                                                <div class="platform_advantage_img"><img
                                                            src="<?php echo $conf['apiurl']?>/index/picture/011.png" alt="24小时监控"></div>
                                                <div class="platform_advantage_brief">
                                                    <div class="brief_title">24小时监控</div>
                                                    <div class="brief_text"> 升级更新数据保留，企业数据沉淀<br>
                                                        实现数据分析。
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4 col-xm-6 col-xs-12 wow bounceIn">
                                            <div class="platform_advantage_list">
                                                <div class="platform_advantage_img"><img
                                                            src="<?php echo $conf['apiurl']?>/index/picture/012.png" alt="高端设计"></div>
                                                <div class="platform_advantage_brief">
                                                    <div class="brief_title">高端设计</div>
                                                    <div class="brief_text"> 主流设计风格，极致交互体验，<br>
                                                        用户体验更佳
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4 col-xm-6 col-xs-12 wow bounceInRight">
                                            <div class="platform_advantage_list">
                                                <div class="platform_advantage_img"><img
                                                            src="<?php echo $conf['apiurl']?>/index/picture/013.png" alt="H5响应式网站建设"></div>
                                                <div class="platform_advantage_brief">
                                                    <div class="brief_title">安全稳定</div>
                                                    <div class="brief_text">我们24小时更新维护<br>
                                                        保证程序无任何漏洞
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rowFluid">
                                <div class="waves_box">
                                    <canvas id="waves" class="waves"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="join_in">
                    <div class="rowFluid">
                        <div class="span12">
                            <div class="container">
                                <div class="join_in_title wow fadeInUp">选择<?php echo $conf['title']?>，<span>让你的企业快速迈向互联网+时代</span>
                                </div>
                                <div class="join_in_text wow fadeInLeft">选择对的服务商能让您更快更好的迈进互联网+时代</div>
                                <a href="<?php echo $conf['lxkfurl']?>"
                                class="all_button join_in_button wow fadeInUp">点击咨询</a></div>
                        </div>
                    </div>
                </div>
                <script src="<?php echo $conf['apiurl']?>/index/js/effects.js"></script>
                <div class="footer wow fadeInUp">
                    <div class="rowFluid">
                        <div class="span12">
                            <div class="container">
                                <div class="footer_content">
                                    <div class="span4 col-xm-12">
                                        <div class="footer_list">
                                            <div class="span6 col-xm-12">
                                                <div class="quick_navigation">
                                                    <div class="quick_navigation_title">网站统计</div>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4 col-xm-6 col-xs-12">
                                        <div class="footer_list">
                                            <div class="footer_link">
                                                <div class="footer_link_title">友情链接</div>
                                                <ul id="frientLinks">
                                                    <li><a href='<?php echo $conf["url1"]?>'><?php echo $conf["urlname1"]?></a></li>
                                                    <li><a href='<?php echo $conf["url2"]?>'><?php echo $conf["urlname2"]?></a></li>
                                                    <li><a href='<?php echo $conf["url3"]?>'><?php echo $conf["urlname3"]?></a></li>
                                                    <li><a href='<?php echo $conf["url4"]?>'><?php echo $conf["urlname4"]?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
<div class="span4 col-xm-6 col-xs-12">
    <div class="footer_list">
        <div class="footer_cotact">
            <div class="footer_cotact_title">联系方式</div>
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
                <a href="http://icp.chinaz.com/<?php echo $conf['beian']?>"><?php echo $conf['beian']?></a></span></li>
        </li>
    </ul>
</div>
    </div>
        </div>
            </div>
                </div>
                    <div class="copyright">Copyright&copy; 2019 <a href="<?php echo $conf["weburl"]?>"><?php echo $conf["banquan"]?></a>版权所有 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--百度商桥客服代码-->
<?php echo $conf["kefu"]?>

<!--背景音乐代码-->
<audio src="<?php echo $conf["music1"]?>" autoplay loop></audio>
</div>
</body>
</html>