<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div align="center">
            <h2>管理面板</h2>
            <br>
            <a href="edit_room_type.php">房间类型修改</a>
            <a href='edit_membership_type.php'>会员类型修改</a>
            <a href='edit_room.php'>房间修改</a>
            <a href='log_out.php'>登出</a>
            <br>
            <?php
            //在每个涉及到SESSION的页面里都要用session_start();启动session服务
            session_start();
            //判断是否登录，如果未登录，跳转到登录页面
            if (!isset($_SESSION['a_id'])) {
                Header("Location:index.php");
                die();
            }
            //连接数据库
            include("conn.php");
            $check_query = mysql_query("select * from rooms");
            //用表格显示已有房间信息
            echo "<br><br>";
            echo "<table  border='1'>
            <tr>
                <td>room_number</td>
                <td>room_floor</td>
                <td>room_price</td>
                <td>room_type</td>
                <td>room_state</td>
            </tr>";
            //用变量row来变量查询到的所有记录
            while ($row = mysql_fetch_array($check_query)) {
                echo "<tr>";
                echo "<td>" . $row['room_number'] . "</td>";
                echo "<td>" . $row['room_floor'] . "</td>";
                echo "<td>" . $row['room_price'] . "</td>";
                include("functions.php");
                echo "<td>" . get_room_type_by_id($row['room_type']) . "</td>";
                echo "<td>";
                if ($row['room_is_booked'] == 1) {
                    echo "booked";
                } else {
                    echo "free";
                }
                echo"</td>";
                echo "</tr>";
            }
            echo "</table>";
            ?>
            </table>
        </div>
    </body>
</html>
