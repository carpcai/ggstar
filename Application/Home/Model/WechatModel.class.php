<?php
namespace Home\Model;
use Think\Model;
class WechatModel extends Model{
	protected $connection = array(
		'DB_PREFIX' => 'tw_'
	);
protected $_validate = array(
	array('student_id','require','学号不能为空！'),
	array('password','require','密码不能为空！'),
	array('student_id',12,'学号格式不正确',0,'length',),
);
}
