{include file="header.tpl"}
<div><a href="index.php">返回首页</a></div><br/>
<form action="index.php?c=code&a=addprocess" method="post">
    <div>选择分类：<select name='class'>
        {foreach from=$code item=item}
            <option value='{$item.id}'>{$item.name}</option>
        {/foreach}
    </select></div><br>

    <div>标题：<input type='text' name='title' value=''></div><br>

    <div>内容：<br>{$html}</div><br/>
    <div><input type='submit' value='提交'/></div>
</form>
{include file="footer.tpl"}
