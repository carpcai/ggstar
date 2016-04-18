<?php
namespace Home\Model;
use Think\Model;
class Play_voteModel extends Model{
protected $_validate = array(
	array('voter_id','require','你还没选择哟~'),
);
}
