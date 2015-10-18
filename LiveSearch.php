<?php
require_once 'DBLogic.php';
$q = $_GET["q"];
if (strlen($q) > 0) {
    $hint = "";
    $y = searchKeywordOnly($q);
    for ($i = 0; $i < count($y); $i++) {
        if ($hint == "") {
            $hint = $y[$i]['keyword_name'];
        } else {
            $hint = $hint . "<br />" . $y[$i]['keyword_name'];
        }
    }
}
if ($hint == "") {
    $response = "No suggestions. Please proceed to add " . $q;
} else {
    $response = $hint;
}
echo $response;
?> 