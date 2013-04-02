<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>管理员登录</title>
    </head>
    <body>
        <?php
        //登录
        session_start();//SESSION相当于一个全局数组，可以用来保存已登录用户的信息
        //如果已经在SESSION里发现用户登录信息则直接跳转到admin_panel.php 进入管理面板
        if (isset($_SESSION['a_id'])) {
            Header("Location:admin_panel.php");
        }
        
        //这里判断是否提交了表单，下面有说明
        if (isset($_POST['submit'])) {

            $username = $_POST['admin_name'];
            $password = $_POST['admin_pin'];

            //由于经常连接数据库，所以写在头文件里，用的时候引用
            include('conn.php');
            //SQL语句，验证数据库查询检测用户名及密码是否正确
            $check_query = mysql_query("select a_id from admin where admin_name='$username' and password='$password' limit 1");
            //判断数据库是否存在匹配记录
            if ($result = mysql_fetch_array($check_query)) {
                //登录成功
                $_SESSION['admin_name'] = $username;
                $_SESSION['a_id'] = $result['a_id'];
                //设置好SESSION后跳转到用户面板
                Header("Location:admin_panel.php");
                exit;
            } else {
                //如果登录失败，显示返回链接
                exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
            }
            exit;
        }
        ?>
        <!-- 以下是登录页面代码，注意action的地址是本页自身; 到达这个页面有两种可能，
        一种是直接输入网址;
        另一种是通过下面的submit按钮提交到达
        在上面的PHP代码里有一个IF判断，如果是submit提交到自身的话，就验证是否登录，
        否则显示以下登录代码
        其实下面的action可以指向其他一个新的PHP页面，在里面进行判断，不过会产生页面冗余，所以选择提交到自身-->
        <form action="admin.php" method="post">
            用户名：<input type="text" name="admin_name" value="admin"/><br>
            密  码：<input type="password" name="admin_pin" value="" /><br>
            <input type="submit" name="submit" value="登录">
        </form>
    </body>
</html>
