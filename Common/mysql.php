<?php
/**
 * MySQL相关函数
 */

/**
 * 初始化数据库
 * @return [type] [description]
 */
function initDb()
{
	// 连接数据库
	$link = mysql_connect('localhost', 'root', '123456') or die ('数据库链接失败');
	// 选择数据库
	mysql_select_db('blog', $link);
	// 设置数据库编码
	mysql_query("set names utf8");
}
// 查询一条记录
function findOne($sql){
   $query = mysql_query($sql);
   return mysql_fetch_array($query,MYSQL_ASSOC);
}
// 查询所有记录
// 查询多条记录
function findAll($sql, $showError = false)
{
  $result = mysql_query($sql);
  if (is_resource($result)) {
    $rows = array();
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
      $rows[] = $row; 
    }
    return $rows;
  } else {
    return $showError ? mysql_error() : false;
  }
}