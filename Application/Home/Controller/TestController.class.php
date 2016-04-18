<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
  public function index(){
      $voter = M('voter');
      $is_vote = $voter->where("student_id=201341402324")->find();
      //var_dump($is_vote);
      //echo time();
      //echo date('m',time())-date('d',$is_vote['time']);
      //echo $tmptime=strtotime('2015-12-10 01:05:21');
      //$tmptime=time()-$tmptime;
      //echo "<br/>".$tmptime;
      echo (date('d',1449833881)-date('d',1449833893)==0);
    }
}
