<?php
/**
 * 删除图片
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

$sql = "delete from pics where id = {$id}";
$rs = mysql_query($sql);
jump('删除成功', 'Admin/picList.php', 1);




/*$pic_url = isset($_GET['pic_url']) ? $_GET['pic_url'] : ' ';
$sql = "delete from pics where pic_url = {$pic_url}";
$rs = mysql_query($sql);
jump('删除成功','Admin/picList.php', 1);*/
