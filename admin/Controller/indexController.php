<?php
require('baseController.php');
class indexController extends baseController {

    function __construct(){
        baseController :: __construct(); 
    } 

    function indexAction(){
        //$user = $this->user->getCode(); 
        
        $this->smarty->assign("index", "welcome to , yanghome ! "); 

        @$this->smarty->display("index.tpl");
    }

}
