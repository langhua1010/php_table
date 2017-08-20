<?php
/**
 * 公共函数文件
 */

/**
 * 返回上一步
 * @param  string  $msg  提示信息
 * @return [type]        [description]
 */
/*
		// setTimeout(function(){
			window.history.go(-1);
		},2000);
*/
function back($msg = '')
{
	echo $msg;
	$back = <<<eof
		<script type="text/javascript">
			window.history.go(-1);
		</script>
eof;
// 	window.history.go(-1); 返回上一步
	echo $back;
	exit();
}

/**
 * 跳转函数
 * @param  string  $msg  提示给用户信息
 * @param  string  $url  跳转地址
 * @param  integer $time 延迟时间
 * @return [type]        [description]
 */
function jump($msg,$url,$time = 1)
{
	$url = 'http://www.blog.com/'.$url;
	//跳转提示功能
	header("Refresh:{$time};url='{$url}'");
	echo $msg . "系统将在{$time}秒之后自动跳转到{$url}！";
	//终止脚本
	exit();
}

function checkLogin(){
		@session_start();
		if(!isset($_SESSION['username']) || !isset($_SESSION['user_id'])){
 		// 没有登陆,跳转到登录页面
 		jump('暂未登陆,请前往登录页面','Admin/login.php',1);
   }
}