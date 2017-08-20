
<?php 

/*

后台添加导航

*/

header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();
 $maxNav = 7;
if(!empty($_POST)){
 // 合法验证
  if(empty($_POST['nav_name'])) back('导航名称不能为空');
  if(empty($_POST['nav_url'])) back('导航地址不能为空');


// 逻辑性验证 
// 添加之前先判断导航数量 不能超过 7 个 
    if($navCount['count'] >= $maxNav){
    // 如果导航已经超过最大值$maxNav，那么去判断一下提交的导航名称是否为新值
    // 如果查询不到数据，说明为企图新增导航，则禁止提交
    // 反之，如果该导航名称在数据库存在，那么则为修改，允许提交
    $sql = "select * from nav where nav_name = '{$_POST['nav_name']}' limit 1";
    $navInfo = findOne($sql);
    if(empty($navInfo)){
      back('导航数量已经超过'.$maxNav.'个，不允许添加');
    }
  }

  // 组织 SQL语句 入库 

  $addtime = time();
  $sql = "replace into nav values (null,'{$_POST['nav_name']}','{$_POST['nav_url']}',{$_POST['nav_order']},{$addtime})";
  $rs = mysql_query($sql);
  if($rs){
    jump('导航添加成功','Admin/nav.php',1);
  }else{
    jump('导航添加失败','Admin/addNav.php',1);
  }

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
  <span>欢迎<b>admin</b>登录后台</span>
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
    <label for="txtname">导航名称：</label>
    <input type="text"  name="nav_name"  /><br>
    <label for="txtpswd">导航地址：</label>
    <input type="text"  name="nav_url"  /><br>
    <label for="txtpswd">导航排序：</label>
    <input type="text"  name="nav_order" value="" placeholder="正序排序" /><br>
    <div class="btn">
      <input type="reset" />
      <input type="submit" value="添加" />
    </div>
  </form>
</div>
</body>
</html>