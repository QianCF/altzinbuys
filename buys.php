<?php
include("function.php");
html_start("购物中心");
h2("购物中心");
if(isset($_COOKIE["user"])){
  $aa=json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true);
  if(time()-$aa["buyday"]>=1209600){
    $aa["buymu"]=1;
    file_put_contents("user/".$_COOKIE["user"].".json",json_encode($aa));
  }
  $buys = json_decode(file_get_contents("data/buys.json"),true);
  ?>
  您好，<?=$_COOKIE["user"]?>，您的喵币:<?=json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true)["meows"]?>个，您购买时价格的倍率:<?=$aa["buymu"]?><br/>
<?php
  foreach($buys as $name => $info){
    ?>
    <form method="post">
    <img src="<?=$info["img"]?>" width="200"/><br/>
    商品名:<?=$name?><input style="display:none" name="buy" value='<?=$name?>'required><br/>
    售价:<?=$info["ex"]?><input style="display:none" name="ex" value='<?=$info["ex"]?>'required><br/>
    库存:<?=$info["re"]?><input style="display:none" name="re" value='<?=$info["re"]?>'required><br/>
    数量:<input type="number" name="num" value='1' required><br/>
      收货人真实姓名或学号:<input name="name" value='' required>(请填写真实的初一五班姓名或学号，不然送不到货)<br/>
    <button type="submit" <?=($info["re"]==0)?"disabled":null?>>购买</button>
    </form>
<?php
  }
  if(isset($_POST["buy"])){
    if((int)$_POST["re"] >= (int)$_POST["num"]){
    $user=json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true);
    $rec=json_decode(file_get_contents("data/buyrec.json"),true);
  $buybuy = json_decode(file_get_contents("data/buys.json"),true);
    if($user["meows"] >= (int)$_POST["ex"] * (int)$_POST["num"]){
      $rec=array_reverse($rec,true);
      $user["buys"]=array_reverse($user["buys"],true);
      $user["buyday"]=time();
      $user["buycalc"]+=(int)$_POST["ex"] * (int)$_POST["num"];
      if($user["buycalc"]>=400){
        $user["buymu"]=0.9;
        $user["buycalc"] = 0;
      }elseif($user["buycalc"]>=200){
        $user["buymu"]=0.95;
      }
      $user["meows"]-=ceil((int)$_POST["ex"] * (int)$_POST["num"] * $user["buymu"]);
      $buybuy[$_POST["buy"]]["re"]-=$_POST["num"];
      $rech=count($rec);
      $rec[$rech]=["user"=>$_COOKIE["user"],"buy"=>$_POST["buy"],"num" => $_POST["num"],"go"=>"false","name" => $_POST["name"]];
      $rec=array_reverse($rec,true);
      $user["buys"][$rech]=["user"=>$_COOKIE["user"],"buy"=>$_POST["buy"],"num" => $_POST["num"],"go"=>"false","name" => $_POST["name"]];
      $user["buys"]=array_reverse($user["buys"],true);
      file_put_contents("user/".$_COOKIE["user"].".json",json_encode($user));
      file_put_contents("data/buys.json",json_encode($buybuy));
      file_put_contents("data/buyrec.json",json_encode($rec));
file_put_contents("data/meowsrec.txt",file_get_contents("data/meowsrec.txt")."".$_COOKIE["user"]."花费了".ceil((int)$_POST["ex"] * (int)$_POST["num"] * $user["buymu"])."个喵币,现有".$user["meows"]."个喵币\n");
      alert("购买成功");
      echo "<meta http-equiv='refresh' content='0;url=buys.php'>";
    }else{
      alert("库存不足但不为0，请买少一点");
      echo "<meta http-equiv='refresh' content='0;url=buys.php'>";
    }
  }else{
      alert("你没有足够的喵币");
    echo "<meta http-equiv='refresh' content='0;url=buys.php'>";
  }
}
?>
您所买的东西的的列表:<br/>
    
<?php
  $user = json_decode(file_get_contents("user/".$_COOKIE["user"].".json"),true);
  foreach($user["buys"] as $dan => $buyunit){
    echo "单号:".$dan.";品名:".$buyunit["buy"].";数量:".$buyunit["num"].";管理员确认发货:".($buyunit["go"]=="true"?"是":"否").";姓名或学号:".$buyunit["name"]."<br/>";
  }
}else{
alert("你好像没有登录");
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}

button_jump("index.php","返回");
html_end();
?>