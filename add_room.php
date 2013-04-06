<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //连接数据库
        include("include/conn.php");
        //将上一页使用GET方法传送过来的信息存到数据库里
        $sql = "Insert Into rooms (room_number, room_floor, room_price, room_type, room_name, room_area, room_device) Values 
                ('$_GET[room_number]','$_GET[room_floor]','$_GET[room_price]','$_GET[room_type]', '$_GET[room_name]', '$_GET[room_area]', '$_GET[room_device]')";
        if (!mysql_query($sql, $conn)) {
            die('Error: ' . mysql_error());
        }
        echo "1 record added";
        ?>
    </body>
</html>
