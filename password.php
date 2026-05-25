<?php
include("function.php");
if(isset($_POST["password"])){
  if($_POST["password"] == "Alt@L114_zin#514.XY"){
    setrawcookie("admin_password","Alt@L114_zin#514.XY",time()+2*60*60*24,"/");
  }
}
html_start("喵币控制台登录");
if((isset($_COOKIE["admin_password"])?$_COOKIE["admin_password"]:"不是密码") == "Alt@L114_zin#514.XY"){
alert("您已登录,即将跳转");
jump("console.php");

?>

<?php
}elseif(!isset($_POST["password"])){
?>
<form method="post">
密码:
<input type="password" name="password">
<input type="submit" value="上传"><br/>
</form>



<?php
}elseif($_POST["password"]=="Alt@L114_zin#514.XY"){
?>
<?php
echo "登陆成功";
jump("console.php");
?>
<?php
}else{
    alert("密码错误");
?>
<form method="post">
密码:
<input type="password" name="password">
<input type="submit" value="上传"><br/>
</form>

<?php
}
button_jump("index.php","返回");
html_end();
?>