
<?php
/**
 * 导航列表页面
 */
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();

$sql = "select * from nav order by nav_order asc";
$navInfos = findAll($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>导航菜单项列表</title>
  <link rel="stylesheet" href="../Public/css/basic.css">
</head>
<body>
<div class="top">
  <h2>导航菜单项列表</h2>
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
  <table cellspacing="0">
  <tr>
    <td><label for="txtname">ID</label></td>
    <td><label for="txtname">菜单名称</label></td>
    <td><label for="txtname">菜单url地址栏</label></td>
    <td><label for="txtname">排序</label></td>
    <td><label for="txtname">发布时间</label></td>
    <td><label for="txtname">操作</label></td>
  </tr>

    <?php if(!empty($navInfos)) {

      foreach ($navInfos as $k => $v) {
    ?>
    <tr>
      <td><label for="txtname"><?php echo $v['id'];?></label></td>
      <td><label for="txtname"><?php echo $v['nav_name'];?></label></td>
      <td><label for="txtname"><?php echo $v['nav_url'];?></label></td>
      <td><label for="txtname"><?php echo $v['nav_order'];?></label></td>
      <td><label for="txtname"><?php echo date('Y-m-d H:i:s', $v['update_time']);?></label></td>
      <td><label for="txtname"><a href="editNav.php?id=<?php echo $v['id'];?>">修改</a> | <a href="delNav.php?id=<?php echo $v['id'];?>" onclick="if(!confirm('确定删除该新闻吗？')){return false;}">删除</a></label></td>
    </tr>
  <?php 
    }
  } else {?>
    <tr>
      <td colspan="6"><label for="txtname">暂无数据</label></td>
    </tr>
   <?php }?>
</table>
</div>
</body>
</html>