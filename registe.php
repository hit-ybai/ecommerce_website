<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    if (isset($_POST['submit']))
    {
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="registe.php" method= "POST">
            <table>
                <tr>
                    <td>用户名：</td>
                    <td><input name="user_name" type="text" /></td>
                </tr>
                <tr>
                    <td>密码：</td>
                    <td><input name="password" type="password" /></td>
                </tr>
                <tr>
                    <td>电话：</td>
                    <td><input name="phone_num" type="text" /></td>
                </tr>
                <tr>
                    <td>要求：</td>
                    <td><input name="requirement" type="text" /></td>
                </tr>
                <tr>
                    <td><input name="submit" type="submit" value="submit"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>
