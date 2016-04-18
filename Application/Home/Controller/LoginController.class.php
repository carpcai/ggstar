<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function index() {

      if($_GET['openid'])
      {
        $wechat = M('wechat','tw_');
        $is_login=$wechat->where("openid='".$_GET['openid']."'")->find();
        if($is_login)
        {
          if($is_login['student_id'])
          {
            $this->success('你已经登陆过了呢！',U('Home/Index/close'),2);
          }
          else {
            $this->display();
          }

        }
        else {
          $this->error('打开失败，请关注“莞工青年”公众号<br/>发送报名， 并重新打开链接。');
        }
      }
      else {
        //$this->success('登陆成功！',U('Home/Index/index'));
        $this->error('打开失败，请关注“莞工青年”公众号<br/>发送报名， 并重新打开链接。');
      }

		// if($_GET['openid_and_time'])
		// {
		// 	$encrytedString = $_GET['openid_and_time'];
		// 	$string = base64_decode($encrytedString);
		// 	$explodeArray = explode("!!!", $string);
		// 	$wechat = M('db_name.wechat','tw_');
		// 	// $wechat = M('wechat');
		// 	// 读取数据
		// 	$data = $wechat->find($explodeArray[0]);
		// 	if($data)
		// 	{
		// 		$data['openid']=$_GET['openid'];
		// 		$this->assign('data',$data);
		// 		$this->display();
		// 	}
		// 	else
		// 	{
		// 		$this->error('打开失败，请关注“莞工青年”公众号<br/>发送报名， 并重新打开链接。');
		// 	}
		// }
		// else
		// {
		// 	$this->error('打开失败，请关注“莞工青年”公众号<br/>发送报名， 并重新打开链接。');
		// }
	}

	public function Login(){
		if (IS_POST)
		{
		$data['student_id'] = $_POST['student_id'];
		//$data['password'] = $_POST['password'];
		$data['password']=base64_encode($_POST['password']."!!tw");
      $DGUTstate=$this->check_Password($data['student_id'],$_POST['password']);
      if($DGUTstate)
      {
    		$wechat = M('wechat','tw_');
        //$_SESSION["Account"]=$data['student_id'];
        if($wechat->where("openid='".$_POST['openid']."'")->save($data))
        {
          $this->success('登陆成功！',U('Home/Index/close'),2);
        }
        else {
          $this->error('登陆失败，请检查账号密码');
        }
      }
      else {
        $this->error('登陆失败，请检查账号密码');
      }
		// 	$data['student_id'] = $_POST['student_id'];
		// 	$data['password'] = md5($_POST['password']);
		// 	$DGUTstate=$this->check_Password($_POST['student_id'],$_POST['password']);
		// 	$wechat = M('db_name.wechat','tw_');
		// 	if($wechat->create($data)&&$DGUTstate){
		// 		if ($wechat->where("openid='".$_POST['openid']."'")->save($data)) {                      //数据写入
		// 		//$this->success('登陆成功！',U('Home/Index/index','openid='.$_GET['openid']),2);
    // 			    redirect(U('Home/Index/index/','openid='.$_POST['openid']), 0, '页面跳转中...');
    // 			}else{
		// 			$this->error('登陆失败，请再尝试一次');
    // 				//redirect(U('Home/Result/index/','state=Size_up_error'), 0, '页面跳转中...');
    // 			}
    // 		}else {
    // 			$this->error('登陆失败，请检查账号密码'.$DGUTstate);
    // 		}
		 }
	}

	public function check_Password($UserID,$Password){
		import('Vendor.phpRPC.simple_html_dom');
		$html = new \simple_html_dom();
		$ch = curl_init();
		// 设置URL和相应的选项
		header("Content-Type:text/html;charset=utf-8");
		$options= array(CURLOPT_URL => 'http://jwxt.dgut.edu.cn/jwweb/cas_dglg.aspx',
					 CURLOPT_USERAGENT=>'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)',
					 CURLOPT_HEADER => true,
					 CURLOPT_RETURNTRANSFER=>true,
					 CURLOPT_FOLLOWLOCATION=>true,
					 CURLOPT_SSL_VERIFYPEER=>false
					 );
		curl_setopt_array($ch, $options);

		$result=curl_exec($ch);
		$html->load($result);
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $m);
		$session=$m[1][0];
		$cookie=$m[1][1];
		$array=$html->find('input[name=__RequestVerificationToken]');
		@$__RequestVerificationToken=urlencode($array[0]->value);
		//echo $__RequestVerificationToken[2]."sdsd";
		//file_put_contents("test.txt",$result);
		//var_dump($m);
		if(curl_errno($ch))
		{
			die('请求超时');
		}
		$options = array(CURLOPT_URL => 'https://cas.dgut.edu.cn/User/Login?ReturnUrl=%2f%3fappid%3djwxt&appid=jwxt',
                 CURLOPT_HEADER => true,
                 CURLOPT_AUTOREFERER=>true,
                 CURLOPT_RETURNTRANSFER=>1,
                 CURLOPT_ENCODING=>'',
				 CURLOPT_HTTPHEADER=>array('Referer: https://cas.dgut.edu.cn/User/Login?ReturnUrl=%2f%3fappid%3djwxt&appid=jwxt'),
				 CURLOPT_FOLLOWLOCATION=>false,
                 CURLOPT_POST=>true,
				 CURLOPT_SSL_VERIFYPEER=>false,
				 CURLOPT_COOKIE=>$cookie,
                 CURLOPT_USERAGENT=>'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)',
                 @CURLOPT_POSTFIELDS=>'__RequestVerificationToken='.$__RequestVerificationToken."&ReturnUrl=%2F%3Fappid%3Djwxt&UserName=".$UserID."&Password=".$Password,

                );
		curl_setopt_array($ch, $options);
		//echo $options[CURLOPT_POSTFIELDS];
		$result=curl_exec($ch);
		if(strpos($result,"密码必须同时包含字母和数字" )>0)
		die ('密码必须同时包含字母和数字' );
		preg_match('/^Set-Cookie:\s*([^;]*)/mi', $result, $m);
		if(!@$m[1])
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
}
