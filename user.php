<?php
include("function.php");
if(isset($_POST["ydenglu"])){
  if(!file_exists("user/".$_POST["user"].".json")){
  }else{
    $info = json_decode(file_get_contents("user/".$_POST["user"].".json"), true);
    if($info["password"] != $_POST["password"]){
    }else{
      setrawcookie("user",$_POST["user"],time()+3*60*60*24,"/");
      setrawcookie("password",$_POST["password"],time()+3*60*60*24,"/");
    }
  }
}
if(isset($_POST["tuideng"])){
      setrawcookie("user","",time()-1,"/");
      setrawcookie("password","",time()-1,"/");
}
html_start("登陆/注册/修改密码/退出登录/修改主页内容");
if(!isset($_POST["zhuce"]) && !isset($_POST["denglu"]) && !isset($_POST["mima"]) && !isset($_POST["liuyan"]) && !isset($_POST["daima"]) && !isset($_POST["tuideng"])){
?>

<form method="post">
<input style="display:none" name="zhuce" value="......">
<button type="submit">注册</button>
</form>
<form method="post">
<input style="display:none" name="denglu" value="......">
<button type="submit">登陆</button>
</form>
<form method="post">
<input style="display:none" name="mima" value="......">
<button type="submit">修改密码</button>
</form>
<form method="post">
<input style="display:none" name="liuyan" value="......">
<button type="submit">修改个人主页留言</button>
</form>
<form method="post">
<input style="display:none" name="daima" value="......">
<button type="submit">获取您或他人的主页留言代码</button>
</form>
<?php
  if(isset($_COOKIE["user"]) || isset($_COOKIE["password"])){
    ?>
      <form method="post">
        <input style="display:none" name="tuideng" value="......">
        <button type="submit">退出登录</button>
      </form>
      <button onclick="location.href='userinfo.php?user=<?=rawurlencode($_COOKIE["user"])?>'">进入我的主页</button><br/>
    <?php
  }
}
if(isset($_POST["daima"])){
  ?>
<form method="post">
用户名:<input name="user" required><br/>
<input style="display:none" name="daima" value="......">
  <input style="display:none" name="ydaima" value="......">
<button type="submit">查询</button>
</form>
<?php
if(isset($_POST["ydaima"])){
  if(!file_exists("user/".$_POST["user"].".json")){
    echo"用户不存在，无法查询代码。请查证后继续<br/>";
  }else{
    $info = json_decode(file_get_contents("user/".$_POST["user"].".json"), true);
    text_echo_nohtml($info["text"]);
  }
}
}
if(isset($_POST["zhuce"])){
   if(!isset($_POST["yzhuce"])){
  ?>
  
<form method="post">
用户名:<input name="user" required><br/>
密码:<input name="password" required><br/>
重复密码:<input name="password_2" required><br/>
管理员码:<input name="adminpost" required value="没事别动"><br/>

<input style="display:none" name="zhuce" value="......">
  <input style="display:none" name="yzhuce" value="......">
<button type="submit">注册</button>
</form>
<?php
}
if(isset($_POST["yzhuce"])){
  if(!file_exists("user/".$_POST["user"].".json")){
    if($_POST["adminpost"] == "Alt@123_zin.LQ995"){
      $admin = "true";
    }else{
      $admin = "false";
    }
    $info = ["username" => $_POST["user"],"password" => $_POST["password"],"text" => "","admin"=> $admin,"meows" => 10,"day" => date('d',time()),"buys"=>[],"buyday"=>time(),"buymu"=>1,"buycalc"=>0];
    if($_POST["password_2"] != $_POST["password"]){
      echo "两次密码不符，无法注册。<br/>第一次密码:".$_POST["password"]."<br/>第二次密码:".$_POST["password_2"]."<br/>";
    }else{
      $infojson = json_encode($info);
      file_put_contents("user/".$_POST["user"].".json",$infojson);
      echo "注册成功。<br/>用户名:".$_POST["user"]."<br/>密码:".$_POST["password"]."<br/>管理员:".$admin."<br/>";
    }
  }else{
    echo"用户存在，无法注册。<br/>";
  }
}
}
if(isset($_POST["tuideng"])){
  echo "已退出。<br/><script>location.href='user.php'</script>";
}
if(isset($_POST["denglu"])){
 if(!isset($_POST["ydenglu"])){
  ?>
  
<form method="post">
用户名:<input name="user" required><br/>
密码:<input name="password" required><br/>
<input style="display:none" name="denglu" value="......">
  <input style="display:none" name="ydenglu" value="......">
<button type="submit">登陆</button>
</form>
<?php
}
if(isset($_POST["ydenglu"])){
  if(!file_exists("user/".$_POST["user"].".json")){
    echo"用户不存在，无法登陆。请点击\"重来\"按钮注册<br/>";
  }else{
    $info = json_decode(file_get_contents("user/".$_POST["user"].".json"), true);
    if($info["password"] != $_POST["password"]){
      echo "密码错误，无法登陆。<br/>";
    }else{
      
      echo "登陆成功。<br/>";
    }
  }
}
}
if(isset($_POST["mima"])){
     if(!isset($_POST["ymima"])){
  ?>
  
<form method="post">
用户名:<input name="user" required><br/>
旧密码:<input name="password_0" required><br/>
新密码:<input name="password" required><br/>
重复新密码:<input name="password_2" required><br/>
<input style="display:none" name="mima" value="......">
  <input style="display:none" name="ymima" value="......">
<button type="submit">修改</button>
</form>
<?php
}
if(isset($_POST["ymima"])){
  if(file_exists("user/".$_POST["user"].".json")){
    $info = json_decode(file_get_contents("user/".$_POST["user"].".json"), true);
    if($_POST["password_0"] == $info["password"]){
    if($_POST["password_2"] != $_POST["password"]){
      echo "两个新密码不符，无法更改。<br/>第一次新密码:".$_POST["password"]."<br/>第二次新密码:".$_POST["password_2"]."<br/>";
    }else{
      $info["password"]=$_POST["password"];
      $infojson = json_encode($info);
      file_put_contents("user/".$_POST["user"].".json",$infojson);
      echo "更改密码成功。<br/>用户名:".$_POST["user"]."<br/>现密码:".$_POST["password"]."<br/>";
    }
    }else{
      echo "原密码错误，无法更改密码。<br/>";
    }
  }else{
    echo"用户不存在，无法更改密码，请先注册。<br/>";
  }
}
}
if(isset($_POST["liuyan"])){
  if(!isset($_POST["yliuyan"])){
  ?>
<form method="post">
可用任何html标签!<br/>
用户名:<input name="user" required><br/>
密码:<input name="password" required><br/>
新主页留言:<br/><textarea rows="8" cols="60" name="liu" placeholder="没有内容">
</textarea><br/>
<input style="display:none" name="liuyan" value="......">
  <input style="display:none" name="yliuyan" value="......">
<button type="submit">修改</button>
</form>

<?php
}
if(isset($_POST["yliuyan"])){
  if(!file_exists("user/".$_POST["user"].".json")){
    echo"用户不存在，无法修改。请点击\"重来\"按钮注册<br/>";
  }else{
    $info = json_decode(file_get_contents("user/".$_POST["user"].".json"), true);
    if($info["password"] != $_POST["password"]){
      echo "密码错误，无法修改。<br/>";
    }else{
      $info["text"]=$_POST["liu"];
      $infojson=json_encode($info);
      file_put_contents("user/".$_POST["user"].".json",$infojson);
      echo "修改完成。<br/>";
    }
  }
}
}
?>
<?php
button_jump("index.php","返回首页");
button_jump("user.php","重来");
html_end();
?>