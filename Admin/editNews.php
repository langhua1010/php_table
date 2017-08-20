

<?php
/**
 * 编辑新闻
 * 
 */
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();

if(!empty($_POST)){
  // 修改后
  $title = trim($_POST['title']);
  $content  = trim($_POST['content']);
  $news_id = $_POST['news_id'];
  $user_id = $_SESSION['user_id'];
  $addtime = time();
  // 组合SQL语句 实现更新入库
  $sql = "update news set title = '{$title}', content = '{$content}', user_id = {$user_id}, addtime = {$addtime} where news_id = {$news_id}";
  $rs = mysql_query($sql);
  if($rs){
    // 修改成功
    jump('修改成功', 'Admin/list.php', 3);
  } else {
    // 修改失败
    jump('修改失败', 'Admin/editNews.php?news_id=' . $news_id, 3);
  }

} else {
  // 修改前
  $news_id = isset($_GET['news_id']) ? $_GET['news_id'] : 0;
  $sql = "select news_id,title, content from news where news_id = {$news_id}";
  $new = findOne($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>修改新闻</title>
  <link rel="stylesheet" href="../Public/css/basic.css">
</head>
<body>
  <div class="top">
  <h2>修改新闻</h2>
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
  <form class="form" action="" method="post">
    <input type="hidden" name="news_id" value="<?php echo $new['news_id'];?>">
    <label for="txtname">标题：</label>
    <input type="text" name="title" value="<?php echo $new['title'];?>" /><br>
    <label for="txtpswd">内容：</label>
    <textarea name="content"><?php echo $new['content'];?></textarea><br>
    <div class="btn">
      <input type="reset" />
      <input type="submit" value="修改" />
    </div>
  </form>
</div>
</body>
</html>











