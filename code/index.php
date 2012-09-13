<?php
include("../application.php");

if($_POST['action']=='add'){
	// add assess
	$id = intval($_REQUEST['id']);
	if(!empty($id)) {
		$_POST['id'] = $id;
 		$rzt  = add($_POST);
    }
    header('Location: http://yanghome.sinaapp.com/code/?'.$id);
}
// select data
$calss_table = 'code_class';
$table = 'code';
$type = get_table($calss_table);
$ids = get_id_data($table);
$getid = end($ids);
$id = !empty($_GET['id']) ? $_GET['id'] : $getid['id'];
$list = get_first_data($table, "where id={$id}");
if($list && $ids){
	foreach($ids as $k=>$v){
		if($list['id']==$v['id']){  
		   $num = $k;  
		} 
	} 
}
$prev_id = $num-1;
$next_id = $num+1;
$prev = get_first_data($table, "where id={$ids[$prev_id]['id']}");
$next = get_first_data($table, "where id={$ids[$next_id]['id']}");

$mess = get_table ("message", "WHERE cid='{$id}'"); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $list['title']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Yang, YangHome, zubinJiang的技术主页, jiangzubin的技术主页, PHP技术blog" />
<meta property="wb:webmaster" content="91063a3e6b61b77d" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../css/base.css" type="text/css" media="screen"/>
<title>JiangYang Code.</title>
<style>
body{width:960px;margin:0 auto;text-align:left;_text-align:center;}

#content{
    width:960px;
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #D8D9D9 #D8D9D9 -moz-use-text-color;
    border-style: solid solid none;
    border-width: 1px 1px medium;
    background-color: #DDDDDD;
    color: #444444;;
    border-radius: 8px 8px 8px 8px;
    background: none repeat scroll 0 0 #F5F5F5;
    border: 1px solid #666666;
    display: inline-block;
    min-height: 410px;
}
.link{
    height:30px;
    border-top: 1px solid #D8D9D9;
    font-size: 12px;
    margin-top: 8px;
    line-height:30px;
}
.title-bar {
    width:958px;
    height: 39px;
    line-height: 39px; 
    font-size: 16px;
    text-shadow: 0 1px 0 #CCCCCC;
    background-position: 0 -1300px;
    background-color: #FC7C01 !important;
    font-weight: bold;
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #D8D9D9 #D8D9D9 -moz-use-text-color;
    border-style: solid solid none;
    border-width: 1px 1px medium;
    background-color: #DDDDDD;
    border-radius: 4px 4px 4px 4px;
    background: none repeat scroll 0 0 #F5F5F5;
    border: 1px solid #666666;
    display: inline-block;
}

.mess{padding:10 20px;}
.mess div {height: 30px; line-height: 30px; }
.mess div span {padding-left:10px; }
.mess div input { border: 1px solid #DDD; background: white; height: 20px; line-height: 20px;}
.foot{height:50px;}
</style>
</head>
<body>
<?php include('../html/header.htm'); ?>
<div id='content'>
    
<div class="title-bar"><span style='padding-left:15px;'><?php  echo $list['title']; ?></span></div>
    <div class='code' style='padding:15px 15px;'>
<?php if(!empty($prev)){?>
    <a href="/code/?id=<?php echo $prev['id']; ?>"><?php echo $prev['title']; ?></a>(上一篇)&nbsp;&nbsp;
<?php } 
      if(!empty($next)){?>
    <a href="/code/?id=<?php echo $next['id']; ?>"><?php echo $next['title']; ?></a>(下一篇)
<?php }?>
	<span style="float:right;"><iframe width="63" height="24" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0" scrolling="no" border="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&width=63&height=24&uid=2049178385&style=1&btn=red&dpc=1"></iframe></span>
<?php if(!empty($list)){
            echo $list['content'];
    }?> 
<?php if(!empty($prev)){?>
    <a href="/code/?id=<?php echo $prev['id']; ?>"><?php echo $prev['title']; ?></a>(上一篇)&nbsp;&nbsp;
<?php } 
      if(!empty($next)){?>
    <a href="/code/?id=<?php echo $next['id']; ?>"><?php echo $next['title']; ?></a>(下一篇)
<?php }?> 
<div class='link'>
<span style='color:blue'>分享到</span>
<script type="text/javascript" charset="utf-8">
(function(){
  var _w = 22 , _h = 16;
  var param = {
    url:location.href,
    type:'3',
    count:'', /**是否显示分享数，1显示(可选)*/
    appkey:'207565941', /**您申请的应用appkey,显示分享来源(可选)*/
    title:'', /**分享的文字内容(可选，默认为所在页面的title)*/
    pic:'', /**分享图片的路径(可选)*/
    ralateUid:'', /**关联用户的UID，分享微博会@该用户(可选)*/
	language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
    rnd:new Date().valueOf()
  }
  var temp = [];
  for( var p in param ){
    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
  }
  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
})()
</script><span>新浪微博</span>&nbsp;&nbsp;&nbsp;&nbsp;

<?php
$url=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<a title="分享到QQ空间" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $url; ?>"><img src="http://qzonestyle.gtimg.cn/ac/qzone_v5/app/app_share/qz_logo.png"></a>&nbsp;<span>QQ空间</span>&nbsp;&nbsp;&nbsp;&nbsp;

<a target="_self" onclick="window.open( 'http://www.douban.com/recommend/?url='+encodeURIComponent(document.location)+'&appkey=&site=&title='+encodeURI(document.title),'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );" title="豆瓣" style="background-position:0 -120px;cursor:pointer;"><img width="17" height="16" src="http://images.51cto.com/files/uploadimg/20110428/145820640.gif"></a>&nbsp;<span>豆瓣</span>&nbsp;&nbsp;&nbsp;&nbsp;

<a href="http://www.kaixin001.com/repaste/share.php?rurl=<?php echo $url; ?>&rtitle=<?php echo $list['title']; ?>" target="_blank"><img src="http://images.51cto.com/images/art1105/images/kx.jpg"></a>&nbsp;<span>开心</span>&nbsp;&nbsp;&nbsp;&nbsp;

<a title="分享到人人网" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $url; ?>&title=<?php echo $list['title']; ?>" target="_blank"><img src="http://images.51cto.com/images/art1105/images/rr.jpg"></a>&nbsp;<span>人人网</span>&nbsp;&nbsp;&nbsp;&nbsp;

    </div>
	<div class="mess">
	<form action="/code/?id=<?php echo $id;?>" method="post">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="action" value="add">
		<div>
			<input type="radio" name="assess" value="1"><span>很好</span>
			<input type="radio" name="assess" value="2"><span>一般</span>
			<input type="radio" name="assess" value="3"><span>很差</span>
		</div>
		<div><input type="text" name="mail" value="" size="30"><span>mail</span></div>
		<div><input type="text" name="qq" value="" size="30"><span>Q  Q</span></div>
		<div><input type="text" name="content" value="" size="30"><span>内容</span></div>
		<div style="padding-left:150px;"><input type="submit" name="submit" value="发表评论"></div>
	</form>
    </div>

    <div class="assess">
        <?php
            if ($mess){
                foreach ($mess as $k=>$v){
                    ?>
                        <div><?php echo ++$k;?>><span>&nbsp;<?php echo $v['name']; ?>讲：</span><?php echo $v['content'];?></div>
                    <?php
                }
            }
        ?>
        
    </div>
</div> 

</div>
<div class='foot'></div>
</body>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7d4a34df8c50630748c2bdb14053785d' type='text/javascript'%3E%3C/script%3E"));
</script>
</html>
