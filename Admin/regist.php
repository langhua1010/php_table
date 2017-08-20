 <?php 
 /* 
后台注册功能代码
echo''
var _dump ($-POST)
get方式是明文传送,不是很安全
 post 传值
 if(!empty($_POST)) 判断用户是否提交,确认有没有填写内容,如果empty为空就不能提交

 通过下标可以获得填入的值


  */
 header("content-type:text/html;charset=utf8");
//require_once('../Common/function.php');
include_once('../Common/mysql.php');
include_once('../Common/function.php');
 // 链接数据库
/* $link = @mysql_connect('localhost','root','123456') or die('数据库链接失败');
 mysql_select_db('blog',$link);
 mysql_query('set names utf8');*/
 initDb();
 // 合法性验证
if(!empty($_POST)){
    if(empty($_POST['username'])){

        back('用户名不能为空');
    }

    if(empty($_POST['password']) || empty($_POST['password1'])){
       back('密码和确认密码不能为空');
    }

    if($_POST['password'] !== $_POST['password1']){
       back('两次密码输入不一致,请重新输入');
    }

    if(empty($_POST['email'])){
      back('请输入您的邮箱');
    }

    if(empty($_POST['mobile'])){
      back('请输入您的手机号');
    }


//逻辑性验证,用户名不能重复
$sql = "select * from user where username = '{$_POST['username']}'";
$info = findOne($sql);
if(!empty($info)){
  back('当前用户名:'.$_POST['username'] . '该用户名已经存在,请更换');
}

/*echo'<pre>';
var_dump ($_POST);
echo'</pre>';
die;*/

//写入数据库 
 $password = md5($_POST['password']);
 $time = time();
 $sql = "insert into user values (null,'{$_POST['username']}','{$password}','{$_POST['email']}','{$_POST['mobile']}',{$time})";
 // echo $sql;die;
 $rs = mysql_query($sql);
 if($rs){
  //echo '注册成功';
  jump('注册成功','Admin/login.php',1);
 }else{
  // echo '注册失败';
  back('注册失败');

 }

}
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>后台注册页</title>
   <link rel="stylesheet" href="../Public/css/basic.css" />
 </head>
 <body>
  <div class="top"><h2>注册页面</h2></div>
  <div class="main">
    <form class="form" action="" method="post">
    <!--action="" 如果为空 提交到当前页面  -->
      <label for="txtname">用&ensp;户&ensp;名：</label>
      <input type="text" name="username" /><br>
      <label for="txtpswd">密&#12288;&#12288;码：</label>
      <input type="password" name="password" /><br>
      <label for="txtpswd">确认密码：</label>
      <input type="password" name="password1" /><br>  
      <label for="txtpswd">邮&#12288;&#12288;箱：</label>
      <input type="text" name="email" /><br>
      <label for="txtpswd">手&ensp;机&ensp;号：</label>
      <input type="text" name="mobile" /><br>
      <div class="btn">
        <input type="reset" />
        <input type="submit" value="注册" />
        <a href="login.php">已有账号？点击登录</a>
      </div>
    </form>
  </div>
</body>
</html>