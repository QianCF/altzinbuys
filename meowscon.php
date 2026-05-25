<?php
include("function.php");
html_start("喵币兑换");
if(isset($_COOKIE["user"])){
?>
  <form method="post">
  喵币兑换码(不区分大小写):
  <input type="text" name="con">
  <input type="submit" value="兑换"><br/>
  </form>
<?php
if(isset($_POST["con"])){
  $_POST["con"] = ltrim($_POST["con"],'0');
  $_POST["con"] = strtoupper($_POST["con"]);
  $a = base_convert($_POST["con"],36,10);
  if($a % 71 == 0){
  switch(strlen($_POST["con"])){
    case 6:
      $userData = json_decode(file_get_contents("user/".$_COOKIE["user"].".json"), true);
      $cons=json_decode(file_get_contents("data/con.json"),true);
      if(!isset($cons[$_POST["con"]])){
        $cons[$_POST["con"]] = $_COOKIE["user"];
        $userData["meows"]+=10;
        echo $_COOKIE["user"]."使用兑换码".$_POST["con"]."兑换了10个喵币,现有".$userData["meows"]."个喵币"."<br/>";
file_put_contents("data/meowsrec.txt",file_get_contents("data/meowsrec.txt")."".$_COOKIE["user"]."使用兑换码".$_POST["con"]."兑换了10个喵币,现有".$userData["meows"]."个喵币\n");
        file_put_contents("data/con.json",json_encode($cons));
        file_put_contents("user/".$_COOKIE["user"].".json",json_encode($userData));
        break;
      }else{
        alert("兑换码已被使用");
        break;
      }
    case 7:
      $userData = json_decode(file_get_contents("user/".$_COOKIE["user"].".json"), true);
      $cons=json_decode(file_get_contents("data/con.json"),true);      
    if(!isset($cons[$_POST["con"]])){
      $cons[$_POST["con"]] = $_COOKIE["user"];
      $userData["meows"]+=20;
      echo $_COOKIE["user"]."使用兑换码".$_POST["con"]."兑换了20个喵币,现有".$userData["meows"]."个喵币"."<br/>";
file_put_contents("data/meowsrec.txt",file_get_contents("data/meowsrec.txt")."".$_COOKIE["user"]."使用兑换码".$_POST["con"]."兑换了20个喵币,现有".$userData["meows"]."个喵币\n");
      file_put_contents("data/con.json",json_encode($cons));
      file_put_contents("user/".$_COOKIE["user"].".json",json_encode($userData));
      break;
    }else{
      alert("兑换码已被使用");
      break;
    }
    case 8:
      $userData = json_decode(file_get_contents("user/".$_COOKIE["user"].".json"), true);
      $cons=json_decode(file_get_contents("data/con.json"),true);            
    if(!isset($cons[$_POST["con"]])){
      $cons[$_POST["con"]] = $_COOKIE["user"];
      $userData["meows"]+=40;
      echo $_COOKIE["user"]."使用兑换码".$_POST["con"]."兑换了40个喵币,现有".$userData["meows"]."个喵币"."<br/>";
file_put_contents("data/meowsrec.txt",file_get_contents("data/meowsrec.txt")."".$_COOKIE["user"]."使用兑换码".$_POST["con"]."兑换了40个喵币,现有".$userData["meows"]."个喵币\n");
      file_put_contents("data/con.json",json_encode($cons));
      file_put_contents("user/".$_COOKIE["user"].".json",json_encode($userData));
      break;
    }else{
      alert("兑换码已被使用");
      break;
    }
    default:
    alert("兑换码长度不对");
    break;
  }
  }else{
    alert("兑换码错误");
  }
  
}
?>
<?php
}else{
  alert("你好像没有登录");
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
  ?>

<?php
}
?>
<?php
button_jump("index.php","返回");
html_end();
?>