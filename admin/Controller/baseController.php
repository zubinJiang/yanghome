<?php
class baseController {

    function __construct(){

        //require(MODEL_DIR.'userModel.php');
        //$this->user = new userModel();
        
        require(LIBS_DIR.'Smarty.class.php');
        
        $path= "saemc://".VILEW_DIR."templates_c";//使用MC Wrapper
        
        mkdir($path);
        
        $this->smarty = new Smarty();  

        $this->smarty->template_dir = VILEW_DIR."templates"; 

        $this->smarty->compile_dir = $path; //设置编译目录 
    
    } 
}
