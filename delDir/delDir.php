<?php
//1 вар.
function del_dir($dir_name) {
    if (is_dir($dir_name)) {
        if($dh = opendir($dir_name)) {
            while (($data = readdir($dh)) !== false) {
                if ($data !== '.' && $data !== '..') {
                    $tmp = $dir_name . '/' . $data;
                    if (is_dir($tmp)) {
                        del_dir($tmp);
                    } else {
                        unlink($tmp);
                    }
                }
            }
        }
        closedir($dir_name);
        rmdir($dir_name);
    }
}
del_dir('mainDir');
//не удаляет с первого вызова  функции корневую папку, удаляет все внутри и выдает Warning: rmdir(mainDir): Directory not empty in,
//хотя она пустая



//2 вар(подсмотренно в сети)
//тут в коде все понятно, не знал о существовании функции glob(), очень удобно
function del_dir_v2($dir_name)
{
    if ($data_arr = glob($dir_name . "/*")) {
        var_dump($data_arr);
        foreach ($data_arr as $data) {
            is_dir($data) ? del_dir_v2($data) : unlink($data);
        }
    }
    rmdir($dir_name);
}
del_dir_v2('mainDir2');


