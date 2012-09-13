<?php
require('baseModel.php');
class codeModel extends baseModel {

    function __construct(){
        baseModel :: __construct();
    } 

    function getCodeClass(){

        $data = $this->getClass('code_class');

        return $data;
       
    }

    function getCodeData(){

        $data = $this->getClass('code');

        return $data;
       
    }

    function addData($data){
        
        $sql = "insert into `code` (type, title, content,datetime) values ('{$data['type']}', '{$data['title']}', '{$data['content']}', '{$data['datetime']}')";


        return $this->insert($sql);

    }

}

