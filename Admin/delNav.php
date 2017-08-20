<?php
/**
 * 删除导航
 */
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();

$id = isset($_GET['id']) ? $_GET['id'] : '';
if($id <= 0){
  back('参数错误');
}

$sql = "delete from nav where id = {$id}";
$rs = mysql_query($sql);
jump('删除成功', 'Admin/nav.php', 1);


