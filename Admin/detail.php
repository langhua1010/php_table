<?php 

/*
后台新闻详情页面
*/


header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();
$news_id = isset($_GET['news_id']) ? $_GET['news_id'] : 0;
//获取 新闻详情
$sql = "select * from news where news_id = {$news_id} and user_id = {$_SESSION['user_id']} limit 1";
$new = findOne($sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>新闻详情</title>
 <link rel="stylesheet" href="../Public/css/basic.css" />
 <link rel="stylesheet" href="../Public/css/Admin-detail.css" />
</head>
<body>
<div class="top"><h2>文章列表页面</h2></div>
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
  <h3><?php echo $new['title'] ;?></h3>
  <p><font size="2">发布时间：<?php echo date('Y年m月d日 H:i:s',$new['addtime']);    ?>  </font></p>
  <hr width="100%" align="left" />
  <div class="con">
    <p><?php echo $new['content']; ?></p>
  </div>
</div>
</body>
</html>