<?php
if(empty($_REQUEST)){ return; }

if($_GET['action'] == 'admin'){
    if($_GET['code'] == 'jiangzubin520123'){
        echo true;
    } else {
        echo false;
    }

}
?>
