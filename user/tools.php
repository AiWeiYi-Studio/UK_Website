<?php
/**
 * UK云工作室官网程序站长后台工具大全
**/
include("../includes/common.php");
$title='工具大全';
if($islogins==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
$url=isset($_GET['url'])?$_GET["url"]:all;
echo '<div class="container" style="padding-top:90px;">
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<?php
if($url=="all"){
?>
<link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/style.css">
<div class="block">
<div class="block-title"><h3 class="panel-title">工具列表</h3></div>
<div class="panel-body">
                        <p class="text-muted font-14">此界面的多个功能按钮可以更好的协助您使用本程序！</p>
                       <a href="./tools.php?url=dyjx"class="all_button join_in_button wow fadeInUp">电影解析</a>
<a href="./tools.php?url=yyss"class="all_button join_in_button wow fadeInUp">音乐搜索</a>
<a href="./tools.php?url=jsq"class="all_button join_in_button wow fadeInUp">计算器</a>
</div>
<?php
}if($url=="jsq"){
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">计算器小工具</h3></div>
<div class="panel-body">
	<link href="//api.ukyun.cn/website/jsq/css/jisuanqi.css" rel="stylesheet" type="text/css">
    <script src="//api.ukyun.cn/website/jsq/js/calc.js"></script>
	<div class="qiehuankuang_1" id="btns">
	<input type="button" value="普通计算器" class="qiehuankuang_1_dq" />
	<input type="button" value="高级计算器" />
	</div>
<div id="jisuan">
  <div class="calculator_main" id="calculator">
    <div class="calculator_con  current">
      <div id="calculator_base" style="display: block"></div>
      <div class="calculator_hd">
        <input type="text" id="resultIpt" readonly class="resultIpt" value="0" size="17" maxlength="17"></div>
      <div id="baseEprsPanel" valign="middle" width="290" style="display:none"></div>
      <div class="calculator_bd" id="calculator_bd">
        <ul class="calculator_table">
          <li>
            <a class="cal_btn" href="javascript:;" onclick="calculator.memory(this,0);">存储</a>
            <a class="cal_btn" href="javascript:;" onclick="calculator.memory(this,1);">取存</a>
            <a class="cal_btn cla_btn_org" href="javascript:;" id="simpleDel" onclick="calculator.remove();">退格</a>
            <a class="cal_btn cla_btn_org" href="javascript:;" id="simpleClearAllBtn" onclick="calculator.clearAll();">清屏</a></li>
          <li>
            <a class="cal_btn" href="javascript:;" onclick="calculator.memory(this,-1);">累存</a></td>
            <a class="cal_btn" href="javascript:;" onclick="calculator.memory(this,-2);">积存</a></td>
            <a class="cal_btn" href="javascript:;" onclick="calculator.memory(this,2);">清存</a></td>
            <a class="cal_btn cal_btn_gray fontArial" id="simpleDivi" href="javascript:;" onclick="calculator.input(this,3);">÷</a></li>
          <li>
            <a class="cal_btn fontArial" id="simple7" href="javascript:;" onclick="calculator.input(this,-1);">7</a>
            <a class="cal_btn fontArial" id="simple8" href="javascript:;" onclick="calculator.input(this,-1);">8</a>
            <a class="cal_btn fontArial" id="simple9" href="javascript:;" onclick="calculator.input(this,-1);">9</a>
            <a class="cal_btn cal_btn_gray fontArial" id="simpleMulti" href="javascript:;" onclick="calculator.input(this,2);">x</a></li>
          <li>
            <a class="cal_btn fontArial" href="javascript:;" id="simple4" onclick="calculator.input(this,-1);">4</a>
            <a class="cal_btn fontArial" href="javascript:;" id="simple5" onclick="calculator.input(this,-1);">5</a>
            <a class="cal_btn fontArial" href="javascript:;" id="simple6" onclick="calculator.input(this,-1);">6</a>
            <a class="cal_btn cal_btn_gray fontArial" href="javascript:;" id="simpleSubtr" onclick="calculator.input(this,1);">-</a></li>
          <li>
            <a class="cal_btn fontArial" href="javascript:;" id="simple1" onclick="calculator.input(this,-1);">1</a>
            <a class="cal_btn fontArial" href="javascript:;" id="simple2" onclick="calculator.input(this,-1);">2</a>
            <a class="cal_btn fontArial" href="javascript:;" id="simple3" onclick="calculator.input(this,-1);">3</a>
            <a class="cal_btn cal_btn_gray fontArial" href="javascript:;" id="simpleAdd" onclick="calculator.input(this,0);">+</a></li>
          <li>
            <a class="cal_btn fontArial" href="javascript:;" id="simple0" onclick="calculator.input(this,-1);">0</a>
            <a class="cal_btn fontArial" href="javascript:;" id="simpleDot" onclick="calculator.input(this,-1);">.</a>
            <a class="cal_btn fontArial" href="javascript:;" onclick="calculator.input(this,-3);">+/-</a>
            <a class="cal_btn cal_btn_bla fontArial" id="simpleEqual" href="javascript:;" onclick="calculator.input(this,-2);">=</a></li>
        </ul>
      </div>
    </div>
    <div class="calculator_con">
      <div class="calculator_hd">
        <input type="text" class="resultIpt" id="gaoji" name="gaoji" value="0">
        <div id="completeEprsPanel" valign="middle" width="290" style="display:none"></div>
      </div>
      <div class="calculator_bd">
        <ul class="complete_table_rdo">
          <li>
            <div class="labinp">
              <input type="radio" name="carry" onclick="inputChangCarry(16);" id="hex">
              <label for="hex">十六进制</label></div>
            <div class="labinp">
              <input type="radio" name="carry" onclick="inputChangCarry(10);" id="decimal" checked="checked" display="block">
              <label for="decimal">十进制</label></div>
            <div class="labinp">
              <input type="radio" name="carry" onclick="inputChangCarry(8);" id="octal">
              <label for="octal">八进制</label></div>
            <div class="labinp">
              <input type="radio" name="carry" onclick="inputChangCarry(2);" id="binary">
              <label for="binary">二进制</label></div>
            <div class="labinp"></div>
            <div class="labinp">
              <input type="radio" name="angle" onclick="inputChangAngle('d');">
              <label for="angle">角度制</label></div>
            <div class="labinp">
              <input type="radio" name="angle" onclick="inputChangAngle('r');">
              <label for="angle">弧度制</label></div>
          </li>
          <li>
            <div class="labinp">
              <input type="checkbox" id="upperFile" onclick="inputshift();">
              <label for="upperFile">上档功能</label></div>
            <div class="labinp">
              <input type="checkbox" id="hyperbolic" onclick="inputshift();">
              <label for="hyperbolic">双曲函数</label></div>
            <div class="ipts">
              <input type="text" name="bracket" id="bracket" readonly size="3" class="chk_text_inp">
              <input type="text" name="memory" id="memory" readonly size="3" class="chk_text_inp">
              <input type="text" name="operator" id="operator" readonly size="3" class="chk_text_inp"></div>
            <a class="cal_btn cal_btn_gre" href="javascript:;" id="completeDel" onclick="backspace();">退格</a>
            <a class="cal_btn cla_btn_org" href="javascript:;" onclick="document.getElementById('gaoji').value=0;document.getElementById('completeEprsPanel').innerHTML = '';this.blur();">清屏</a></li>
        </ul>
        <ul class="complete_table_main">
          <li>
            <a class="cal_btn" href="javascript:;" onclick="putmemory();">存储</a>
            <a class="cal_btn" href="javascript:;" onclick="getmemory();">取存</a>
            <a class="cal_btn" href="javascript:;" onclick="addmemory();">累存</a>
            <a class="cal_btn" href="javascript:;" onclick="multimemory();">积存</a>
            <a class="cal_btn" href="javascript:;" onclick="clearmemory();">清存</a>
            <a class="cal_btn cla_btn_org" href="javascript:;" onclick="clearall();">全清</a></li>
          <li>
            <a class="cal_btn fontArial" id="complete7" href="javascript:;" onclick="inputkey('7');">7</a>
            <a class="cal_btn fontArial" id="complete8" href="javascript:;" onclick="inputkey('8');">8</a>
            <a class="cal_btn fontArial" id="complete9" href="javascript:;" onclick="inputkey('9');">9</a>
            <a class="cal_btn cal_btn_gray fontArial" id="completeDivi" href="javascript:;" onclick="operation('/',6);;">÷</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="operation('%',6);">取余</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="operation('&amp;',3);">与</a></li>
          <li>
            <a class="cal_btn fontArial" id="complete4" href="javascript:;" onclick="inputkey('4');">4</a>
            <a class="cal_btn fontArial" id="complete5" href="javascript:;" onclick="inputkey('5');">5</a>
            <a class="cal_btn fontArial" id="complete6" href="javascript:;" onclick="inputkey('6');">6</a>
            <a class="cal_btn cal_btn_gray fontArial" id="completeMulti" href="javascript:;" onclick="operation('*',6);">x</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" id="changeDecimal" onclick="inputfunction('floor','deci');">取整</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="operation('|',1);">或</a></li>
          <li>
            <a class="cal_btn fontArial" id="complete1" href="javascript:;" onclick="inputkey('1');">1</a>
            <a class="cal_btn fontArial" id="complete2" href="javascript:;" onclick="inputkey('2');">2</a>
            <a class="cal_btn fontArial" id="complete3" href="javascript:;" onclick="inputkey('3');">3</a>
            <a class="cal_btn cal_btn_gray fontArial" id="completeSubtr" href="javascript:;" onclick="operation('-',5);">-</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="operation('&lt;',4);">左移</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="inputfunction('~','~');">非</a></li>
          <li>
            <a class="cal_btn fontArial" id="complete0" href="javascript:;" onclick="inputkey('0');">0</a>
            <a class="cal_btn fontArial" href="javascript:;" onclick="changeSign();">+/-</a>
            <a class="cal_btn fontArial" id="completeDot" href="javascript:;" id="dian" onclick="inputkey('.');">.</a>
            <a class="cal_btn cal_btn_gray fontArial" id="completeAdd" href="javascript:;" onclick="operation('+',5);">+</a>
            <a class="cal_btn cal_btn_bla fontArial" id="completeEqual" href="javascript:;" onclick="result();">=</a>
            <a class="cal_btn cal_btn_gre " href="javascript:;" onclick="operation('x',2);">异或</a></li>
          <li>
            <a class="cal_btn cal_btn_gre fontArial" href="javascript:;" id="ka" onclick="inputkey('a');">A</a>
            <a class="cal_btn cal_btn_gre fontArial" href="javascript:;" id="kb" onclick="inputkey('b');">B</a>
            <a class="cal_btn cal_btn_gre fontArial" href="javascript:;" id="kc" onclick="inputkey('c');">C</a>
            <a class="cal_btn cal_btn_gre fontArial" href="javascript:;" id="kd" onclick="inputkey('d');">D</a>
            <a class="cal_btn cal_btn_gre fontArial" href="javascript:;" id="ke" onclick="inputkey('e');">E</a>
            <a class="cal_btn cal_btn_gre fontArial" href="javascript:;" id="kf" onclick="inputkey('f');">F</a></li>
        </ul>
        <ul class="complete_more">
          <li>
            <a class="cal_btn cal_btn_dis" href="javascript:;" id="pi" onclick="inputfunction('pi','pi');">PI</a>
            <a class="cal_btn cal_btn_dis" href="javascript:;" id="e" onclick="inputfunction('e','e');">E</a>
            <a class="cal_btn cal_btn_dis" href="javascript:;" id="bt" onclick="inputfunction('dms','deg');">d.ms</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="addbracket(this);">(</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="disbracket(this);">)</a></li>
          <li>
            <a class="cal_btn cal_btn_gre" href="javascript:;" id="ln" onclick="inputfunction('ln','exp');">In</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" id="log" onclick="inputfunction('log','expdec');">log</a>
            <a class="cal_btn cal_btn_dis" href="javascript:;" id="sin" onclick="inputtrig('sin','arcsin','hypsin','ahypsin');">sin</a>
            <a class="cal_btn cal_btn_dis" href="javascript:;" id="cos" onclick="inputtrig('cos','arccos','hypcos','ahypcos');">cos</a>
            <a class="cal_btn cal_btn_dis" href="javascript:;" id="tan" onclick="inputtrig('tan','arctan','hyptan','ahyptan');">tan</a></li>
          <li>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="inputfunction('!','!');">n!</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="inputfunction('recip','recip');">1/x</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" id="sqr" onclick="inputfunction('sqr','sqrt');">x^2</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" id="cube" onclick="inputfunction('cube','cubt');">x^3</a>
            <a class="cal_btn cal_btn_gre" href="javascript:;" onclick="operation('^',7);">x^y</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<script>
jisuanqi_run();
  /*基础高级切换*/

  var oBtns=document.getElementById('btns');
  var aLi=oBtns.getElementsByTagName('input');
  var aLiLength=aLi.length;
  var oCal=document.getElementById('calculator');
  var aDiv=oCal.getElementsByClassName('calculator_con');
	
  for (var i=0;i<aLiLength;i++){
    //aLi[i].index=i;
    (function(idx){
      aLi[idx].onclick = function(){
		document.getElementById('resultIpt').value=0;
		document.getElementById('gaoji').value = 0;		
        for(var j = 0;j<aLiLength;j++){
          aLi[j].className='btnss';
          aDiv[j].className='calculator_con';
        }
        //console.log(idx);
        this.className='qiehuankuang_1_dq';
        aDiv[idx].className='calculator_con current';

      }
    })(i);
  }
</script>

<?php
}if($url=="yyss"){
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">音乐搜索器</h3></div>
<div class="panel-body">
<iframe src="http://wedlaa.com/" style="width:100%;height:600px;"></iframe>
<?php
}if($url=="dyjx"){
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">电影解析</h3></div>
<div class="panel-body">
     <iframe src="https://parse.xymov.net/"id="player"width="100%"height="650px"allowTransparency="true"allowfullscreen="true"frameborder="0"scrolling="no"></iframe>	 


<?php }?>
