<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
  //strtotime()
  public $start_time='2016-04-18 12:00:00';  //投票开始时间
  public $end_time='2016-04-30 00:00:00';   //投票结束时间
  public function index(){
    $useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
    if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false ){
			$this->error('非微信浏览器禁止访问');
		}
    else
    {
      if($_GET['openid'])
      {

        $voter = M('voter');
        $is_vote =$voter->join('tw_wechat ON __VOTER__.student_id=tw_wechat.student_id')->where("openid='".$_GET['openid']."'")->max('time');
        if($is_vote
        &&date('d',time())-date('d',$is_vote)==0)
        {
          redirect(U('Home/Index/result/'), 0, '页面跳转中...');
        }
        else {
          $play_vote = M('play_vote');
        	$groupname = M('group');
        	$groupname=$groupname->cache(true,6000)->select();
        	$group=1;
        	while($groupname[$group-1]){
        		$list[$group] =$play_vote->cache(true,2)->where("voter_group=".$group)->order('count desc')->select();
				$group++;
        	}
          $groupname['openid']=$_GET['openid'];
        	$this->assign('list',$list);
        	$this->assign('groupname',$groupname);
          $this->display();
        }
      }
      else {
        redirect(U('Home/Index/result'), 0, '页面跳转中...');
      }
    }
  }
    //弹出窗口
  public function introduce(){
      $voter_id=$_GET['voter_id'];
      if($voter_id)
      {
        $player = M('player');
        $data_player =$player->where("voter_id=".$voter_id)->find();
        $this->assign('data_player',$data_player);
        $this->display();
      }
    }
	public function voting(){
	//$data['Openid'] = $_POST['Openid'];
      //判断是否有登陆在规定时间内投

    if (IS_POST&&$_POST['openid']) {
      //判断是否投过票
      if(strtotime($this->start_time)<time()&&time()<strtotime($this->end_time))
      {
        $wechat = M('wechat','tw_');
        $voter = M('voter');
        $data=$wechat->where("openid='".$_POST['openid']."'")->find();
        $is_vote = $voter->where("student_id=".$data['student_id'])->max('time');
        if($is_vote
        &&date('d',time())-date('d',$is_vote)==0)
        {
          $this->error('你今天已经投过票了');
        }
        else {
          if($project_vote=$_POST['project_vote'])
		      {
			  //投票者信息
          $data['time']=time();
          $data['vote_id']=$project_vote[0];
          $arr_voter_id[0]=array('eq',$project_vote[0]);
          $tmpcount=1;
          //while($project_vote[$tmpcount]){
			foreach ($project_vote as $values) { 
			if($tmpcount==1)
				$data['vote_id']=$values;
			else
				$data['vote_id']=$data['vote_id'].",".$values;
		
            $arr_voter_id[$tmpcount]=array('eq',$values);
            $tmpcount++;
		    }

          $arr_voter_id[$tmpcount]='or';
          $map['voter_id'] = $arr_voter_id;
          //写入数据库
          $voter->data($data)->add();
          $play_vote = M('play_vote');
          $play_vote->where($map)->setInc('count');

          // $this->ajaxReturn($data);
          //setcookie("votestate", "1", time()+20);
          $this->success('投票成功！',U('Home/Index/result'),2);
          //把数据显示在视图上
          //  $this->assign('data',$data);
          //  $this->display();
		      }
    		  else{
    			  $this->error('你还没做出选择喔~');
    		  }
        }
      }
      else {
        $this->error('投票已截止');
      }
    }
    else
    {
      $this->error('投票失败，请重新登陆');
    }

			// $weixin = M('weixin');
			// if($weixin->create($data)){
				// if ($weixin->where("Openid='".$_POST['Openid']."'")->save($data)) {                      //数据写入
				// $this->success('登陆成功！',U('Home/Index/index','Openid='.$_GET['Openid']),2);
    			    // redirect(U('Home/Index/index/','Openid='.$_POST['Openid']), 0, '页面跳转中...');
    			// }else{
					// $this->error('登陆失败，请再尝试一次');
    				// redirect(U('Home/Result/index/','state=Size_up_error'), 0, '页面跳转中...');
    			// }
    		// }else {
    			// $this->error('登陆失败，请检查账号密码'.$DGUTstate);
    		// }
	}
  public function result(){
    $play_vote = M('play_vote');
    $groupname = M('group');
    $sum_vote=$play_vote->cache(true,2)->sum('count');
    $groupname=$groupname->cache(true,6000)->select();
    $group=1;
    while($groupname[$group-1]){
      $list[$group] =$play_vote->cache(true,2)->where("voter_group=".$group)->order('count desc')->select();
      $group++;
    }
    $this->assign('list',$list);
    $this->assign('groupname',$groupname);
    $this->assign('sum_vote',$sum_vote);
    $this->display();

    }

}
