<?php
require('baseModel.php');
class userModel extends baseModel {

    function __construct(){
        baseModel :: __construct();
    } 

    function getCode(){
        return 'code';
    }

}

