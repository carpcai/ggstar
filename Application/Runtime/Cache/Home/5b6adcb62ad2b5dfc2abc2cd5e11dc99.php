<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <title>莞工中央认证系统登陆页面</title>
  <link rel="stylesheet" href="/twwechat/Function/2016ggstar/Public/css/normalize.css">
  <link rel="stylesheet" href="/twwechat/Function/2016ggstar/Public/css/style_login.css" media="screen" type="text/css" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<script src="/twwechat/Function/2016ggstar/Public/js/script_login.js" type="text/javascript"></script>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideOptionMenu');
});

</script>
</head>
<body>
	<section class="login-form-wrap">
		<h1>中央认证系统登陆页面</h1>
		<form style="margin-top:60px;" class="login-form" method="POST" action="<?php echo U('Login/Login');?>" id="theForm" name="theForm" onSubmit="return chk(this)">
			<label>
				<input type="student_id" name="student_id" required placeholder="学    号">
			</label>
			<label>
				<input type="password" name="password" required placeholder="密    码">
        <input type="hidden" id="openid" name="openid" value="<?php echo ($_GET['openid']); ?>">
			</label>
			<input type="submit" name="submit" id="submit" value="登    录">
		</form>
		<h5 style="margin-top:140px;"><a href="#">技术支持：校团委网络技术部</a></h5>
	</section>
	<div style="text-align:center;clear:both">
<script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
<script src="/follow.js" type="text/javascript"></script>
</div>
</body>

</html>