<?php
$post=$_POST;
function url_validate($url)
{
    $url=trim($url);
    if(!$url){
        return 'Вы ничего не ввели';
    }
    if(!filter_var($url, FILTER_VALIDATE_URL)){
        return 'Вы ввели некоректную ссылку';
    }
    return file_handler($url);
}
function file_handler($url)
{
    $filename = 'file.txt';
    $fp = fopen($filename, 'a+');
    $arr_str = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if(empty($arr_str)){
        $cut_url=gen_cut_url($url);
        fwrite($fp,$url.':'.$cut_url."\n");
        fclose($fp);
        return 'Короткая ссылка - '.$cut_url;
    }
    foreach ($arr_str as $str) {
        $arr_data = explode(':', $str);
        if ($url === $arr_data[0].':'.$arr_data[1]) {
            return "Короткая ссылка - ".$arr_data[2].':'.$arr_data[3]."\n";
        }
    }
    $cut_url=gen_cut_url($url,$arr_str);
    fwrite($fp,$url.':'.$cut_url."\n");
    fclose($fp);
    return "Короткая ссылка - ".$cut_url;
}
function gen_cut_url($url,$arr_str=[]){
    $cut_url_hash='';
    for($i=0;$i<5;$i++) {
        $cut_url_hash.= md5($url.microtime().rand(0, 999))[$i];
    }
    foreach ($arr_str as $str){
        $arr_data = explode(':', $str);
        if('https://zi.ly/'.$cut_url_hash === $arr_data[2].$arr_data[3]){
            gen_cut_url($url,$arr_str);
        }
    }
    return 'https://zi.ly/'.$cut_url_hash;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ответ</title>
</head>
<body>
    <p><?echo url_validate($post['url']);?></p>
    <a href="form.php">Попробовать еще раз</a>
</body>
</html>
