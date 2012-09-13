<?php
/**
 * @author ����㹤����
 * @version v1.0
 * @copyright 2010
 * 
 * @todo Ŀ¼���ļ�������,ֻ�ǹ������ķ�װ
 * 
 */
class CDir
{
    /*
	* ���������ϵͳ��ͬ���������·������
	* @param string $dir �ļ���·��
	* @return 
	*/
    public static function fix($dir)
    {
        return str_replace( array('\\', DIRECTORY_SEPARATOR), '/', $dir);
        //return rtrim($dir, '/') . '/';
    }
    
    /*
	 * ��ȡĿ¼�ļ��б�
	 * @param string $path �ļ���·��
	 * @param string $type ���ͣ������"file"ֻ��ȡ�ļ���"dir"��ֻȡĿ¼������ֵ���ж��ܻ�ȡ
	 * @param bool   $recurse �Ƿ�ݹ��ȡ��Ŀ¼
	 * @param bool   $fullpath ����·�� OR ���·��
	 * @return Value or NULL 
	 */
    public static function listDir ($path, $type='file', $recurse=false, $fullpath=false) 
    {
        $results = array();
        clearstatcache();
        $path = self::fix($path);
        $path = ('/' == substr($path,-1)) ? $path : $path.'/';
		$dir = @opendir($path);
        if ($dir) {
            while ($file = readdir($dir)) {
                if (empty($file) || '.' == $file || '..' == $file) continue;
                if (is_dir($path.$file)) {
                    if ($recurse) {
                        $results = array_merge($results, self::listDir($path.$file, $type, $recurse, $fullpath));
                    }
                    if ($type == 'file') continue;
                }else if ($type == 'dir') continue;
                if ($fullpath) $results[] = $path.$file;
                else $results[] = $file;
            }
            closedir($dir);
        }
        return $results;
    }
    
    /*
	 * ����Ŀ¼
	 * @param string $dir Ŀ¼
	 * @return 
	 */
    public function mkDir ($dir, $mode = 0755, $recursive = false) 
    {
        $dir = self::fix($dir);
        if (is_dir($dir) && is_writable($dir)) return true;
		$result = mkdir($dir, $mode, $recursive);
		return $result;
    }
    
     /*
	 * ·���Ƿ������Ŀ¼����
	 * @param string $dir ·��
	 * @return array() �ϼ�Ŀ¼��Ŀ¼����
	 */
    protected static function _containDir ($dir) 
    {
        $dirs = preg_split('*[/|\\\]*', $dir);
        for ($i = count($dirs)-1; $i >= 0; $i--) {
            $text = trim($dirs[$i]);
            unset($dirs[$i]);
            if ($text) break;
        }
        $result2 = count($dirs);
        $result1 = implode('/',$dirs).($result2 > 1 ? '' : '/');
        
        return array($result1, $result2);
    }
}

class CFile
{
    /*
	 * ȡ���ļ���׺��
	 * @param string $file ·��
	 * @return ��׺��
	 */
    public static function ext($file) 
    { 
        $extend = pathinfo($file); 
        $extend = strtolower($extend["extension"]); 
        return $extend; 
    } 
}