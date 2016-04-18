<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>加载中</title>
<link rel="stylesheet" href="/twwechat/Function/2016ggstar/Public/Css/jquery.mobile-1.4.5.min.css" />
<link rel="stylesheet" href="/twwechat/Function/2016ggstar/Public/Css/jquery.mobile.theme.css" />
<link rel="stylesheet" href="/twwechat/Function/2016ggstar/Public/Css/swatches.css" />

<!-- jQuery -->
<script src="/twwechat/Function/2016ggstar/Public/js/jquery-1.8.3.min.js"></script>
<script src="/twwechat/Function/2016ggstar/Public/js/jquery.mobile-1.4.5.min.js"></script>

<script>
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideOptionMenu');
</script>

</head>
<body>
	<!-- 第一页 -->
  <!-- 第一页 -->
<div data-role="page" id="pageone" data-theme="d">
  <div data-role="header" data-position="fixed" data-fullscreen="true" 
>
	<!--<a class="ui-right" style="background:#de533c;border-radius: 0 0 5px 5px;top:-4px;border:0;"><img src="/twwechat/Function/2016ggstar/Public/images/logo.png" /></a>-->
	<h1>莞工之星</h1>
</div>
<!-- /header -->

  <br /><br />
  <div data-role="content">
    <img src="/twwechat/Function/2016ggstar/Public/images/home1.jpg" width=100% />
<?php $count=0;$themeid='d'; ?>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><fieldset data-role="collapsible" data-theme="<?php echo ($themeid); ?>">
  <legend><?php echo ($groupname[$count]["group"]); ?></legend>
  <div class="ui-grid-a ui-title">
  <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if(($mod) == "0"): ?><div class="ui-block-a"><a href="<?php echo U('Index/introduce','voter_id='.$data[voter_id]);?>" data-rel="dialog"><img src="/twwechat/Function/2016ggstar/Public/images/logo/<?php echo ($data["voter_id"]); ?>.jpg" width=95% /><?php echo ($data["name"]); ?><br /></a></div><?php endif; ?>
  <?php if(($mod) == "1"): ?><div class="ui-block-b"><a href="<?php echo U('Index/introduce','voter_id='.$data[voter_id]);?>" data-rel="dialog"><img src="/twwechat/Function/2016ggstar/Public/images/logo/<?php echo ($data["voter_id"]); ?>.jpg" width=95% /><?php echo ($data["name"]); ?><br /></a></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><!-- /grid-b -->
  </fieldset>
  <?php $count++;$themeid++; ?>
  <br /><?php endforeach; endif; else: echo "" ;endif; ?>
  <br /><br /><br />
  <div style="bottom:0;position:absolute;width:100%;background-color: #f7f8ed;border-top: 1px solid #ccc;">
	<div style="position:absolute;margin:2.7% 0 0 5%;">
	<a style="background:#de533c;border-radius:6px 6px 0 0;padding:16% 8% 8.5% 8%;border:0;"><img width=50% src="/twwechat/Function/2016ggstar/Public/images/logo.png" style="vertical-align:baseline"/></a></div>
	<div style="float:right;margin:0 13% 0 20%;">
	<p style="font-size:0.8em;color:#333;text-align:center;margin:0.7em">主办单位：校团委宣传部<br />
924155240@qq.com</p>
	</div>
</div>
<!-- /support -->

</div>
<div data-role="footer" data-position="fixed" data-fullscreen="true">
    <div data-role="navbar">
        <ul>
        <li>
            <a <?php if(1 == 1 ): ?>class="ui-btn-active"<?php endif; ?> href="#pageone" data-icon="grid" data-transition="none">介绍</a>
        </li>
        <li>
            <a <?php if(1 == 2 ): ?>class="ui-btn-active"<?php endif; ?> href="#pagetwo" data-icon="heart" data-transition="none">投票</a>
        </li>
        <li>
            <a <?php if(1 == 3 ): ?>class="ui-btn-active"<?php endif; ?> href="#pagethree" data-icon="star" data-transition="none">规则</a>
        </li>
        </ul>
    </div>
</div>
<!-- /navbar -->

</div>


	<!-- 第二页 -->
	<div data-role="page" id="pagetwo" data-theme="e">
	<div data-role="header" data-position="fixed" data-fullscreen="true" 
>
	<!--<a class="ui-right" style="background:#de533c;border-radius: 0 0 5px 5px;top:-4px;border:0;"><img src="/twwechat/Function/2016ggstar/Public/images/logo.png" /></a>-->
	<h1>投票</h1>
</div>
<!-- /header -->

	  <br /><br />
    <div data-role="content">
	  <form method="post" action="<?php echo U('Index/voting');?>" id="twform" data-ajax="false">
	  <?php $count=0;$themeid='d'; ?>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><br/>
		<fieldset data-role="collapsible" data-theme="<?php echo ($themeid); ?>">
		<legend><?php echo ($groupname[$count]["group"]); ?></legend>
		<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><label for="<?php echo ($data["voter_id"]); ?>"><?php echo ($data["name"]); ?><span class="ui-li-count"><?php echo ($data["count"]); ?></span></label>
		<input type="radio" name="project_vote[<?php echo ($count); ?>]" id="<?php echo ($data["voter_id"]); ?>" value="<?php echo ($data["voter_id"]); ?>" data-theme="a"><?php endforeach; endif; else: echo "" ;endif; ?>
		</fieldset>
	  <?php $count++;$themeid++; endforeach; endif; else: echo "" ;endif; ?>
	  <div style="text-align:center;">
	  <br/><br/>
      <input type="submit" data-inline="false" id="btn_post" value="提交" on-clic>
      <input type="hidden" id="openid" name="openid" value="<?php echo ($groupname["openid"]); ?>">
	  </div>
	  <br /><br /><br />
    </form>
	<div style="bottom:0;position:absolute;width:100%;background-color: #f7f8ed;border-top: 1px solid #ccc;">
	<div style="position:absolute;margin:2.7% 0 0 5%;">
	<a style="background:#de533c;border-radius:6px 6px 0 0;padding:16% 8% 8.5% 8%;border:0;"><img width=50% src="/twwechat/Function/2016ggstar/Public/images/logo.png" style="vertical-align:baseline"/></a></div>
	<div style="float:right;margin:0 13% 0 20%;">
	<p style="font-size:0.8em;color:#333;text-align:center;margin:0.7em">主办单位：校团委宣传部<br />
924155240@qq.com</p>
	</div>
</div>
<!-- /support -->

	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
    <div data-role="navbar">
        <ul>
        <li>
            <a <?php if(2 == 1 ): ?>class="ui-btn-active"<?php endif; ?> href="#pageone" data-icon="grid" data-transition="none">介绍</a>
        </li>
        <li>
            <a <?php if(2 == 2 ): ?>class="ui-btn-active"<?php endif; ?> href="#pagetwo" data-icon="heart" data-transition="none">投票</a>
        </li>
        <li>
            <a <?php if(2 == 3 ): ?>class="ui-btn-active"<?php endif; ?> href="#pagethree" data-icon="star" data-transition="none">规则</a>
        </li>
        </ul>
    </div>
</div>
<!-- /navbar -->

  </div>

	<!-- 第三页 -->
	<div data-role="page" id="pagethree" data-theme="b">
<div data-role="header" data-position="fixed" data-fullscreen="true" 
>
	<!--<a class="ui-right" style="background:#de533c;border-radius: 0 0 5px 5px;top:-4px;border:0;"><img src="/twwechat/Function/2016ggstar/Public/images/logo.png" /></a>-->
	<h1>规则</h1>
</div>
<!-- /header -->

  <br /><br />
  <div data-role="content">
  <div>
  <iframe align="middle" src="http://mp.weixin.qq.com/s?__biz=MjM5MTQ2ODI2NQ==&mid=2652823781&idx=1&sn=d93a72e93695dbd6fbc81c58ed1a32f6&scene=1&srcid=0417skkC2fXkhFKl4D0RteVX" width="100%" height="500"></iframe></div>
  <br/><br/><br/><br/><br/>
<div style="bottom:0;position:absolute;width:100%;background-color: #f7f8ed;border-top: 1px solid #ccc;">
	<div style="position:absolute;margin:2.7% 0 0 5%;">
	<a style="background:#de533c;border-radius:6px 6px 0 0;padding:16% 8% 8.5% 8%;border:0;"><img width=50% src="/twwechat/Function/2016ggstar/Public/images/logo.png" style="vertical-align:baseline"/></a></div>
	<div style="float:right;margin:0 13% 0 20%;">
	<p style="font-size:0.8em;color:#333;text-align:center;margin:0.7em">主办单位：校团委宣传部<br />
924155240@qq.com</p>
	</div>
</div>
<!-- /support -->

</div>
<div data-role="footer" data-position="fixed" data-fullscreen="true">
    <div data-role="navbar">
        <ul>
        <li>
            <a <?php if(3 == 1 ): ?>class="ui-btn-active"<?php endif; ?> href="#pageone" data-icon="grid" data-transition="none">介绍</a>
        </li>
        <li>
            <a <?php if(3 == 2 ): ?>class="ui-btn-active"<?php endif; ?> href="#pagetwo" data-icon="heart" data-transition="none">投票</a>
        </li>
        <li>
            <a <?php if(3 == 3 ): ?>class="ui-btn-active"<?php endif; ?> href="#pagethree" data-icon="star" data-transition="none">规则</a>
        </li>
        </ul>
    </div>
</div>
<!-- /navbar -->

</div>
  </body>
</html>