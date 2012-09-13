<?php
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Yang, YangHome, zubinJiang, jiangzubin, zubinJiang的技术主页, jiangzubin的技术主页, PHP技术blog" />
<meta property="wb:web
<link rel="shortcut icon" href="images/favicon.ico" />
<title>JiangYang personal HomePage.</title>
<style>
body{width:100%;margin:0 auto;font-size:14px;background: url("./images/body2.gif") repeat;font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;font-size: 13px;}
#index{width:100%;height:100%;}
.content{width:80%;height:75%;float:left;text-align:center;}
.daohang{width:20%;height:75%;float:right;}
.daohang ul li{height:45px;line-height:45px;color:#FF9900;}
.daohang ul li a{color:red;outline:none;}
.foot{width:100%;clear:both;color:#FFF;text-align:center;}
.foot a{line-height:30px;outline:none;}
</style>
</head>
<script src="http://app.baidu.com/static/appstore/monitor.st"></script>
<script src="./js/jquery-1.6.js"></script>
<script src=" http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=3168919025" type="text/javascript"></script>
<script LANGUAGE="JavaScript">
function login(){
    var code_ = window.prompt("请输入您的通行码","");

	
	if(code_==null || !code_){ return false; }
	
    $.get("./login.php",{action:'admin', code:code_},function(data){
        if(data){
            location.href='/admin/';   
        }else{
            alert('通行码有误，无权访问!');
        }
	}); 
    
    return false;
}
function inputdata(){
    var print = 0;
    print = document.getElementById('print').value;
    var arr = 'I am phper ! My name id JiangYang !  This is my personal homepage ! <br/> <br> <br> <br> Hopefully we can learn together technology !';
    var str = arr.split(' ');
    if(str.length-1<print){
        return false;
    }
    var strs = document.getElementById('content').innerHTML;
    strs += str[print];
    document.getElementById('content').innerHTML=strs+'&nbsp;&nbsp;'; 
    document.getElementById('print').value = ++print;
}
function get(){ 
    window.setInterval('inputdata()',250);
    window.setInterval('showTime()',1000);
}
function showTime(){
    var datetime = (new Date()).pattern("yyyy-MM-dd hh:mm:ss EEE");
    document.getElementById('login').innerHTML=datetime; 
}
Date.prototype.pattern=function(fmt) {        
    var o = {        
    "M+" : this.getMonth()+1, //月份        
    "d+" : this.getDate(), //日        
    "h+" : this.getHours()%12 == 0 ? 12 : this.getHours()%12, //小时        
    "H+" : this.getHours(), //小时        
    "m+" : this.getMinutes(), //分        
    "s+" : this.getSeconds(), //秒        
    "q+" : Math.floor((this.getMonth()+3)/3), //季度        
    "S" : this.getMilliseconds() //毫秒        
    };        
    var week = {        
    "0" : "\u65e5",        
    "1" : "\u4e00",        
    "2" : "\u4e8c",        
    "3" : "\u4e09",        
    "4" : "\u56db",        
    "5" : "\u4e94",        
    "6" : "\u516d"       
    };        
    if(/(y+)/.test(fmt)){        
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));        
    }        
    if(/(E+)/.test(fmt)){        
        fmt=fmt.replace(RegExp.$1, ((RegExp.$1.length>1) ? (RegExp.$1.length>2 ? "\u661f\u671f" : "\u5468") : "")+week[this.getDay()+""]);        
    }        
    for(var k in o){        
        if(new RegExp("("+ k +")").test(fmt)){        
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));        
        }        
    }        
    return fmt;        
}       

</script>
<body onload="get();">
<input type='hidden' name='print' id='print' value='0'>
<div id='index'>
    <div class='login' style='color:#FFF;text-align:center;padding-top:20px;'>
        Beijing time ：<a href="http://yanghome.sinaapp.com/html/Clock.html" target="_blank">
        <span id='login' style='color:red;'><?php echo date("Y-m-d H:i:s 星期w"); ?></span></a>
        <span style='padding-left:100px;'>Welcome to <strong style='color:red;'> , <b style='color:#E9B000;'>Yang home</a></b></span>
    </div> 
    <div class='content'><div style='height:35%;'>&nbsp;</div><div id='content' style='color:red;padding-left:200px;'>&nbsp;</div></div>
    <div class='daohang'>
    <ul style='padding-top:50px;'>
        <li><a href='/code/'  title='技术中心'>技术中心</a><span></span></li>
        <li><a href='/share/' title='共享中心'>共享导航</a><span></span></li>
        <li><a href='page.php'  title='个人主页'>个人主页</a><span></span></li>
		<li><a href='/about/' title='关于我'>关于我</a><span></span></li>
        <li><a href='photo.php' title='图片库'>图片库</a><span></span></li>
        <li><a href='bbs.php' title='论坛'>论坛</a><span></span></li>
        <li><a href='/' title='首页'>首页</a><span></span></li>
    </ul>
    </div>
    <div class='foot'>
        <h5>My name id JiangYang. This is my personal homepag. I decide.</h5>
        <a href='/code/'>点击进入</a>>>>
    </div>
</div>
</body>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7d4a34df8c50630748c2bdb14053785d' type='text/javascript'%3E%3C/script%3E"));
</script>
</html>
