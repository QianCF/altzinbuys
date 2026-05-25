<?php
include("function.php");
html_start("用户列表");
h2("用户列表");
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
  $user=json_decode(file_get_contents("user/".$a),true);
  echo "<a href=\"userinfo.php?user=".rawurlencode(substr($a,0,-5))."\">".substr($a,0,-5)."</a> 此用户买东西价格倍率:".$user["buymu"]."<br/>";
}
?>
<?php
button_back("返回");
html_end();
?>