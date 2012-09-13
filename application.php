<?php
header("Content-type: text/html; charset=utf-8");
//连本地库
//$link = mysql_connect('127.0.0.1:3306','root','') or die("Could not connect: " . mysql_error());
//连主库
$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die("Could not connect: " . mysql_error());
//连从库
//$link = mysql_connect(SAE_MYSQL_HOST_S.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
if($link){
	mysql_select_db('app_yanghome', $link) or die ('Can\'t use foo : ' . mysql_error());

    mysql_query('set names utf-8', $link);
}
//查看分类表的数据
/*$mysql = new SaeMysql();
function read_class_table($table){

    global $mysql;

    $sql = "SELECT * FROM `{$table}` where 1";

    return $mysql->getData($sql);
}
$name = strip_tags( $_REQUEST['name'] );
$age = intval( $_REQUEST['age'] );
$sql = "INSERT  INTO `user` ( `name` , `age` , `regtime` ) VALUES ( '"  . $mysql->escape( $name ) . "' , '" . intval( $age ) . "' , NOW() ) ";
$mysql->runSql( $sql );
if( $mysql->errno() != 0 )
{
    die( "Error:" . $mysql->errmsg() );
}

$mysql->closeDb();
*/
//查看数据表中的所有数据
function get_table($table, $term='WHERE 1'){
    $sql = "SELECT * FROM `{$table}` {$term}";
    $query = mysql_query($sql);
    if($query){
        $rzt = array();
        while($rows=mysql_fetch_assoc($query)){
            $rzt[] = $rows;
        }
    }
    return $rzt;
}

function  get_first_data($table, $term='WHERE 1 limit 1'){
    $sql = "SELECT * FROM `{$table}` {$term}";
    $query = mysql_query($sql);
    if($query){
       
       $rows=mysql_fetch_assoc($query);
    
    }
    return $rows;
}
function get_id_data($table){
    
    $sql = "SELECT id FROM `{$table}`";
    $query = mysql_query($sql);
    if($query){
        $rzt = array();
        while($rows=mysql_fetch_assoc($query)){
            $rzt[] = $rows;
        }
    }
    return $rzt;
}

function get_count($table){
    $sql = "SELECT count(*) FROM `{$table}`";
    return mysql_query($sql);
}
function add ($data) {
	extract($data);

	$time = time();
	$name = $mail;

	$sql = "INSERT INTO `app_yanghome`.`message` (`id`, `cid`, `assess`, `name`, `mail`, `qq`, `content`, `datetime`) VALUES ('', '{$id}', '{$assess}', '{$name}', '{$mail}', '{$qq}', '{$content}', '{$time}')";

	$query = mysql_query($sql);
}

?>
<script src="http://app.baidu.com/static/appstore/monitor.st"></script>