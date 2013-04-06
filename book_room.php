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
        session_start();
        include("include/conn.php");
        $sql = "insert into room_orders (
                                         u_id, 
                                         r_id, 
                                         begin_date, 
                                         end_date
                                         ) 
                                 values 
                                        (
                                         '$_SESSION[u_id]', 
                                         '$_POST[book_r_id]', 
                                         '$_SESSION[begin_date]', 
                                         '$_SESSION[end_date]'
                                        )";
        if (!mysql_query($sql, $conn)) {
            die('Error: ' . mysql_error());
        }
        echo "1 record added";
        // put your code here
        ?>
    </body>
</html>
