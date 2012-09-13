<?php
/**
 * @author 零起点工作室
 * @version v1.0
 * @copyright 2010
 * 
 * @todo 工具类，常用函数
 * 
 */
class CUtil
{
    /*
	* 获取IP地址
	*/
    public static function getIP() 
    {
        $ip = false;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip != false) {
                array_unshift($ips,$ip);
                $ip = false;
            }
            $count = count($ips);
            // 排除局域网IP地址
            for ($i = 0; $i < $count; $i++) {
                if (!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return (false == $ip AND isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : $ip;
    }
    
    /*
	 * 取得随机字符串
	 * @param int $length  字符的长度
	 * @param int $numeric 只是数字时，数字长度
	 * @return 
	 */
    public static function random($length, $numeric = 0) 
    {
		mt_srand((double)microtime() * 1000000);
		if($numeric) {
			$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
		} else {
			$hash = '';
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
			$max = strlen($chars) - 1;
			for($i = 0; $i < $length; $i++) {
				$hash .= $chars[mt_rand(0, $max)];
			}
		}
		return $hash;
	}
	
	/*
	 * 拼接URL（用于在当前链接变换筛选条件参数） zgm 2012-5-10
	 * @param array $args  url参数数组
	 * @param int $type 返回url的格式 ， 默认0参数形式
	 * @return url  返回相对链接
	 */
    public static function geturl( $args , $type=0 ) 
    {
		$queryString = "";
		if (!empty($_SERVER['QUERY_STRING'])) {
		  $params = explode("&", $_SERVER['QUERY_STRING']);
		  $newParams = array();
		  foreach ($params as $param) {
		  	$flag = true;
		  	foreach($args as $key=>$value){
		  		if(stristr($param, $key)) $flag = false;
		  	}
		    if ( $flag ) {
		      array_push($newParams, $param);
		    }
		  }
		  if (count($newParams) != 0) {
		    $queryString = implode("&", $newParams);
		  }
		}
		$str = '';
		foreach($args as $k=>$v){
			$str .= $v==''?'':$k.'='.$v.'&';
		}
		$str = $str? '&'.trim($str, '&'):'';
		$queryString = sprintf("/index.php?%s{$str}", $queryString);
		if(!$type) return $queryString;
	}
	
	
}