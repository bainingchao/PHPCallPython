<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(!isset($_POST['sub'])){
    exit('非法访问!');
}
$username = $_POST['username'];
$password = $_POST['password'];
// $email = $_POST['email'];
//注册信息判断
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
    exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password) < 3){
    exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
// if(!preg_match('/^w+([-+.]w+)*@w+([-.]w+)*.w+([-.]w+)*$/', $email)){
//     exit('错误：电子邮箱格式错误。<a href="javascript:history.back(-1);">返回</a>');
// }
//包含数据库连接文件
include('conn.php');
//检测用户名是否已经存在
$check_query = mysql_query("select tid from login where tuser='$username' limit 1");
if(mysql_fetch_array($check_query)){
    echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
    exit;
}
//写入数据
// $password = MD5($password);
$password = addslashes($password);
// $regdate = time();
echo $username."\n\t";
echo $password."\n\t";
$sql = "INSERT INTO login(tuser,tpwd) VALUES('$username','$password')";
if(mysql_query($sql,$conn)){
    exit('用户注册成功！点击此处 <a href="login.html">登录</a>');
} else {
    echo '抱歉！添加数据失败：',mysql_error(),'<br />';
    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
?>