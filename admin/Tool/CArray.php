<?php
/**
 * @author 零起点工作室
 * @version v1.0
 * @copyright 2010
 * 
 * @todo 数组处理封装类
 * 
 */
class CArray
{
   /*
	* 数组转字符
	* @param  array 需要转换的数组
	* @param  $kSep 键的分割标识
	* @param  $vSep 值的分割标识
	* @return string 转化后的字符 
	*/
    public static function array2String($arr, $kSep='', $vSep='')
    {
        $result = '';
        if (is_string($arr)) return $arr;
        $arr = (array)$arr;
        if ($arr) foreach ($arr as $_k => $_v) {
            if (is_array($_v)) $result .= $_k. "\n(\n".CArray::array2String($_v, $kSep, $vSep) . ")\n"; //多维数组
            else $result .= $_k.$kSep.$_v.$vSep;
        }
        return $result;
    }
}