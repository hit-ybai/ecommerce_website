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
            <h2>会员类型修改</h2>

            <?php
            $doc = new DOMDocument();
            $doc->load("match.xml");
            $x = $doc->getElementsByTagName("membership_level");
            $count = $x->length;
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
            <form action="add_membership_type.php" name ="add_membership_level_form" method="GET">
                <input type="text" name="new_membership_level"></input>
                <input type="submit" name="submit" value="添加新类型"></input>
            </form>
        </div>
    </body>
</html>
