<?php
/**
 * @author ����㹤����
 * @version v1.0
 * @copyright 2010
 * 
 * @todo ���鴦���װ��
 * 
 */
class CArray
{
   /*
	* ����ת�ַ�
	* @param  array ��Ҫת��������
	* @param  $kSep ���ķָ��ʶ
	* @param  $vSep ֵ�ķָ��ʶ
	* @return string ת������ַ� 
	*/
    public static function array2String($arr, $kSep='', $vSep='')
    {
        $result = '';
        if (is_string($arr)) return $arr;
        $arr = (array)$arr;
        if ($arr) foreach ($arr as $_k => $_v) {
            if (is_array($_v)) $result .= $_k. "\n(\n".CArray::array2String($_v, $kSep, $vSep) . ")\n"; //��ά����
            else $result .= $_k.$kSep.$_v.$vSep;
        }
        return $result;
    }
}