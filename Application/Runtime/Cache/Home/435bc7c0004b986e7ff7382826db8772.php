<?php if (!defined('THINK_PATH')) exit();?><!-- 弹出窗口 -->
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>介绍</title>
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
<div data-role="page" id="page" data-overlay-theme="e">
  <div data-role="header" data-theme="b">
    <h1>简介</h1>
  </div>
  <div data-role="content" data-theme="b" width="100%">
    <h3 style="text-align:center"><?php echo ($data_player["name"]); ?></h3>
	<img src="/twwechat/Function/2016ggstar/Public/images/biglogo/<?php echo ($data_player["voter_id"]); ?>.jpg" width="98%" />
    <pre style="white-space: pre-wrap;"><p style="text-shadow: 0 0;text-indent: 2em;font-size:1.3em;WORD-BREAK: break-all"><?php echo ($data_player["introduce"]); ?>
  </p></pre>
  <br/>
  <!--<p style="text-align:right">主办单位：<?php echo ($data_player["hostnit"]); ?></p>
  <p style="text-align:right">承办单位：<?php echo ($data_player["organizers"]); ?></p>-->
    <a data-role="button" data-rel="back" data-theme="d">返回</a>
  </div>

  <div data-role="footer" data-theme="b">
    <h1>共青团东莞理工学院委员会</h1>
  </div>
</div>
</body>
</html>