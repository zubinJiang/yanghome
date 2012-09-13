<?php 
/**
 * @author 零起点工作室
 * @version v1.0
 * @copyright 2010
 * 
 * @todo 计时通用类，用于性能调优
 * 
 */
class CTimer {
    /**
    * @var float  计时开始标记
    */
    private $_start = 0;
    
    /**
    * @var string  用途标记文本
    */
    private $_prefix = '';

    function __construct ( $prefix='' ) 
    {
        $this->_start = $this->_getmicrotime();
        $this->_prefix = $prefix;
    }

    /*
	* 重置计时
	*/
	public function reset () 
	{
		$this->_start = $this->_getmicrotime();
	}

	/*
	* 标记文本
	*/
    public function mark( $label, $num=3) 
    {
        return sprintf ( "\n$this->_prefix %.{$num}f $label", $this->_getmicrotime() - $this->_start );
    }

    /*
	* 取消耗时间
	*/
    public function getElapsed () 
    {
    	return $this->_getmicrotime() - $this->_start;
    }

    /*
	* 取计时开始时间
	*/
    public function getStartTime () 
    {
    	return $this->_getmicrotime() - $this->_start;
    }
    
    private function _getmicrotime()
    {
        list($usec, $sec) = explode(" ",microtime());
        return ((float)$usec + (float)$sec);
    }
}