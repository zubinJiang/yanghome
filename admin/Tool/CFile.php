<?php
/**
 * @author 零起点工作室
 * @version v1.0
 * @copyright 2010
 * 
 * @todo 目录，文件管理类,只是管理函数的封装
 * 
 */
class CDir
{
    /*
	* 修正因操作系统不同，而引起的路径差异
	* @param string $dir 文件的路径
	* @return 
	*/
    public static function fix($dir)
    {
        return str_replace( array('\\', DIRECTORY_SEPARATOR), '/', $dir);
        //return rtrim($dir, '/') . '/';
    }
    
    /*
	 * 获取目录文件列表
	 * @param string $path 文件的路径
	 * @param string $type 类型，如果是"file"只获取文件，"dir"则只取目录，其他值所有都能获取
	 * @param bool   $recurse 是否递归获取子目录
	 * @param bool   $fullpath 绝对路径 OR 相对路径
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
	 * 创建目录
	 * @param string $dir 目录
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
	 * 路径是否包含多目录级别
	 * @param string $dir 路径
	 * @return array() 上级目录；目录级别
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
	 * 取得文件后缀名
	 * @param string $file 路径
	 * @return 后缀名
	 */
    public static function ext($file) 
    { 
        $extend = pathinfo($file); 
        $extend = strtolower($extend["extension"]); 
        return $extend; 
    } 
}