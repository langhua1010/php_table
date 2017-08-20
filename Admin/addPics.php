
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

if($_FILES['pic']['error'] == 0) {

  $pos = strrpos($_FILES['pic']['name'], '.');
  $ext = substr($_FILES['pic']['name']  , $pos); 
  $pic_name = time() . mt_rand(1000,9999) . $ext;
  $uploadDir = '../Public/Upload/';
  $rs = move_uploaded_file($_FILES['pic']['tmp_name'], $uploadDir . $pic_name);
  if($rs){
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
 <link rel="stylesheet" href="../Public/css/Admin-addpics.css">
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
    <div class="img_con">
      <input type="file" multiple name="pic"><br>
      <div class="iconBox" ></div>
    </div>
    <div class="btn"><input type="submit" value="上传"></div>
  </form>
</div>
</body>
<script   type="text/javascript">
    document.querySelector('input[type=file]').onchange = function (){
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function (){
      document.querySelector('.iconBox').style.background = 'url('+ reader.result+') no-repeat center/cover';
    }
  }
</script>
</html>