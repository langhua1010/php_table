
<?php
/**
 * 删除新闻
 */
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();

$news_id = isset($_GET['news_id']) ? $_GET['news_id'] : 0;
if($news_id <= 0){
  back('参数错误');
}

$sql = "delete from news where news_id = {$news_id}";
$rs = mysql_query($sql);
jump('删除成功', 'Admin/list.php', 1);