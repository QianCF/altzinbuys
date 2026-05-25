<?php
include("function.php");
html_start("首页");
?>
您好，<?=isset($_COOKIE["user"])?$_COOKIE["user"]:"未登陆"?>，您有<?=isset($_COOKIE["user"])?json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true)["meows"]:" 未登陆 "?>个喵币，<a href="user.php">登陆/注册/修改密码/退出登录/修改主页留言</a>或<a href="userinfo.php">查看我的主页</a>或<a href="userlist.php">查看用户列表</a><br/>
<?php
if(isset($_COOKIE["user"])){
  echo "您有买东西的价格倍率:".json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true)["buymu"]."，花费喵币达200升级为0.95，达400升级为0.9，14天不花费降级为1<br/>";
}
    ?>
<script>

  window.countaa=0;
  function counta(){
    window.countaa = window.countaa+1
    if(window.countaa == 5){
    location.href="data/views.txt";
  }
  }
</script>

<span>AltzinWeb卖场</span><br/>
<?php
$c=array("喵","miao","meao","喵~","miao~","meao~","咪","咪傲","喵呜");
$colors=array("red","#ff9900","GoldenRod","green","aqua","blue","purple");
$m=rand(0,count($c)-1);
shuffle($colors);
$color=$colors[0];
echo "<span style='color:{$color}' onclick='counta()'>".$c[$m]."</span>";
?><br/>
<a href="password.php">喵币控制台登陆</a><br/>
<a href="info.php">关于php</a><br/>
<a href="text.php">留言板/单聊</a><br/>
<a href="buys.php">购物</a><br/>
<a href="meowscon.php">使用兑换码兑换喵币</a><br/>
<a href="admin.php">管理员管理器(请先登录,非管理勿扰)</a><br/>
<a href="https://altzin.61diy.cn">AltzinWeb原站</a><br/>
<?php
echo "网站新闻:<br/>";
file_echo("data/news.txt");
html_end();
?>