<?php
//数据库连接头文件
    $conn = mysql_connect("localhost", "root", ""); //链接数据库并返回句柄$conn
    mysql_select_db("e_commerce", $conn); //选择数据库
?>
