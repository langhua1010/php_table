<?php 
/*
企业相册 列表 功能代码
*/
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();
$sql = "SELECT * FROM pics";
$pics = findAll($sql);

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>相册列表</title>
 <link rel="stylesheet" href="../Public/css/basic.css">
 <link rel="stylesheet" href="../Public/css/Admin-picList.css">
</head>
<body>
  <div class="top">
    <h2>相册列表</h2>
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

    
    <div class="pic">
    <ul>
      <?php if(!empty($pics)) { 
         foreach ($pics as $v) { ?>
        <li><img src="../Public/Upload/<?php echo $v['pic_url'];?>" alt=""><a href="delPic.php?id=<?php echo $v['id']; ?>" onclick="if(!confirm('确定删除该图片吗，删除之后不可恢复！')) {return false;}" title="点击删除该图片">X</a></li>
        </tr>
    <?php
    }
  } else {  ?>
  <tr>
    <p>暂无相关照片，请选择图片上传</p>
  </tr> 
 <?php } ?>  
    </ul>
  </div>
</body>
<script src="../Public/js/Admin-effect.js"></script>
</html>