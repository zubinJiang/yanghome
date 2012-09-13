<?php
/**
 * @author 零起点工作室
 * @version v1.0
 * @copyright 2010
 * 
 * @todo 字符串处理封装类
 * 
 */
class CString
{
    /*
	* 取得中文字符的长度
	* @param string $str 字符
	* @return int 字符的长度 
	*/
    public static function len($string)
    {
        $len = strlen($string);
        $i = 0;
        while ($i<$len) {
    	    if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/", $string[$i])) {
    			$i += 2;
    		 } else {
    			$i += 1;
    		 }
    	    $n += 1;
    	 }
        return $n;
    }
    
    /*
	* 字符串截取
	* @param string $string 字符
	* @return int 字符的长度 
	*/
    public  static function substr($string, $length, $charset = 'gbk') 
    {
		if (strlen($string) <= $length) {
			return $string;
		}
		//$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
		$substr = '';
		if ($charset == 'UTF8') {
			$n = $tn = $noc = 0;
			while ($n < strlen($string)) {
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1; $n++; $noc++;
				} elseif(194 <= $t && $t <= 223) {
					$tn = 2; $n += 2; $noc += 2;
				} elseif(224 <= $t && $t < 239) {
					$tn = 3; $n += 3; $noc += 2;
				} elseif(240 <= $t && $t <= 247) {
					$tn = 4; $n += 4; $noc += 2;
				} elseif(248 <= $t && $t <= 251) {
					$tn = 5; $n += 5; $noc += 2;
				} elseif($t == 252 || $t == 253) {
					$tn = 6; $n += 6; $noc += 2;
				} else {
					$n++;
				}
				if($noc >= $length) {
					break;
				}
			}
			if ($noc > $length) {
				$n -= $tn;
			}

			$substr = substr($string, 0, $n);

		} else {
			for ($i = 0; $i < $length; $i++) {
				$substr .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			}
		}
    	//$substr = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $substr);
		return $substr;
	}
	
	/*
	* 中文首字母
	* @param string $string 字符
	* @return 首字母
	*/
	function firstLetter($string) {
		$dict = array(
        			'a'=>0xB0C4,'b'=>0xB2C0,'c'=>0xB4ED,'d'=>0xB6E9,
        			'e'=>0xB7A1,'f'=>0xB8C0,'g'=>0xB9FD,'h'=>0xBBF6,
        			'j'=>0xBFA5,'k'=>0xC0AB,'l'=>0xC2E7,'m'=>0xC4C2,
        			'n'=>0xC5B5,'o'=>0xC5BD,'p'=>0xC6D9,'q'=>0xC8BA,
        			'r'=>0xC8F5,'s'=>0xCBF9,'t'=>0xCDD9,'w'=>0xCEF3,
        			'x'=>0xD188,'y'=>0xD4D0,'z'=>0xD7F9
    			);
		$letter = substr($string, 0, 1);
		if($letter >= chr(0x81) && $letter <= chr(0xfe)) {
			$num = hexdec(bin2hex(substr($string, 0, 2)));
			foreach ($dict as $k=>$v){
				if($v>=$num)
					break;
				}
				return $k;
		} elseif ((ord($letter)>64&&ord($letter)<91) || (ord($letter)>96&&ord($letter)<123) ){
			return $letter;
		} elseif ($letter>='0' && $letter<='9'){
			return $letter;
		} else {
			return '*';
		}
	}

	/**
	*编码转换
	*/

	public function trantogbk($str)
	{
		if(is_array($str))
		{
			foreach($str as $key=>$row)
			{
				$str[$key] = self::trantogbk($row);
			}
		}
		else
		{
			$str = addslashes(iconv("UTF-8","gbk",$str));
		}
		return $str;
	}
}