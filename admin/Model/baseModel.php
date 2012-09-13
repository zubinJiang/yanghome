<?php
class baseModel {
    
    function __construct(){
        $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die("Could not connect: " . mysql_error());
        if($link){
	        mysql_select_db('app_yanghome', $link) or die ('Can\'t use foo : ' . mysql_error());
	        mysql_query('set names utf-8', $link);
        }
    }
    function getClass($tablename, $term='WHERE 1'){
        $sql = "SELECT * FROM `{$tablename}` {$term}";
        $query = mysql_query($sql);
        if($query){
            $rzt = array();
            while($rows=mysql_fetch_assoc($query)){
                $rzt[] = $rows;
            }
        }
        return $rzt;
    }

    function insert($sql){

        mysql_query($sql);

        return mysql_insert_id();
    }
}
