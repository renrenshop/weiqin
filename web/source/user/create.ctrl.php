<?php
/**
 * [WECHAT 2018]
 * [WECHAT  a free software]
 */
defined('IN_IA') or exit('Access Denied');

load()->model('user');

$_W['page']['title'] = '添加用户 - 用户管理';

if (checksubmit()) {
	$user_founder = array(
		'username' => trim($_GPC['username']),
		'password' => trim($_GPC['password']),
		'repassword' => trim($_GPC['repassword']),
		'remark' => $_GPC['remark'],
		'groupid' => intval($_GPC['groupid']),
		'starttime' => TIMESTAMP,
		'endtime' => intval($_GPC['timelimit']),
		'vice_founder_name' => trim($_GPC['vice_founder_name'])
	);

	$user_add = user_info_save($user_founder);
	if (is_error($user_add)) {
		itoast($user_add['message'], '', '');
	}
	itoast($user_add['message'], url('user/edit', array('uid' => $user_add['uid'])), 'success');
}

$groups = user_group();
template('user/create');