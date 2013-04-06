<!DOCTYPE html>
<?php
//主页
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="jq/themes/base/jquery.ui.all.css">
        <script src="jq/jquery-1.9.1.js"></script>
        <script src="jq/ui/jquery.ui.core.js"></script>
        <script src="jq/ui/jquery.ui.widget.js"></script>
        <script src="jq/ui/jquery.ui.datepicker.js"></script>
        <link rel="stylesheet" href="jq/demos/demos.css">
        <script>
            $(function() {
                $("#datepicker1").datepicker();
                $("#datepicker1").datepicker("option", "dateFormat", "yy-mm-dd");
            });
            $(function() {
                $("#datepicker2").datepicker();
                $("#datepicker2").datepicker("option", "dateFormat", "yy-mm-dd");
            });
        </script>
    </head>
    <?php
    //登录
    session_start();
    if (isset($_POST['submit'])) {
        $username = $_POST['user_name'];
        $password = $_POST['user_password'];
        //由于经常连接数据库，所以写在头文件里，用的时候引用
        include('include/conn.php');
        //SQL语句，验证数据库查询检测用户名及密码是否正确
        $check_query = mysql_query("select u_id from users where user_name='$username' and password='$password' limit 1");
        //判断数据库是否存在匹配记录
        if ($result = mysql_fetch_array($check_query)) {
            //登录成功
            $_SESSION['user_name'] = $username;
            $_SESSION['u_id'] = $result['u_id'];
        } else {
            //如果登录失败，显示返回链接
            exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
        }
    }
    ?>
    <?php
    if (!isset($_SESSION['u_id'])) {
        //未登录
        ?>
        <body>
            <table border="1">
                <tr>
                <form name="log_form" action="index.php" method="POST">
                    <td>用户名：<input type="text" name="user_name"/></td>
                    <td>密码：<input type="password" name="user_password"/></td>
                    <td><input type="submit" name="submit" value="登录"/></td>
                    <td><a href="registe.php">注册</a></td>
                </form>
            </tr>
        </table>
        <table border="1">
            <tr>
                <td>在线订房</td>
            </tr>
            <tr>
            <form action="index.php" method="GET">
                <td>入住日期<br><input type = "text" name = "begin_date" id = "datepicker1"/></td>
                <td>离店日期<br><input type = "text" name = "end_date" id = "datepicker2"/></td>
                <td><input type = "submit" name = "search_submit" value = "立即查询"/></td>
            </form>
        </tr>
        <?php
        if (isset($_GET['search_submit'])) {
            ?>
            <tr>
                <td>房间</td>
                <td>面积</td>
                <td>楼层</td>
                <td>房型</td>
                <td>设施</td>
                <td>价格</td>
                <td>预订详情</td>
            </tr>

            <?php
            //sql搜索房间
            $begin_date = $_GET['begin_date'];
            $end_date = $_GET['end_date'];
            include("include/conn.php");
            $sql = "Select * From rooms Where ((end_date < '$begin_date') Or (begin_date > '$end_date') Or (room_is_booked = 0))";
            $check_query = mysql_query($sql);
            include("include/functions.php");
            while ($result = mysql_fetch_array($check_query)) {
                $room_name = $result['room_name'];
                $area = $result['room_area'];
                $floor = $result['room_floor'];
                $room_type = get_room_type_by_id($result['room_type']);
                $device = $result['room_device'];
                $price = $result['room_price'];
                echo "<tr>";
                echo "<td>$room_name</td>";
                echo "<td>$area</td>";
                echo "<td>$floor</td>";
                echo "<td>$room_type</td>";
                echo "<td>$device</td>";
                echo "<td>$price</td>";
                echo "<td>登录后可见</td>";
                echo "</tr>";
            }
            ?>
            <?php
        } else {
            ?>

        <?php }
        ?>
    </table>
    </body>
    <?php
} else {
    //已经登录
    ?>
    <body>
        <table border="1">
            <tr>
                <td><?php echo $_SESSION['user_name']; ?></td>
                <td><a href="log_out.php">退出登录</a></td>
            </tr>
        </table>
        <table border="1">
            <tr>
                <td>在线订房</td>
            </tr>
            <tr>
            <form action="index.php" method="GET">
                <td>入住日期<br><input type = "text" name = "begin_date" id = "datepicker1"/></td>
                <td>离店日期<br><input type = "text" name = "end_date" id = "datepicker2"/></td>
                <td><input type = "submit" name = "search_submit" value = "立即查询"/></td>
            </form>
        </tr>
        <?php
        if (isset($_GET['search_submit'])) {
            ?>
            <tr>
            <form action="book_room.php" method="POST">
                <td>房间</td>
                <td>面积</td>
                <td>楼层</td>
                <td>房型</td>
                <td>设施</td>
                <td>价格</td>
                <td>入住时间</td>
                <td>离店时间</td>
                <td>预订详情</td>
                </tr>

                <?php
                //sql搜索房间
                $begin_date = $_GET['begin_date'];
                $end_date = $_GET['end_date'];
                $_SESSION['begin_date'] = $begin_date;
                $_SESSION['end_date'] = $end_date;
                include("include/conn.php");
                $sql = "Select * From rooms";
                $check_query = mysql_query($sql);
                include("include/functions.php");
                while ($result = mysql_fetch_array($check_query)) {

                    $sql = "Select * From room_orders where (r_id = $result[r_id]) And (Not ((end_date < '$begin_date') Or (begin_date > '$end_date')))";
                    $check = mysql_query($sql);

                    if (mysql_fetch_array($check)) {
                        continue;
                    }

                    $room_name = $result['room_name'];
                    $area = $result['room_area'];
                    $floor = $result['room_floor'];
                    $room_type = get_room_type_by_id($result['room_type']);
                    $device = $result['room_device'];
                    $price = $result['room_price'];
                    echo "<tr>";
                    echo "<td>$room_name</td>";
                    echo "<td>$area</td>";
                    echo "<td>$floor</td>";
                    echo "<td>$room_type</td>";
                    echo "<td>$device</td>";
                    echo "<td>$price</td>";
                    echo "<td>$begin_date</td>";
                    echo "<td>$end_date</td>";
                    echo "<td><input type='radio' name='book_r_id' value='$result[r_id]'/></td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
                echo "<td><input type='submit' name='book_submit' value='预订' /></td>";
                echo "</tr>";
                echo "</form>";
                ?>
                <?php
            } else {
                ?>

            <?php }
            ?>
    </table>
    </body>

    <?php
}
?>
<a href="admin/admin.php">管理员登陆</a>
</html>
