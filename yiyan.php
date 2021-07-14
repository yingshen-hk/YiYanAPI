<?php

$main = imagecreatefromjpeg('./background.jpg');//背景图片
$yiyan = file_get_contents("https://v1.hitokoto.cn/?c=a&encode=json");//读取一言api
$arr=json_decode($yiyan,true);//获取api的json

$fontSize = 20;//字体大小
$circleSize = 0;//旋转角度
$width = imagesx($main);//坐标x
$hitokotoheight = 200;//Hitokoto的坐标y
$fromheight = 300;//From的坐标y

$font = "./字体.ttf";//字体的路径
$color = imagecolorallocatealpha($main, 255, 255, 255, 0);//字体颜色和透明度
$hitokoto = $arr['hitokoto'];//句子
$from = $arr['from'];//出处

$hitokotofontBox = imagettfbbox($fontSize, 0, $font, $hitokoto);//获取句子文字所需的尺寸大小 
$fromfontBox = imagettfbbox($fontSize, 0, $font, $from);//获取出处文字所需的尺寸大小 

//写入文字 (图片资源，字体大小，旋转角度，坐标x，坐标y，颜色，字体文件，内容)
imagettftext($main, $fontSize, $circleSize, ceil(($width - $hitokotofontBox[2]) / 2), $hitokotoheight, $color, $font, $hitokoto);
imagettftext($main, $fontSize, $circleSize, ceil(($width - $fromfontBox[2]) / 2), $fromheight, $color, $font, $from);

//浏览器输出 也可以换成保存新图片资源
header("Content-type:jpg");
imagejpeg($main);