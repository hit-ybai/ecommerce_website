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
        echo $_GET['new_room_name'];
        $doc = new DOMDocument();
        $doc->load("match.xml");
        //设置格式化输出，不写也行
        $doc->formatoutput = true;
        //以下是添加XML节点，原理和树一样，像每个节点的后面都可以加儿子节点，每个节点可以附加属性。
        $rooms_info = $doc->getElementsByTagName("rooms_info");

        $room_info = $doc->getElementsByTagName("room_info");
        $count = $room_info->length;

        $room_value = $doc->createTextNode($_GET['new_room_name']);

        $new_room_type = $doc->createElement("room_info");
        $new_room_type->appendChild($room_value);

        $new_id = $doc->createAttribute("id");
        $id_value = $doc->createTextNode($count);
        $new_id->appendChild($id_value);

        $new_room_type->appendChild($new_id);
        $rooms_info->item(0)->appendChild($new_room_type);
        //保存XML
        $doc->save("match.xml");
        ?>
    </body>
</html>
;