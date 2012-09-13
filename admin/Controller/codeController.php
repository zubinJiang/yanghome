<?php
require('baseController.php');
class codeController extends baseController {

    function __construct(){
        baseController :: __construct();
        
        require(MODEL_DIR.'codeModel.php');
        $this->code = new codeModel();
        
    } 


    function createCKEditor(){
        
        require(CKEDITOR_DIR.'ckeditor_php5.php');

        $CKEditor= new CKEditor();   //实例化FCKeditor对象  

        $CKEditor->config['height'] = 300;  
        $CKEditor->config['width'] = 870;  
        $CKEditor->config['uiColor'] = '#f6f6f2';//背景颜色  
        $CKEditor->config['toolbarLocation'] = 'top';//  
        $CKEditor->config['toolbar'] = array(  
            array( 'Font','FontSize', 'Bold', 'Italic', 'Underline','TextColor'),  
            array(  'JustifyLeft','JustifyCenter','JustifyRight'),  
            array( 'Smiley','Image'),  
             
            );  
        $CKEditor->config['toolbar'] ='Full';//可以显示全部功能按钮  
        $CKEditor->returnOutput = true; //返回生成的HTMl代码，默认为FALSE，只是输出  
        $html=$CKEditor->editor("content", "请输入。。。",$config);//也可以初始化内容  

        //@$html=$CKEditor->editor();//创建在线编辑器html代码字符串,并赋值给字符串变量$html. 

        return $html;

    }

    function addAction(){ 

        $code = $this->code->getCodeClass();
    
        $this->smarty->assign('code', $code); 

        $html = $this->createCKEditor();

        $this->smarty->assign('html',$html);//将$html的值赋给模板变量$html.在模板里通过{$CKeditor}可以直接引用。 

        @$this->smarty->display('addCode.tpl');

    }


	function addprocessAction(){

        if(empty($_POST)){ return; }

        $data = array(
            'type'    => $_POST['class'],
            'title'   => $_POST['title'],
            'content' => $_POST['content'],
            'datetime'=> date('Y-m-d H:i:s',time())
        );


        var_dump($_POST['content']);
        exit;
        $code = $this->code->addData($data, 'code');

        if($code){
            exit("add,ok!<a href='/admin/index.php'>yanghome.sinaapp.com/admin</a>");
        } else {
            exit("add,no!<a href='/admin/index.php'>yanghome.sinaapp.com/admin</a>");
        }
    }


   function manageAction(){

       $data = $this->code->getCodeData();

       @$this->smarty->display('manageCode.tpl');

       var_dump($data);

   }
}
