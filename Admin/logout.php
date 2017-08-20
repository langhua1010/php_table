<?php 
/*退出功能代码
  清空 session 
*/
@session_start();
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
$_SESSION = array();
jump('退出成功', 'Admin/login.php', 1);


 ?>