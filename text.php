<?php
include("function.php");
html_start("留言板/单聊");
h2("留言板/单聊");
if(!file_exists("data/text.txt")){
  file_put_contents("data/text.txt","");
}
if(!isset($_GET["simple"])){
?>
<form method="post">
名字:<input type="text" name="name" <?=isset($_COOKIE["user"])?"value=\"".$_COOKIE["user"]."\" readonly":NULL?>><br/>
内容:<br/><textarea rows="8" cols="60" name="text" placeholder="Enter code"></textarea><br/>
<input type="submit" value="发送">
</form>
<?php
if(isset($_POST["text"]) && isset($_POST["name"])){
  if($_POST["text"]==""){
    alert("文字没输");
  }elseif($_POST["name"]==""){
    alert("名字没输");
  }else{
    file_write("data/text.txt",$_POST["name"]."于".date('Y年m月d日的G:i:s',time())."发表了：\n".$_POST["text"]."\n");
    jump("text.php");
  }
}
?>
<input type="checkbox" id="checkbox" checked>自动刷新留言(复制留言时需关闭，上翻留言时需关闭)<br/>
<iframe name="iframeName" width=100% height=65% src="data/text.txt" scrolling="yes" id="text" style="border:none" onload="window.frames['iframeName'].scrollTo(0,window.frames['iframeName'].document.body.scrollHeight)""></iframe>
<form method="get">
<input style="display:none" name="simple" value="yes">
<button type="submit">单聊</button>
</form>
<script>
  
  var box=document.getElementById("checkbox");  
  function showtext()
{
  var mt = box.checked;
  if(mt){
	document.getElementById('text').contentWindow.location.reload();
  window.frames["iframeName"].scrollTo(0,window.frames["iframeName"].document.body.scrollHeight)
  
  }
}
setInterval("showtext()","1000");
</script>
<?php
}else{
if(isset($_COOKIE["user"])){
  echo "欢迎来到单聊,用户".$_COOKIE["user"]."<br/>";
  function dir_array($dir = "."){
      $arrayy=[];
      $handle = @opendir($dir) or die("Cannot open " . $dir);

      while ($file = readdir($handle)) {
          if ($file != "." && $file != ".." && !is_dir($dir."/".$file) ) {
            $arrayy[]=substr($file,0,-5);
          } elseif($file != "." && $file != ".."){

          }
      }
      closedir($handle);
      return $arrayy;
  }
  foreach(dir_array("user") as $a){
    if($a!=$_COOKIE["user"]){
    echo "<a href=\"text.php?simple=yes&user=".rawurlencode($a)."\">".$a."</a><br/>";
    }
  }
  if(isset($_GET["user"])){

    $user=$_GET["user"];
    ?>
    <h2>用户<?=$_COOKIE["user"]?>与用户<?=$user?>的单聊</h2>
    <?php
    if(file_exists("simpletext/".$_COOKIE["user"]."-"."$user".".json")){
      $road="simpletext/".$_COOKIE["user"]."-"."$user".".json";
       $json=file_get_contents("simpletext/".$_COOKIE["user"]."-"."$user".".json");
       $data=json_decode($json,true);
      if(isset($_POST["simtext"])){
        $data[]=["username"=>$_COOKIE["user"],"time"=>time_get(),"text"=>$_POST["simtext"]];
        file_put_contents($road,json_encode($data));
      }
       foreach($data as $value){
         echo $value["username"]."在".$value["time"]."说:".$value["text"]."<br/>";
       }
    
    }elseif(file_exists("simpletext/"."$user"."-".$_COOKIE["user"].".json")){
      $road="simpletext/"."$user"."-".$_COOKIE["user"].".json";
      $json=file_get_contents("simpletext/"."$user"."-".$_COOKIE["user"].".json");
      $data=json_decode($json,true);
      if(isset($_POST["simtext"])){
        $data[]=["username"=>$_COOKIE["user"],"time"=>time_get(),"text"=>$_POST["simtext"]];
        file_put_contents($road,json_encode($data));
      }
      foreach($data as $value){
        echo $value["username"]."在".$value["time"]."说:".$value["text"]."<br/>";
      }
    
    }else{
      echo "第一次进行此单聊，已新建数据库";
      file_put_contents("simpletext/".$_COOKIE["user"]."-"."$user".".json","[]");
    }
  
  ?>
  <form method="post">
    向用户"<?=$_GET["user"]?>"发送单聊:<br/>
    <input type="text" name="simtext" placeholder="请输入文字"><br/>
    <button type="submit">提交</button>
  </form>
<input type="button" onclick="location.reload();" value="刷新获取最新单聊"><br/>
  <?php
  }
}else{
  echo "未登录，不能使用单聊，请前往<a href=\"user.php\">登录</a><br/>";
}
}
button_jump("index.php","返回");
html_end();
?>