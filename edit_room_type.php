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
        <div align="center">
            <h2>房间类型修改</h2>

            <?php
            //这里用XML文件match.xml来保存房间类型信息，因为这类操作数据量很小，用XML快些
            //如果嫌麻烦，可以换一种写法，不用XML，把这些信息存到数据库里
            $doc = new DOMDocument();
            //加载XML文件
            $doc->load("match.xml");
            //获取room_info标签节点集合
            $x = $doc->getElementsByTagName("room_info");
            //获取room_info标签个数
            $count = $x->length;
            //遍历输出room_info
            echo "<table border='1' width='256'>";
            echo "<tr>
                    <td>ID</td>
                    <td>类型</td>
                  </tr>";
            for ($i = 0; $i < $count; $i++) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $x->item($i)->nodeValue . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            ?> 
            <br>
            <form action="add_room_type.php" name ="add_room_form" method="GET">
                <input type="text" name="new_room_name"></input>
                <input type="submit" name="submit" value="添加新类型"></input>
            </form>
        </div>
    </body>
</html>
