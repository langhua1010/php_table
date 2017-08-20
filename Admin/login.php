<?php
/**
 * 后台登录页面
 */
header("content-type:text/html;charset=utf8");
require_once('../Common/function.php');
require_once('../Common/mysql.php');
// 初始化数据库
initDb();
if (!empty($_POST)) {
  //收集用户提交的数据
  //判断数据的合法性
  if (empty($_POST['username'])) back('用户名不能为空');
  if (empty($_POST['password'])) back('密码不能为空');

  $sql = "SELECT * FROM user WHERE username = '{$_POST['username']}'";
 // $query = mysql_query($sql);
 // $info = mysql_fetch_array($query, MYSQL_ASSOC);
  $info = findOne($sql);
  if (!empty($info)) {
    // 用户名存在，然后去判断密码
    if ($info['password'] !== md5($_POST['password'])) {
      // 密码错误
      back('密码不正确');
    } else {
      // 登录成功
      @session_start();
      $_SESSION['username'] = $info['username'];
      $_SESSION['user_id']  = $info['user_id'];
      jump('登录成功', 'Admin/index.php');
    }
  } else {
    back('用户名不存在');
  }
}
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>后台登录页</title>
   <link rel="stylesheet" href="../Public/css/basic.css" />
 </head>
 <body>
    <div class="top"><h2>后台登录</h2></div>
    <div class="main">
      <form class="form" action="" method="post">
        <label for="txtname">账号：</label>
        <input type="text"  name="username" value="" /><br>
        <label for="txtpswd">密码：</label>
        <input type="password"  name="password" /><br>
        <div class="btn">
          <input type="reset" />
          <input type="submit" value="登录" />
          <a href="regist.php">没有账号？点击注册</a>
        </div>
      </form>
    </div>
 </body>
 </html>