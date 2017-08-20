
<?php 

/*
后台首页功能代码
引入function.php
*/

/*if(!isset($_SESSION['username']) || !isset($_SESSION['user_id'])){
  // 没有登陆,跳转到登录页面
  jump('暂未登陆,请前往登录页面','Admin/login.php',1);
}
*/
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();
$sql = "SELECT count(*) as newsnum FROM news";
$countNews = findOne($sql);
$sql = "SELECT count(*) as usernum FROM user";
$countUser = findOne($sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>后台首页</title>
  <link rel="stylesheet" href="../Public/css/basic.css" />
  <link rel="stylesheet" href="../Public/css/Admin_index.css" />
</head>
<body>
<div class="top">
  <h2>后台首页</h2>
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
   <li><a href="logout.php" onclick="if(!confirm('确定退出系统么?')){return false}">退出后台</a></li>
  </ul>
</div>
<div class="banner" id="box">
    <ul>
        <li><img src="../Public/img/1.jpg"/></li>
        <li><img src="../Public/img/2.jpg"/></li>
        <li><img src="../Public/img/3.jpg"/></li>
        <li><img src="../Public/img/4.jpg"/></li>
        <li><img src="../Public/img/5.jpg"/></li>
    </ul>
</div>
<div class="info">
<p>本站共有文章<b><?php echo $countNews['newsnum']; ?></b>篇，注册会员<b><?php echo $countUser['usernum']; ?></b>人</p>
</div>
</body>
    <script src="../Public/js/jquery-1.12.2.js"></script>
    <script>
        $(function () {
            $("#box>ul>li").mouseover(function () {
                //当前的li的所有的兄弟元素li的宽度设置一下
                $(this).siblings("li").css("width","100px");
                $(this).css("width","800px");
            });
            $("#box>ul>li").mouseout(function () {
                $("#box>ul>li").css("width","240px");
            });
        });
    </script>
</html>
