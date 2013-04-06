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
        $doc = new DOMDocument();
        $doc->load("match.xml");
        $doc->formatoutput = true;

        $membership_levels = $doc->getElementsByTagName("membership_levels");

        $membership_level = $doc->getElementsByTagName("membership_level");
        $count = $membership_level->length;

        $level_value = $doc->createTextNode($_GET['new_membership_level']);

        $new_level_type = $doc->createElement("membership_level");
        $new_level_type->appendChild($level_value);

        $new_id = $doc->createAttribute("id");
        $id_value = $doc->createTextNode($count);
        $new_id->appendChild($id_value);

        $new_level_type->appendChild($new_id);
        $membership_levels->item(0)->appendChild($new_level_type);
        $doc->save("match.xml")
        ?>
    </body>
</html>
