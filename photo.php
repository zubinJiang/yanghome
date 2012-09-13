<?php
include("application.php");
$type = array(0=>'网站素材', 1=>'人物', 2=>'风景', 3=>'汽车', 4=>'卡通', 5=>'科技', 6=>'其它');
$page = range(1,4);
require_once("./html/photo.html");
