<?php 
    /**
     * @author       jiangzubin
     * @mail/gtalk   jiangzubin1989@gmail.com
     * @hotmail      jiangzubin1989@hotmail.com
     * @weibo        weibo.com/yangpage
     * @datatime     2012-8-2 16:37:42
     * @to do        into file
     */

	//define  constants
    header("Content-type: text/html; charset=utf-8");
    define("ROOT_DIR", dirname(str_replace('\\', '/' ,__FILE__)).'/');
	define("INCLUDE_DIR", str_replace('/admin/index.php','',(str_replace('\\', '/' ,__FILE__)).'/').'include/');
    define("CONTROLLER_DIR", ROOT_DIR.'Controller/');
    define("MODEL_DIR", ROOT_DIR.'Model/');
    define("VILEW_DIR", ROOT_DIR.'View/');

    define("LIBS_DIR", INCLUDE_DIR.'libs/');
    define("CKEDITOR_DIR", INCLUDE_DIR.'ckeditor/');


	//if ($_GET['type']!='xdebug') return;
 
	//autoloader common class

    /**
    * @var 系统类注册  
    */
    $regClass = array(
		//Tool
		''
	); 
    
	
    /**
     * 实现系统的autoload方法
     */
	function autoLoad($className) {

        //pass
    }


	$controller = empty($_GET['c']) ? 'index' : $_GET['c'];
	$action = empty($_GET['a']) ? 'index' : $_GET['a'];
	$class_file = $controller.'Controller.php';
  
	if(file_exists(CONTROLLER_DIR.$class_file)){

		require(CONTROLLER_DIR.$class_file);
		
		$class_name = $controller.'Controller';

		$obj = new $class_name();

		$action_name = $action.'Action';
		
		if($action_name){
			$obj->$action_name();
		} else {
			exit('Action no');
		}
	} else {
		exit('Controller no');
	}
?>
