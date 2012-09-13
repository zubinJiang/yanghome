<?php
/**
 * @author ����㹤����
 * @version v1.0
 * @copyright 2010
 * 
 * @todo ����֤
 * 
 */
class CValid
{
    public static function valid($str, $reg)
	{
		return preg_match($reg, $str);
	}
	
    /**
	* �����ʼ�
	* 
	* @param string $str
	*/
	public static function isEmail ($str)
	{
		return preg_match("/^[\w\-_\.]+@[\w\-_]+(\.[\w\-_]+)+$/i", $str);
	}
	
	/**
	* �绰
	* 
	* @param string $str
	*/
	public static function isTel($str)
	{
		return preg_match("/^(0?\d{2,3})?\-?\d{7,8}(\-\d+)?$/i", $str);
	}
	
	public static function isFreeTel($str)
	{
		return preg_match("/^(400|800)[0-9-]+$/i", $str);
	}
	
	/**
	* �ֻ���
	* 
	* @param string $str
	*/
	public static function isMobile($str)
	{
		return preg_match("/^(13|15|18)\d{9}$/i", $str);
	}
	
	/**
	* Ӣ��
	* 
	* @param string $str
	*/
	public static function isEn($str)
	{
		return preg_match("/^[a-zA-Z]$/", $str);
	}
	
	/**
	* ����
	* 
	* @param string $str
	* @param string $encoding
	*/
	public static function isCh($str, $encoding = 'GBK')
	{
		if ($encoding == 'GBK') {
			$reg = "/^[\xa0-\xff]+$/";
		} else if ($encoding == 'UTF-8') {
			$reg = "/^[\xe0-\xef][\x80-\xbf]+$/";
		}
		return preg_match($reg, $str);
	}
	
	/**
	* URL
	* 
	* @param string $str
	*/
	public static function isUrl($str)
	{
		return preg_match("/^(http\:\/\/)?\w+(\.\w+)\/?/i", $str);
	}
	
	/**
	* �ʱ��ַ
	* 
	* @param string $str
	*/
	public static function isPostcode($str)
	{
		return preg_match("/^\d{6}$/", $str);
	}
}