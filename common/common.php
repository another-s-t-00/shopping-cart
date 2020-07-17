<?php


//元号関数
function gengo($seireki)
{
    if (1868 <= $seireki && $seireki <= 1911) {
        $gengo = '明治';
    }
    if (1912 <= $seireki && $seireki <= 1925) {
        $gengo = '大正';
    }
    if (1926 <= $seireki && $seireki <= 1988) {
        $gengo = '昭和';
    }
    if (1989 <= $seireki) {
        $gengo = '平成';
    }
    return ($gengo);
}



//サニタイジング関数
function sanitize($before)
{
    foreach($before as $key=>$value)
    {
        $after[$key]=htmlspecialchars($value);
    }
    return $after;
}


?>