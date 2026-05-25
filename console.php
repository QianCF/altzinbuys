<?php
include("function.php");
if(isset($_POST["password"])){
  setrawcookie("admin_password","",time()-1,"/");
}
date_default_timezone_set('PRC');
html_start("喵币控制台");
if((isset($_COOKIE["admin_password"])?$_COOKIE["admin_password"]:"不是密码") == "Alt@L114_zin#514.XY"){
h1("喵币控制台,请勿随意操作");
  if(isset($_POST["user"]) && isset($_POST["meows"])){
    if(file_exists("user/".$_POST["user"].".json")){
    $data = json_decode(file_get_contents("user/".$_POST["user"].".json"),true);
    $data["meows"] = ($data["meows"] + (int)$_POST["meows"])>=0?($data["meows"] + (int)$_POST["meows"]):0;
    file_put_contents("user/".$_POST["user"].".json",json_encode($data));
    echo "添加完毕<br/>";
file_put_contents("data/meowsrec.txt",file_get_contents("data/meowsrec.txt")."为".$_POST["user"]."增加了".$_POST["meows"]."个喵币,现有".$data["meows"]."个喵币\n");
    }else{
      echo "用户不存在,无法添加<br/>";
    }
  }
?>
    添加喵币：<br/>
  <form method="post">
  用户名:
  <input type="text" name="user" value="" required><br/>
  增加喵币个数:<input type="number" name="meows" value="" required>(写负数即为扣喵币)<br/>

  <input type="submit" value="增加">
  </form>
<?php
  function dir_array($dir = ".")
  {
      $arrayy=[];
      $handle = @opendir($dir) or die("Cannot open " . $dir);

      while ($file = readdir($handle)) {
          if ($file != "." && $file != ".." && !is_dir($dir."/".$file) ) {
            $arrayy[]=$file;
          } elseif($file != "." && $file != ".."){

          }
      }
      closedir($handle);
      return $arrayy;
  }
  foreach(dir_array("user") as $a){
    echo json_decode(file_get_contents("user/".$a),true)["username"]."拥有喵币".json_decode(file_get_contents("user/".$a),true)["meows"]."个<br/>";
  }
  ?>
  喵币的记录:
  <iframe src="data/meowsrec.txt" width=100% height=30% id="farm"></iframe>
  <form method = "post">
  生成喵币兑换码:<br/>
  数量:<input name = "count" type = "text" required/><br/>
  种类:<input type = "radio" name = "method" value = "1"required/>10喵币 <input type = "radio" name = "method" value = "2"/>20喵币 <input type = "radio" name = "method" value = "3"/>40喵币
  <br/><input type = "submit" value = "生成"/>
  </form>
<?php
if(isset($_POST["count"]) && isset($_POST["method"])){
   switch((int)$_POST["method"]){
     case 1:
        $min=851637;
        $max = 30658906;
        break;
     case 2:
      $min=310968906;
      $max = 1103720621;
      break;
     case 3:
        $min=1103720622;
        $max=39733942358;
        break;
   }
  $count = 0;
  $codes=[];
    for(;;){
      if($count == (int)$_POST["count"]){
        break;
      }
      $code = rand($min,$max);
      $code*=71;
      $code = base_convert((string)$code,10,36);
      $cons=json_decode(file_get_contents("data/con.json"),true);
      if(!isset($codes[$code])){
        if(!isset($cons[$code])){
          $count++;
          $codes[$code]=1;
        }
      }
      
    }
  foreach($codes as $c => $f1){
    echo $c."<br/>";
  }
}

  ?>
  <form method="post">
  <input type="submit" value="清除留言"><br/>
  <input type="text" name="text_clean" value="....."style="display:none;">
  </form>
  <?php
    if(isset($_POST["text_clean"])){
      unlink("data/text.txt");
      file_put_contents("data/text.txt","");
      echo "清除成功<br/>";
    }
  ?>
  <form method="post">
  <input type="submit" value="清除日志"><br/>
  <input type="text" name="views_clean" value="....."style="display:none;">
  </form>
  <?php
    if(isset($_POST["views_clean"])){
      unlink("data/views.txt");
      file_put_contents("data/views.txt","");
      echo "清除成功<br/>";
    }

  if(!(isset($_POST["password"]))){
  ?>

  <form method="post">
  <input type="submit" value="退出管理"><br/>
  <input type="text" name="password" value="....."style="display:none;">
  </form>
  <?php
}else{
  alert("退出成功");
  echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}
?>

<?php


}else{
    alert("你好像没有登录");
    echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}
html_end();
?>