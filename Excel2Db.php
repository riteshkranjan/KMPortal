<?php

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('Data/db_kmportal.xls');

//$keywordnamess = array();
//$relatedwords = array();
//$keywordInfo = array();
//$types = array();
//$remarks = array();
//
//for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
//    $keywordnamess[$i] = $data->sheets[0]['cells'][$i][1];
//    $appNames[$i] = $data->sheets[0]['cells'][$i][5];
//    $remarks[$i] = $data->sheets[0]['cells'][$i][6];
//}
//$con = mysql_connect("localhost", "root", "");
//if (!$con) {
//    die('Could not connect: ' . mysql_error());
//}
//
//mysql_select_db("db_kmportal", $con);
//
//echo "totaol rows are:" . $data->sheets[0]['numRows'];
//for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
//    echo "<br />";
//    echo $keywordnamess[$i] . " " . $appNames[$i] . " " . $remarks[$i];
//    if (stripos($appNames[$i], ",") == 0) {
//        $result = mysql_query("select app_id from app_name where app_name='" . $appNames[$i] . "'");
//        $thisappId = 0;
//        while ($row = mysql_fetch_array($result)) {
//
//            $thisappId = $row['app_id'];
//        }
//        $thisKeyword = 0;
//        $result = mysql_query("select keyword_id from keywords where keyword_name='" . $keywordnamess[$i] . "'");
//        while ($row = mysql_fetch_array($result)) {
//
//            $thisKeyword = $row['keyword_id'];
//        }
//         mysql_query("INSERT INTO `keyword_app_mapping`(`app_id`,keyword_id, `keyword_app_remarks`) VALUES ('$thisappId','$thisKeyword','$remarks[$i]')");
//         echo "<br/>"; 
//        echo "INSERT INTO `keyword_app_mapping`(`app_id`,keyword_id, `keyword_app_remarks`) VALUES ('$thisappId','$thisKeyword','$remarks[$i]')";
//    }
//}




//$appNames = array();
//  $fullforms = array();
//  $appInterfaceDiags = array();
//  $appdescs = array();
//  for ($i = 2; $i <= $data->sheets[1]['numRows']; $i++) {
//  $appNames[$i] = $data->sheets[1]['cells'][$i][1];
//  $fullforms[$i] = $data->sheets[1]['cells'][$i][2];
//  $appInterfaceDiags[$i] = $data->sheets[1]['cells'][$i][3];
//  $appdescs[$i] = $data->sheets[1]['cells'][$i][4];
//  }
//  $con = mysql_connect("localhost", "root", "");
//  if (!$con) {
//  die('Could not connect: ' . mysql_error());
//  }
//
//  mysql_select_db("db_kmportal", $con);
//  for ($i = 2; $i <= $data->sheets[1]['numRows']; $i++) {
//  mysql_query("INSERT INTO `app_name`(`app_id`, `app_name`, `app_desc`, `app_intf_diagram`, `FULLFORM`) VALUES ('$i','$appNames[$i]','$appdescs[$i]','$appInterfaceDiags[$i]','$fullforms[$i]')");
//  mysql_query("commit");
//  } 
//$keywordnamess = array();
//$relatedwords = array();
//$keywordInfo = array();
//$types = array();
//$remarks = array();
//
//for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
//    $keywordnamess[$i] = $data->sheets[0]['cells'][$i][1];
//    $relatedwords[$i] = $data->sheets[0]['cells'][$i][2];
//    $keywordInfo[$i] = $data->sheets[0]['cells'][$i][3];
//    $types[$i] = $data->sheets[0]['cells'][$i][4];
//    $remarks[$i] = $data->sheets[0]['cells'][$i][6];
//}
//$con = mysql_connect("localhost", "root", "");
//if (!$con) {
//    die('Could not connect: ' . mysql_error());
//}
//
//mysql_select_db("db_kmportal", $con);
//
//echo "totaol rows are:" . $data->sheets[0]['numRows'];
//for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
//    echo "<br />";
//    echo $keywordnamess[$i] . " " . $relatedwords[$i] . " " . $types[$i] . " " . $remarks[$i] . " " . $keywordInfo[$i];
//    mysql_query("INSERT INTO `keywords`(`keyword_id`, `keyword_name`, `related_word`, `type`, `keyword_desc`, `keyword_info`) 
//            VALUES ('$i','$keywordnamess[$i]','$relatedwords[$i]','$types[$i]','$remarks[$i]','$keywordInfo[$i]')");
//}
$keywordnamess = array();
$remarks = array();
echo "totaol rows are:" . $data->sheets[2]['numRows'];
for ($i = 2; $i <= $data->sheets[2]['numRows']; $i++) {
    $keywordnamess[$i] = $data->sheets[2]['cells'][$i][1];
    $remarks[$i] = $data->sheets[2]['cells'][$i][2];
}
$con = mysql_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("db_kmportal", $con);


for ($i = 2; $i <= $data->sheets[2]['numRows']; $i++) {
    echo "<br />";
    echo $keywordnamess[$i] . " " . $remarks[$i];
    $index = stripos($keywordnamess[$i], "-");
    echo "<br/>";
    echo substr($keywordnamess[$i], 0, $index) . "-----------" . substr($keywordnamess[$i], $index + 1);

    $result = mysql_query("select app_id from app_name where app_name='" . substr($keywordnamess[$i], $index + 1)."'");
    $thisappId = 0;
    while ($row = mysql_fetch_array($result)) {

        $thisappId = $row['app_id'];
    }
    echo "<br/>";
    $thisKeyword = 0;
    $result = mysql_query("select keyword_id from keywords where keyword_name='" . substr($keywordnamess[$i], 0, $index)."'");
    while ($row = mysql_fetch_array($result)) {

        $thisKeyword = $row['keyword_id'];
    }
    
    mysql_query("INSERT INTO `keyword_app_mapping`( `app_id`,`keyword_id`, `keyword_app_remarks`) VALUES ('$thisappId','$thisKeyword','$remarks[$i]')");
}
mysql_query("commit");

mysql_close($con);
?>
