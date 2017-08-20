<?php 
/*
后台新闻列表页面

*/
header("content-type:text/html;charset=utf8");
require_once('../Common/function.php');
require_once('../Common/mysql.php');
// 初始化数据库
initDb();
checkLogin();
// 查询新闻列表数据
// $sql = "select * from news";
$sql = "select news.*, user.username from news left join user on news.user_id = user.user_id";
$info = findAll($sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>新闻列表</title>
  <link rel="stylesheet" href="../Public/css/basic.css">
</head>
<body>
<div class="top">
  <h2>新闻列表</h2>
  <span>欢迎<b><?php 
  @session_start();
  echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ;
   ?></b>登录后台</span>
</div>
<div class="nav">
  <ul>
   <li><a href="index.php">后台首页</a></li>
   <li><a href="addNews.php">发布文章</a></li>
   <li><a href="list.php">文章列表</a></li>
   <li><a href="addNav.php">导航添加</a></li>
   <li><a href="nav.php">导航列表</a></li>
   <li><a href="addPics.php">上传图片</a></li>
   <li><a href="picList.php">相册列表</a></li>
   <li><a href="logout.php">退出后台</a></li>
 </ul>
</div>
<div class="main">
  <table>
  <tr>
    <td><label for="txtname">ID</label></td>
    <td><label for="txtname">标&nbsp;&nbsp;&nbsp;题</label></td>
    <td><label for="txtname">内&nbsp;&nbsp;&nbsp;容</label></td>
    <td><label for="txtname">用户名</label></td>
    <td><label for="txtname">发布时间</label></td>
    <td><label for="txtname">操作</label></td>
  </tr>
  <?php if(!empty($info)) { 
    foreach ($info as $k => $v) {

    ?>
  <tr>
    <td><label for="txtname"> <?php echo $v['news_id']; ?></label></td>
    <td><label for="txtname"> <?php echo $v['title']; ?></label></td>
    <td><label for="txtname"> <?php echo $v['content']; ?></label></td>
    <td><label for="txtname"> <?php echo $v['user_id']; ?></label></td>
    <td><label for="txtname"><?php echo date('Y-m-d H:i:s', $v['addtime']);?></label></td>

    <td><label for="txtname">&nbsp;<a href="detail.php?news_id=<?php echo $v['news_id']; ?>">查看</a> | <a href="editNews.php?news_id=<?php echo $v['news_id']; ?>">修改</a> | <a href="delNews.php?news_id=<?php echo $v['news_id']; ?>" onclick="if(!confirm('确定删除该新闻吗？')){return false;}">删除</a></label></td>
  </tr>
 <?php
  }
 } else {  ?>
  <tr>
    <td colspan="6"><label for="txtname">暂无新闻</label></td>
  </tr> 
  <?php } ?>
</table>
</div>
</body>
</html>