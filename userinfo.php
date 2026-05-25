<?php
include("function.php");
html_start("用户主页");
h2("用户主页");
$no_user=0;
if(!isset($_GET["user"])){
  if(isset($_COOKIE["user"])){
    $no_user=1;
    jump("userinfo.php?user=".rawurlencode($_COOKIE["user"]));
  }else{
    echo "你没登陆也没说访问哪个用户，系统不知道你在干啥。<br/>";
    $no_user=1;
  }
}
if($no_user != 1){
  if(!file_exists("user/".$_GET["user"].".json")){
    echo"用户不存在。<br/>";
    $no_user = 1;
  }
}
if($no_user != 1){
  echo "用户".$_GET["user"]."的主页<br/>主页留言:<br/>";
  if(json_decode(file_get_contents("user/".$_GET["user"].".json"), true)["text"] == ""){
    echo "用户没有设置主页留言</div><br/>";
  }else{
    ?>
<div style="margin:0 auto;overflow-clip-margin: content-box !important;border-width: 2px;border-style: inset;border-color: initial;border-image: initial;overflow: clip !important;width:90%; left: 5%;right: 5%;height:65%" >
<?php
    echo str_replace("\n","<br/>",json_decode(file_get_contents("user/".$_GET["user"].".json"), true)["text"]."</div><br/>");
  }
  echo "此人主页链接：https://".$siteweb."/userinfo.php?user=".rawurlencode($_GET["user"])."<br/>";
}
?>
<a href="userlist.php">所有用户列表</a><br/>
<?php
button_back("返回");
html_end();
?>
