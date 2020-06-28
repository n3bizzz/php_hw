<?php
$files=$_FILES;
var_dump($files);
$number_of_files = count($files['picture']['name']);
for ($i = 0; $i < $number_of_files; $i++) {


        $name = $files['picture']['name'][$i];

        $error = $files['picture']['error'][$i];





        switch ($error) {
            case 1:
                echo "$name не удалось загрузить\n ERROR: The uploaded file exceeds the upload_max_filesize directive in php.ini\n";
                break;
            case 2:
                echo "$name не удалось загрузить\n ERROR: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form\n";
                break;
            case 3:
                echo "$name не удалось загрузить\n ERROR: The uploaded file was only partially uploaded\n";
                break;
            case 4:
                echo "$name не удалось загрузить\n ERROR: No file was uploaded\n";
                break;
            case 6:
                echo "$name не удалось загрузить\n ERROR: Missing a temporary folder\n";
                break;
            case 7:
                echo "$name не удалось загрузить\n ERROR: Failed to write file to disk\n";
                break;
            case 8:
                echo "$name не удалось загрузить\n ERROR: A PHP extension stopped the file upload\n";
                break;
            case 0:
                $type = $files['picture']['type'][$i];
                $size = $files['picture']['size'][$i];
                if (!is_correct_type($name, $type)) break;
                if (!is_correct_size($name, $size)) break;
                $new_name = gen_new_name($name);
                $tmp_name = $files['picture']['tmp_name'][$i];
                if (move_uploaded_file($tmp_name, "img/$new_name")) {
                    echo "$name успешно загружен\n";
                } else {
                    echo "$name не удалось загрузить\n";
                }
        }
}
function is_correct_type($name,$type){
    if(strpos($type, 'image')===false){
        echo "$name неправильного типа, файл не будет загружен\n";
        return false;
    }
    return true;
}
function is_correct_size($name,$size){
    if($size>3145728){
        echo "$name больше 3мб, файл не будет загружен\n";
        return false;
    }
    return true;
}
function gen_new_name($name){
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $name=md5($name.microtime().rand(0,999));
    return $name.'.'.$ext;
}