<?php
//讲常用的提取XML信息的功能做成函数，方便使用
function get_room_type_by_id($id) {
    $doc = new DOMDocument();
    $doc->load("match.xml");
    $x = $doc->getElementsByTagName("room_info");
    return $x->item($id)->nodeValue;
}

function get_membership_type_by_id($id) {
    $doc = new DOMDocument();
    $doc->load("match.xml");
    $x = $doc->getElementsByTagName("membership_level");
    return $x->item($id)->nodeValue;
}

?>
