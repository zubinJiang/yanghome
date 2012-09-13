<?php
/**
 * @author ����㹤����
 * @version v1.0
 * @copyright 2010
 * 
 * @todo �����࣬���ú���
 * 
 */
class CUtil
{
    /*
	* ��ȡIP��ַ
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
            // �ų�������IP��ַ
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
	 * ȡ������ַ���
	 * @param int $length  �ַ��ĳ���
	 * @param int $numeric ֻ������ʱ�����ֳ���
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
	 * ƴ��URL�������ڵ�ǰ���ӱ任ɸѡ���������� zgm 2012-5-10
	 * @param array $args  url��������
	 * @param int $type ����url�ĸ�ʽ �� Ĭ��0������ʽ
	 * @return url  �����������
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