<?php
namespace Home\Model;
use Think\Model;
class Zxstudent2015Model extends Model{
protected $_validate = array(
	array('Stu_id','require','学号不能为空！'),
	array('Name','require','姓名不能为空！'),
	array('Sex','require','性别不能为空！'),
	array('Xiaoqu','require','校区不能为空！'),
	array('Major','require','专业班级不能为空！'),
	array('Address','require','籍贯不能为空！'),
	array('Phone','require','手机号不能为空！'),
	array('Yuanxi','require','院系不能为空！'),
	//array('Stu_id',array(201141402324,201641402324),'学号的范围不正确！',2,'between'),
	array('Phone',11,'手机号码格式不正确',0,'length',),
	array('organization1','require','组织不能为空！'),
	array('department1_1','require','部门不能为空！'),
);
}