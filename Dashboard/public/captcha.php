<?php
session_start();

$code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);
$_SESSION['captcha'] = $code;

header('Content-Type: image/png');
$img = imagecreate(120, 40);
$bg = imagecolorallocate($img, 255, 255, 255);
$txt = imagecolorallocate($img, 0, 0, 0);

imagestring($img, 5, 20, 12, $code, $txt);
imagepng($img);
imagedestroy($img);
