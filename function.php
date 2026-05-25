<?php
$siteweb = file_get_contents("site.txt");
function alert($a){
    echo "<script>alert('$a');</script>\n";
}
function console_log($a){
    echo "<script>console.log('$a');</script>\n";
}
function console_info($a){
    echo "<script>console.info('$a');</script>\n";
}
function console_error($a){
    echo "<script>console.error('$a');</script>\n";
}
function console_debug($a){
    echo "<script>console.debug('$a');</script>\n";
}
function href($a,$b,$c = null){
    if(isset($c)){
        echo "<a href=\"$a\" style='color:$c'>$b</a>\n";
    }else{
        echo "<a href=\"$a\">$b</a>\n";
    }

}
function a_css(){
    echo "<style>\na:link\n{color:#0033ff;}a:hover\n{color:#ffaa00;}a:active\n{color:#00ff00;}\n</style>\n";
}
function br(){
    echo "<br/>\n";
}
function hr(){
    echo "<hr/>\n";
}
function h1($a){
    echo "<h1>$a</h1>\n";
}
function h2($a){
    echo "<h2>$a</h2>\n";
}
function h3($a){
    echo "<h3>$a</h3>\n";
}
function black_href($a,$b){
    echo"<a href='$a' style='text-decoration:none'><span style='color:black'>$b</span></a><br/>\n";
}
function img($a,$b = "img",$c = NULL,$d = NULL){
    if(isset($c)&&isset($d)){
        echo "<img src=\"$a\" alt=\"$b\" width=\"$c\" height=\"$d\" /><br/>\n";
    }else{
        echo "<img src='$a' alt='$b'/><br/>\n";
    }

}
function jump($a,$b = 0){
    echo"<meta http-equiv=refresh content='$b;url=$a'>\n";
}
function button_back($a){
    echo "<button onclick=\"history.go(-1)\">$a</button><br/>\n";
}
function button_jump($a,$b){
    echo "<button onclick=\"location.href='$a'\">$b</button><br/>\n";
}
function button_copy($a,$b){
    echo "<button onclick=\"copytext('$a')\">$b</button><br/>\n";
}
function html_start($a){
    time_set();
    file_put_contents("data".$_SERVER['PHP_SELF'].".txt",file_exists("data".$_SERVER['PHP_SELF'].".txt")?(int)file_get_contents("data".$_SERVER['PHP_SELF'].".txt")+1:"1");
  if(!isset($_SERVER["HTTP_REFERER"])){
    $_SERVER["HTTP_REFERER"]="";
  }
    file_write("data/views.txt",date('Y,m,d G:i:s',time())." ".$_SERVER['HTTP_X_FORWARDED_FOR']." ".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']." ".$_SERVER["HTTP_REFERER"]."\n");
    ?>
    <!DOCTYPE html>
    <html lang="zh">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?="AltzinWeb卖场-".$a." =>喵网三世,Altzin,喵测试网站,喵测试网"?></title>
        <link rel="icon" href="favicon.ico?v=<?=rand(0,100)?>">
        <style>
            html, body
            {
                width: 100%;
                height: 100%;
            }
            a:link {color:#0033ff;}
            a:hover {color:#ffaa00;}
            a:active {color:#00ff00;}
        </style>
        <?php readfile("headadd.txt")?>

        <script>console.info("meow!");</script>
  <script>

  function editable(){
    if(document.body.contentEditable=="true"){
    document.body.contentEditable='false'
      document.designMode='off'
      
    }else{
      document.body.contentEditable="true"
      document.designMode='on'
      
    }
  }
  </script>
    
    <body background="paperang_000.jpg">

    <h1 style="display:none">
      <img src="favicon.ico" alt="icon"/>
        这里是AltzinWeb，是Altzin正在测试的一个网站，全天开放，欢迎进入！
        这里是AltzinWeb，是Altzin正在测试的一个网站，全天开放，欢迎进入！
        这里是AltzinWeb，是Altzin正在测试的一个网站，全天开放，欢迎进入！
        AltzinWeb,喵不拉几,Meow,Altzin,cat,喵,喵测试,喵测试网,喵测试网站,altzin,cat,meow,网站,喵网,喵网三世,三世,喵妹妹留言板
        AltzinWeb,喵不拉几,Meow,Altzin,cat,喵,喵测试,喵测试网,喵测试网站,altzin,cat,meow,网站,喵网,喵网三世,三世,喵妹妹留言板
        AltzinWeb,喵不拉几,Meow,Altzin,cat,喵,喵测试,喵测试网,喵测试网站,altzin,cat,meow,网站,喵网,喵网三世,三世,喵妹妹留言板
    </h1>

    <?php
}
function html_end(){
  
    echo "本页访问次数：".file_get_contents("data".$_SERVER['PHP_SELF'].".txt");
    ?>
      
    <br/><button onclick="editable()">打开/关闭编辑网页</button>
    <noscript>
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
        AltzinWeb,AltzinWeb
    </noscript>
    <span style="display:none">
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
    AltzinWeb,AltzinWeb
  </span>
      
    </body>
    </html>
    <?php
}
function file_write($a,$b){
    $fp=fopen($a,"a");
    fputs($fp,$b);
    fclose($fp);
}
function str($a,$b = "black"){
    echo "<span style='color:$b'>$a</span>\n";
}
function time_set(){
    date_default_timezone_set('PRC');
}
function file_echo($a){
    echo file_get_contents($a);
}
function time_get(){
    return date('Y年m月d日的G:i:s',time());
}
function file_echo_nohtml($a){
    echo str_replace(" ","&nbsp",str_replace("\n","<br/>",htmlentities(file_get_contents($a))))."<br/>";
}
function text_echo_nohtml($a){
    echo str_replace(" ","&nbsp",str_replace("\n","<br/>",htmlentities($a)))."<br/>";
}
function img_href($a,$f,$b = "img",$c = NULL,$d = NULL){
    if(isset($c)&&isset($d)){
        echo "<img src=\"$a\" href = '$f' alt=\"$b\" width=\"$c\" height=\"$d\" />\n";
    }else{
        echo "<img src='$a' alt='$b' href = '$f'/>\n";
    }

}
function dir_echo($dir = ".")
{
    $handle = @opendir($dir) or die("Cannot open " . $dir);

    while ($file = readdir($handle)) {
        if ($file != "." && $file != ".." && !is_dir($dir."/".$file)) {
            echo $file."<br>";
        } elseif($file != "." && $file != ".."){
            echo $file." **(isdir)**<br>";
        }
    }
    closedir($handle);
}
function dirdir_echo($dir = ".")
{
    $arrayy=[];
    $handle = @opendir($dir) or die("Cannot open " . $dir);

    while ($file = readdir($handle)) {
        if ($file != "." && $file != ".." && !is_dir($dir."/".$file) ) {
        } elseif($file != "." && $file != ".." && $file != "link"){
            $arrayy[]=$file;
        }
    }
    closedir($handle);
    return $arrayy;
}
function dir_chmod($dir = ".")
{
    $arrayy=[];
    $handle = @opendir($dir) or die("Cannot open " . $dir);

    while ($file = readdir($handle)) {
        if ($file != "." && $file != ".." && !is_dir($dir."/".$file)) {
            chmod($dir."/".$file,0777);

        } elseif($file != "." && $file != ".."){

        }
    }
    closedir($handle);
    return $arrayy;
}
?>