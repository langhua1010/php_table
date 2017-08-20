
<?php 
/*
图片上传功能代码
*/
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();
if(!empty($_FILES)) {
/*echo '<pre>';
var_dump($_FILES);
echo '<pre>';
exit();*/

if($_FILES['pic']['error'] == 0) {
  //  error 其值0说明没有错误发生文件上传成功,一般上传图片我们都会把图片进行重命名
  // 获取图片后缀
  //  1 . 先获取" . " 点最后出现的位置 xxx.jpk
  $pos = strrpos($_FILES['pic']['name'], '.');
  // 2. 然后从此处位置开始,一直截取到最后
  $ext = substr($_FILES['pic']['name']  , $pos); // 得到了 .jpg
  $pic_name = time() . mt_rand(1000,9999) . $ext;
  //echo $pic_name; //在表头出现了重新命名的图片编码 15031499934223.jpg
  $uploadDir = '../Public/Upload/';
  $rs = move_uploaded_file($_FILES['pic']['tmp_name'], $uploadDir . $pic_name);
  if($rs){
    //把图片地址写入到数据库中
    $now = time();
    $sql = "INSERT INTO pics VALUES (null , '{$pic_name}',{$now})";
    mysql_query($sql);
    jump('上传成功','Admin/picList.php',2);
  }else{
    jump('上传失败','Admin/addPics.php',2);
  }
  }else{
  back('上传出现错误,请稍后再试');
};

}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>图片上传</title>
 <link rel="stylesheet" href="../Public/css/basic.css">
</head>
<body>
<div class="top">
 <h2>图片上传页</h2>
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
  <form class="form" action="" method="post" enctype="multipart/form-data">
    <label for="txtname">选择图片：</label>
    <input type="file" multiple name="pic"><br>
    <div class="btn"><input type="submit" value="上传"></div>
  </form>
</div>
</body>
</html>