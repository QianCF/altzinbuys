<?php
include("function.php");
html_start("管理员管理器");
if(isset($_COOKIE["user"])){
  if(json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true)["admin"]=="true"){
?>
  欢迎你，管理员，您的喵币:<?=json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true)["meows"]?>个<br/>
删除商品：<br/>
<form method="post">
商品名:
<input type="text" name="delbuy" value="" required><br/>
<input type="submit" value="删除">
</form>
<?php
$user=json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true);
if(date('d',time()) != $user["day"]){
  $user["day"]=date('d',time());
  $user["meows"]=$user["meows"]+7;
  $userjson=json_encode($user);
  file_put_contents("user/".$_COOKIE["user"].".json",$userjson);
}
if(isset($_POST["delbuy"])){
  $buys = json_decode(file_get_contents("data/buys.json"),true);
  if(isset($buys[$_POST["delbuy"]])){
    unlink($buys[$_POST["delbuy"]]["img"]);
    unset($buys[$_POST["delbuy"]]);
    file_put_contents("data/buys.json",json_encode($buys));
    echo "成功<br/>";
  }else{
    alert("没有这个商品");
  }
}
?>
更改库存：<br/>
<form method="post">
商品名:
<input type="text" name="rebuy" value="" required><br/>
增加的库存(可写负数减少库存):<input type="number" name="re" value="" required><br/>
<input type="submit" value="更改">
</form>
<?php
  if(isset($_POST["rebuy"]) && isset($_POST["re"])){
    $buys = json_decode(file_get_contents("data/buys.json"),true);
    if(isset($buys[$_POST["rebuy"]])){
      $buys[$_POST["rebuy"]]["re"] =($buys[$_POST["rebuy"]]["re"]+(int)$_POST["re"])>=0?($buys[$_POST["rebuy"]]["re"]+(int)$_POST["re"]):0;
      file_put_contents("data/buys.json",json_encode($buys));
      echo "成功<br/>";
    }else{
      alert("没有这个商品");
    }
  }
?>
更改价格：<br/>
<form method="post">
商品名:
<input type="text" name="exbuy" value="" required><br/>
新价格:<input type="number" name="reex" value="" required><br/>
<input type="submit" value="更改">
</form>
<?php
  if(isset($_POST["exbuy"]) && isset($_POST["reex"])){
    $buys = json_decode(file_get_contents("data/buys.json"),true);
    if(isset($buys[$_POST["exbuy"]])){
      $buys[$_POST["exbuy"]]["ex"] =(int)$_POST["reex"];
      file_put_contents("data/buys.json",json_encode($buys));
      echo "成功<br/>";
    }else{
      alert("没有这个商品");
    }
  }
?>
<form id="upload-form" method="post" enctype="multipart/form-data" >
  新建商品:<br/>
  商品名:<input type="text" name="buy" value="" required><br/>
  价格:<input type="number" name="ex" value="" required>喵币<br/>
  初始库存:<input type="number" name="nore" value="" required><br/>
图片:<input type="file" name="upload" required/><br/>
<input type="submit" value="新建"/>
</form>

喵币的记录:
<iframe src="data/meowsrec.txt" width=100% height=30% id="farm"></iframe>
  <?php

$uploads_dir = 'up/';
if(isset($_FILES["upload"]) && $_FILES["upload"]["error"]==UPLOAD_ERR_OK){
$name=$_FILES["upload"]["name"];
$file_name=$uploads_dir. file_get_contents("data/count.txt")."$name";
  if(!isset($buys[$_POST["buy"]])){
    file_put_contents("data/count.txt",(int)file_get_contents("data/count.txt")+1);
    $buys = json_decode(file_get_contents("data/buys.json"),true);
move_uploaded_file($_FILES["upload"]["tmp_name"], $file_name);
    if((int)$_POST["nore"] < 0){
      $_POST["nore"] = 0;
    }
  $buys[$_POST["buy"]] = ["ex" => (int)$_POST["ex"],"re" => (int)$_POST["nore"], "img" => $file_name];
  file_put_contents("data/buys.json",json_encode($buys));
  echo "成功<br/>";
  }else{
    alert("已经有这个商品了");
  }
}elseif(isset($_FILES["upload"])){
alert("上传图片失败,请再试一次!!!");
}
  ?>
<?php
    $buyss = json_decode(file_get_contents("data/buys.json"),true);
    foreach($buyss as $name => $info){
      echo $name."商品价格为".$info["ex"].",库存为".$info["re"]."<br/>";
    }
    ?>
处理订单(你处理不了的不要乱处理，让其它管理处理):<br/>
<?php
    $buyrec = json_decode(file_get_contents("data/buyrec.json"),true);
foreach($buyrec as $dan => $info){
  ?>
<form method="post">
单号:<?=$dan?><input style="display:none" name="dan" value='<?=$dan?>'required><br/>
用户名:<?=$info["user"]?><br/>
商品名:<?=$info["buy"]?><br/>
数量:<?=$info["num"]?><br/>
收货者姓名或学号:<?=$info["name"]?><br/>
<button type="submit" <?=$info["go"]=="false"?null:"disabled"?>><?=$info["go"]=="false"?"确认发货":"已发货"?></button>
</form>
<?php
}
if(isset($_POST["dan"])){
  $buyrec = json_decode(file_get_contents("data/buyrec.json"),true);
  $buyrec[$_POST["dan"]]["go"] = "true";
  $cache=$buyrec[$_POST["dan"]];
  unset($buyrec[$_POST["dan"]]);
  $buyrec[$_POST["dan"]] = $cache;
  $user=json_decode(file_get_contents("user/".$cache["user"].".json"),true);
  $user["buys"][(int)$_POST["dan"]]["go"] = "true";
  file_put_contents("data/buyrec.json",json_encode($buyrec));
  file_put_contents("user/".$cache["user"].".json",json_encode($user));
  alert("处理成功");
  echo "<meta http-equiv='refresh' content='0'>";
}
  ?>
<?php
  }else{
    alert("你好像没有权限");
    echo"<meta http-equiv='refresh' content='0;url=index.php'>";
  }
}else{
  alert("你好像没有登录");
  echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}
button_jump("index.php","返回");
html_end();
?>