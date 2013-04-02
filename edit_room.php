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
            <h2>修改房间</h2>

            <form action='add_room.php' name='add_room_form' method='GET'>
                <table>
                    <tr>
                        <td>room_name</td>
                        <td>room_area</td>
                        <td>room_number</td>
                        <td>room_floor</td>
                        <td>room_device</td>
                        <td>room_price</td>
                        <td>room_type</td>
                    </tr>
                    <tr>
                        <td><input type='text' name='room_name'></input></td>
                        <td><input type='text' name='room_area'></input></td>
                        <td><input type='text' name='room_number'></input></td>
                        <td><input type='text' name='room_floor'></input></td>
                        <td><input type='text' name='room_device'></input></td>
                        <td><input type='text' name='room_price'></input></td>
                        <td><select name="room_type">
                                <?php
                                $doc = new DOMDocument();
                                $doc->load("match.xml");
                                $x = $doc->getElementsByTagName("room_info");
                                $count = $x->length;
                                //遍历输出可选房间类型
                                for ($i = 0; $i < $count; $i++) {
                                    echo "<option value='$i'>" . $x->item($i)->nodeValue . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type='submit' name='submit' value="添加房间"></input></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
