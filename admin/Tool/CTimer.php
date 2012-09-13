<?php 
/**
 * @author ����㹤����
 * @version v1.0
 * @copyright 2010
 * 
 * @todo ��ʱͨ���࣬�������ܵ���
 * 
 */
class CTimer {
    /**
    * @var float  ��ʱ��ʼ���
    */
    private $_start = 0;
    
    /**
    * @var string  ��;����ı�
    */
    private $_prefix = '';

    function __construct ( $prefix='' ) 
    {
        $this->_start = $this->_getmicrotime();
        $this->_prefix = $prefix;
    }

    /*
	* ���ü�ʱ
	*/
	public function reset () 
	{
		$this->_start = $this->_getmicrotime();
	}

	/*
	* ����ı�
	*/
    public function mark( $label, $num=3) 
    {
        return sprintf ( "\n$this->_prefix %.{$num}f $label", $this->_getmicrotime() - $this->_start );
    }

    /*
	* ȡ����ʱ��
	*/
    public function getElapsed () 
    {
    	return $this->_getmicrotime() - $this->_start;
    }

    /*
	* ȡ��ʱ��ʼʱ��
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