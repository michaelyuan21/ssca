<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('admin/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/css/admin/vfb2b.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/css/admin/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/css/admin/products.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/css/admin/poper.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/admin/vfb2b.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/admin/list.js"></script>
<!--<script type="text/javascript" src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/admin/products.js"></script>-->
<script type="text/javascript">
$(function(){
    searchRes(1);
    $('#kw').bind('keypress',function(event){
      if(event.keyCode == "13")
          searchRes(1);
  });
});
 
function searchRes(page_id){
  var dataset = {
    kw: $('#kw').val(),
    page: page_id,
  }; 
    
  var url;
  url = "<?php echo url(array('m'=>$MOD, 'c'=>'saints', 'a'=>'newcomer', 'step'=>'search', ));?>";

  $.asynList(url, dataset, function(data){
    if(data.status == 'success'){
      juicer.register('format_date', function(v){return formatTimestamp(v, 'y-m-d<br />h:i:s');});
      $('#rows').append(juicer($('#table-tpl').html(), data));
      $('#rows tr').vdsRowHover();
      $('#rows tr:even').addClass('even');
 //     set_selectAll();
      if(data.paging != null) $('#rows').append(juicer($('#paging-tpl').html(), data));
    }else{
      $('#rows').append("<div class='nors mt5'>未找到相关数据记录...</div>");
    }
  });
}
//翻页
function pageturn(page_id){searchRes(page_id);}
    
function sendWelcomeEmail(){
    var ids = '';
    var objIDs = $("input[name='id']:checked");
    if(objIDs.length == 0){
        $('body').vdsAlert({msg:"请在列表中至少选择一个新到人员."});
        return;
    }
    
    
    objIDs.each(function(index){
        ids += $(this).val() + '_';
    });
    
    var url = "<?php echo url(array('m'=>$MOD, 'c'=>'saints', 'a'=>'sendWelcomeApi', ));?>";
    var dataset = {
        ids:ids,
    }
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: url,
      data: dataset,
      beforeSend: function(){$.vdsLoadingBar(true)},
      success: function(data){$.vdsLoadingBar(false);$('body').vdsAlert({msg:data.msg});},
      error: function(data){
        $.vdsLoadingBar(false);
        $('body').vdsAlert({msg:'处理请求时发生错误'});
      }
    });
}
 

</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>新到人员列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'saints', 'a'=>'editNewcomer', ));?>', 'id')"><i class="edit"></i><font>编辑</font></a>
      <?php if ($_SESSION['ADMIN']['TYPE'] == ADMIN_SUPER) : ?>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'saints', 'a'=>'deleteNewcomer', ));?>', 'id')"><i class="remove"></i><font>删除</font></a>
      <?php endif; ?>
      <a class="ae btn" onclick="sendWelcomeEmail()"><i class="edit"></i><font>发送欢迎电邮</font></a>
    </div>
    <div class="stools mt5">
      <input type="text" class="w300 txt" id="kw" placeholder="输入人员名字或电邮关键词" />
      <button type="button" class="sbtn btn" onclick="searchRes(1)">搜 索</button>
    </div>
    <div class="module mt5" id="rows"></div>
  </div>
</div>

<script type="text/template" id="table-tpl">
<table class="datalist">
  <tr>
    <th width="60" colspan="2"><input class="list_select_all" name="selectall" type="checkbox"  value="" />编号</th>
    <th width="90">姓名</th>
    <th width="100">电话</th>
    <th width="200">电邮</th>
    <th width="200">地址</th>
    <th width="100">介绍人</th>
    <th width="60">受洗</th>
    <th width="160">继续联络</th>
    <th width="100">填表日期</th>
    <th width="100">欢迎邮件</th>
  </tr>
  {@each list as v}
  <tr>
    <td width="20"><input name="id" type="checkbox" value="${v.user_id}" /></td>
    <td width="40">${v.user_id}</td>
    <td >
      ${v.name}
    </td>
    <td>
      ${v.phone}
    </td>
    <td>
      ${v.email}
    </td>
    <td>
      ${v.address}
    </td>
    <td>
      ${v.referral}
    </td>
    <td>${v.baptized_msg}</td>
    <td>${v.contact_msg}</td>
    <td>${v.created_date}</td>
    <td>{@if v.email_sent==1}已发送{@else}未发送{@/if}</td>
  </tr>
  {@/each}
</table>

</script>
<?php include $_view_obj->compile('admin/lib/paging.html'); ?>
<script type="text/javascript" src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/juicer.js"></script>
</body>
</html>