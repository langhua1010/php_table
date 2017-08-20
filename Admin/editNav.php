

<?php
/**
 * 修改导航表
 */
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();

if(!empty($_POST)){
  // 修改后
  $nav_name = trim($_POST['nav_name']);
  $nav_url  = trim($_POST['nav_url']);
  $nav_order = $_POST['nav_order'];
  $id = $_POST['id'];
  $update_time = time();
  // 组合SQL语句 实现更新入库
  $sql = "update nav set nav_name = '{$nav_name}', nav_url = '{$nav_url}', nav_order = '{$nav_order}',update_time = {$update_time} where id = {$id} ";
 
  $rs = mysql_query($sql);
  if($rs){
    // 修改成功
    jump('修改成功', 'Admin/nav.php', 1);
  } else {
    // 修改失败
    jump('修改失败', 'Admin/editNav.php?id=' . $id, 1);
  }

} else {
  // 修改前
  $id = isset($_GET['id']) ? $_GET['id'] : 0;
  $sql = "select id,nav_name, nav_url,nav_order from nav where id = {$id}";
  $nav = findOne($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>添加官网导航菜单</title>
 <link rel="stylesheet" href="../Public/css/basic.css">
</head>
<body>
<div class="top">
  <h2>添加官网导航菜单</h2>
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
<!-- 表单名称要和库表单名称保持一致 -->
  <form class="form" action="" method="post">
  <input type="hidden" name="id" value="<?php echo $nav['id'];?>">
    <label for="txtname">导航名称：</label>
    <input type="text"  name="nav_name" value="<?php echo $nav['nav_name'] ?>" /><br>
    <label for="txtpswd">导航地址：</label>
    <input type="text"  name="nav_url" value="<?php echo $nav['nav_url'] ?>"  /><br>
    <label for="txtpswd">导航排序：</label>
    <input type="text"  name="nav_order" value="<?php echo $nav['nav_order'] ?>"  placeholder="正序排序" /><br>
    <div class="btn">
      <input type="reset" />
      <input type="submit" value="修改" />
    </div>
  </form>
</div>
</body>
</html>











