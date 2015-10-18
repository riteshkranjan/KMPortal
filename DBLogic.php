<?php

$con = mysql_connect("localhost", "root", "root");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("db_kmportal", $con);
mysql_query("select 1 from app_name") or header("Location:Installer.php");

//echo getPortalUsageReport();

function splitString($inputStr, $separator) {
    $outputStr = array();
    $index = stripos($inputStr, $separator);
    $i = 0;

    while ($index != null) {
        $outputStr[$i] = substr($inputStr, 0, $index);
        $inputStr = substr($inputStr, $index + 1);
        $index = stripos($inputStr, $separator);
        $i++;
    }
    $outputStr[$i] = $inputStr;
    return $outputStr;
}

function printArray($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function processUploadedImage($_FILES2, $fileKey) {
    $fileName = "Default.jpg";
    if (trim($_FILES2[$fileKey]["name"]) != "") {
        if ((($_FILES2[$fileKey]["type"] == "image/gif")
                || ($_FILES2[$fileKey]["type"] == "image/jpeg")
                || ($_FILES2[$fileKey]["type"] == "image/pjpeg"))
                && ($_FILES2[$fileKey]["size"] < 2000000)) {
            if ($_FILES2[$fileKey]["error"] > 0) {
                $alert_msg = "File upload error. Information not added. Please try Again!!! Return Code: " . $_FILES2[$fileKey]["error"];
            } else {
                $fileName = $_FILES2[$fileKey]["name"];
                $fileName = round(microtime(true) * 1000) . substr($fileName, stripos($fileName, "."));
                move_uploaded_file($_FILES2[$fileKey]["tmp_name"], "Data/" . $fileName);
            }
        } else {
            $alert_msg = "Invalid file. Please try Again with gif, jpeg, pjpeg file with less than 2MB";
        }
    }
    return $fileName;
}

function getAllApps() {

    $appNames = array();
    $result = mysql_query("select * from app_name") or die(mysql_error());
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        //  echo $row['app_name'];
        $appNames[$i] = $row;
        $i++;
    }
    return $appNames;
}

function getAppInfo($appId) {
    $appInfos = array();
    $result = mysql_query("select * from app_name where app_id='" . $appId . "'") or die(mysql_error());
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $appInfos[$i] = $row;
        $i++;
    }

    return $appInfos;
}

function getAppIdForAppName($appName) {
    $appInfos = array();
    $result = mysql_query("select * from app_name where app_name='" . $appName . "'") or die(mysql_error());
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $appInfos[$i] = $row;
        $i++;
    }
    return $appInfos[0]['app_id'];
}

function searchKeywordCount($srchStr) {
    return count(searchKeyword($srchStr, -1));
}

function searchKeyword($srchStr, $index) {
    $resultNormal = mysql_query("select * from keywords where keyword_name like '%" . $srchStr . "%' or related_word like '%" . $srchStr . "%'") or die(mysql_error());
    $i = 0;
    $keywordsResult = array();
    // echo "index=" . $index;
    while ($row = mysql_fetch_array($resultNormal)) {
        if ($index == -1) {
            $keywordsResult[$i] = $row;
        } else {
            if ($i == $index) {
                $keywordsResult[0] = $row;
            }
        }
        //  echo $row['keyword_name'];
        // echo "<br/>";

        $i++;
    }
    if (count($keywordsResult) == 0) {
        $resultExtensive = mysql_query("select * from keywords where keyword_desc like '%" . $srchStr . "%'") or die(mysql_error());
        $i = 0;
        while ($row = mysql_fetch_array($resultExtensive)) {
            if ($index == -1) {
                $keywordsResult[$i] = $row;
            } else {
                if ($i == $index) {
                    $keywordsResult[0] = $row;
                }
            }
            $i++;
        }
    }
    return $keywordsResult;
}

function searchKeywordOnly($srchStr) {
    $resultsss = mysql_query("select * from keywords where keyword_name like '" . $srchStr . "%'") or die(mysql_error());
    $i = 0;
    $keywordsResult = array();
    // echo "index=" . $index;
    while ($row = mysql_fetch_array($resultsss)) {
        $keywordsResult[$i] = $row;
        $i++;
    }
    return $keywordsResult;
}

function searchKeywordAppMapping($keywordId) {
    $result = mysql_query("select * from keyword_app_mapping where keyword_id =" . $keywordId) or die(mysql_error());
    $i = 0;
    $keywordsMapResult = array();
    while ($row = mysql_fetch_array($result)) {
        $keywordsMapResult[$i] = $row;
        $i++;
    }
    return $keywordsMapResult;
}

function searchKeywordAppMappingCount($keywordId) {
    return count(searchKeywordAppMapping($keywordId));
}

function searchKeywordAppMappingforRemarks($keywordId, $appId) {
    // echo $appId;
    $result = mysql_query("select * from keyword_app_mapping where keyword_id =" . $keywordId . " and app_id='" . $appId . "'") or die(mysql_error());
    $i = 0;
    $keywordsMapResult = array();
    while ($row = mysql_fetch_array($result)) {
        $keywordsMapResult[$i] = $row;
        $i++;
    }
    return $keywordsMapResult;
}

function createNewApplication($appName, $FullForm, $desc, $fileName) {
    $appName = str_replace("'", "''", $appName);
    $FullForm = str_replace("'", "''", $FullForm);
    $desc = str_replace("'", "''", $desc);
    $query = "INSERT INTO `app_name`(`app_name`, `app_desc`, `app_intf_diagram`, `FULLFORM`) VALUES ('$appName','$desc','$fileName','$FullForm')";
    mysql_query($query) or die(mysql_error());
    mysql_query("commit");

    $appID = getAppIdForAppName($appName);
    createnewRowinKeywords($appName, "Application", $desc, $appID, $desc, $appName, $appName, $fileName);
    logRequest("App Add", $appName . " with Description=" . $desc . " and Fullform = " . $FullForm);
}

function updateApplication($appId, $fileName) {
    $queryString = "select app_intf_diagram,app_name from app_name where app_id = " . $appId;
    $result = mysql_query($queryString) or die(mysql_error());
    $existingDiagrams = "";
    while ($row = mysql_fetch_array($result)) {
        $existingDiagrams = $row['app_intf_diagram'];
    }
    if (strpos($existingDiagrams, "Default") === false) {
        $fileName = $existingDiagrams . "," . $fileName;
    }
    $queryString = "update `app_name` set `app_intf_diagram` = '$fileName' where `app_id` = " . $appId;
    mysql_query($queryString) or die(mysql_error());
    mysql_query("commit");
    $appAllData = getAppInfo($appId);
    $keywordId = $appAllData[0]['app_id'];
    $queryString = "update `keywords` set `keyword_diagram` = '$fileName' where `keyword_id` = " . $keywordId;
    echo $queryString;
    mysql_query($queryString) or die(mysql_error());
    mysql_query("commit");

    logRequest("App updated id = ", $appId . " with new file uploaded");
}

function updateKeywordForDiagram($keywordId, $fileName) {
    $queryString = "select keyword_diagram from keywords where keyword_id = " . $keywordId;
    $result = mysql_query($queryString) or die(mysql_error());
    $existingDiagrams = "";
    while ($row = mysql_fetch_array($result)) {
        $existingDiagrams = $row['keyword_diagram'];
    }
    if (strpos($existingDiagrams, "Default") === false) {
        $fileName = $existingDiagrams . "," . $fileName;
    }
    $queryString = "update `keywords` set `keyword_diagram` = '$fileName' where `keyword_id` = " . $keywordId;
    mysql_query($queryString) or die(mysql_error());
    mysql_query("commit");

    $keywordAppMappingData = searchKeywordAppMapping($keywordId);
    $appId = $keywordAppMappingData[0]['app_id'];
    $queryString = "update `app_name` set `app_intf_diagram` = '$fileName' where `app_id` = " . $appId;
    mysql_query($queryString) or die(mysql_error());
    mysql_query("commit");
    logRequest("Keyword updated id = ", $keywordId . " with new file uploaded");
}

function getKeywordID($KeywordName) {
    $keywordId = 0;
    $result = mysql_query("select keyword_id from keywords where keyword_name='" . $KeywordName . "'");
    while ($row = mysql_fetch_array($result)) {
        $keywordId = $row['keyword_id'];
    }

    return $keywordId;
}

function createnewRowinKeywords($InterfaceName, $Type, $InterfaceDesc, $AppId, $remarks, $FullForm, $relatedWord, $fileName) {

    echo " in create new row in keywords db logic ";
    $InterfaceDesc = str_replace("'", "''", $InterfaceDesc);
    $InterfaceName = str_replace("'", "''", $InterfaceName);
    $remarks = str_replace("'", "''", $remarks);
    $FullForm = str_replace("'", "''", $FullForm);
    $relatedWord = str_replace("'", "''", $relatedWord);


    $query = "INSERT INTO `keywords`(`keyword_name`, `related_word`, `type`, `keyword_desc`, `keyword_info`, `keyword_diagram`)
            VALUES ('$InterfaceName','$relatedWord','$Type','$InterfaceDesc','$FullForm', '$fileName')";
    echo $query;
    mysql_query($query) or die(mysql_error());
    $keywordId = 0;
    $result = mysql_query("select keyword_id from keywords where keyword_name='" . $InterfaceName . "'") or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $keywordId = $row['keyword_id'];
    }
    mysql_query("INSERT INTO `keyword_app_mapping`(`app_id`,keyword_id, `keyword_app_remarks`) VALUES ('$AppId','$keywordId','$remarks')") or die(mysql_error());
    logRequest("Key Add", $InterfaceName . " with " . $Type . $InterfaceDesc . $FullForm . $relatedWord . " Interface Remark= " . $remarks);
}

function updateRowInKeywords($keywordId, $Type, $InterfaceDesc, $AppId, $remarks, $FullForm, $relatedWord, $fileName) {

    $InterfaceDesc = str_replace("'", "''", $InterfaceDesc);
    $InterfaceName = str_replace("'", "''", $InterfaceName);
    $remarks = str_replace("'", "''", $remarks);
    $FullForm = str_replace("'", "''", $FullForm);
    $relatedWord = str_replace("'", "''", $relatedWord);


    $result = mysql_query("select * from keywords where keyword_id='" . $keywordId . "'") or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        if ($Type == "" || $Type == null) {
            $Type = $row['type'];
        }
        $InterfaceDesc = $row['keyword_desc'] . " , " . $InterfaceDesc;
        if ($FullForm == "" && $FullForm == null) {
            $FullForm = $row['keyword_info'];
        }
        $relatedWord = $row['related_word'] . " , " . $relatedWord;

        $existingDiagrams = $row['app_intf_diagram'];
        if (strpos($existingDiagrams, "Default") === false) {
            $fileName = $existingDiagrams . "," . $fileName;
        }
    }

    mysql_query("UPDATE `keywords` SET `related_word`='$relatedWord',`type`='$Type',`keyword_desc`='$InterfaceDesc',`keyword_info`='$FullForm', `keyword_diagram`='$fileName' WHERE `keyword_id` = '" . $keywordId . "'") or die(mysql_error());

    $resultMapTable = mysql_query("SELECT * FROM `keyword_app_mapping` WHERE `keyword_id` = '$keywordId' and `app_id` = '$AppId'") or die(mysql_error());
    $InsertRequired = true;
    while ($row = mysql_fetch_array($resultMapTable)) {
        $InsertRequired = false;
        $remarks = $row['keyword_app_remarks'] . " , " . $remarks;
        mysql_query("UPDATE `keyword_app_mapping` SET `keyword_app_remarks`='$remarks' WHERE `keyword_id` = '$keywordId' and `app_id` = '$AppId'") or die(mysql_error());
    }
    if ($InsertRequired) {
        mysql_query("INSERT INTO `keyword_app_mapping`(`keyword_id`, `app_id`, `keyword_app_remarks`) VALUES ('$keywordId','$AppId','$remarks')") or die(mysql_error());
    }
    logRequest("Key Mod", $keywordId . " with " . $Type . $InterfaceDesc . $FullForm . $relatedWord . " Interface Remark= " . $remarks);
}

function getKeywordsCount() {
    $result = mysql_query("SELECT count(*) FROM `keywords`");
    while ($row = mysql_fetch_array($result)) {
        $TotalRows = $row['count(*)'];
    }
    return $TotalRows;
}

function logRequest($action, $actionDetail) {
    $RequestIPAddress = $_SERVER['REMOTE_ADDR'];
    $CurrentDate = date("y-m-d");
    // echo     $CurrentDate;
    mysql_query("INSERT INTO `log_table`(`Date`, `IP_address`, `action_type`, `action_detail`) VALUES ('$CurrentDate','$RequestIPAddress','$action','$actionDetail')") or die(mysql_error());
    mysql_query("commit");
}

function getPortalUsageReport() {

//    $firstDayOfMonth = date('y-m-01');
//    if (oldRowCount($firstDayOfMonth) > 0) {
//        logTableBackUp($firstDayOfMonth);
//        mysql_query("DELETE FROM log_table WHERE date < '" . $firstDayOfMonth . "'");
//        mysql_query("commit");
//    }

    $result = mysql_query("SELECT count(DISTINCT(ip_address)) FROM `log_table`");
    while ($row = mysql_fetch_array($result)) {
        $NoOfUsers = $row['count(DISTINCT(ip_address))'];
    }
    $result = mysql_query("SELECT count(*) FROM `log_table` WHERE `action_type` = 'search'");
    while ($row = mysql_fetch_array($result)) {
        $NoOfSearchReq = $row['count(*)'];
    }
    $result = mysql_query("SELECT count(*) FROM `log_table` WHERE `action_type` = 'view'");
    while ($row = mysql_fetch_array($result)) {
        $NoOfViewReq = $row['count(*)'];
    }
    $result = mysql_query("SELECT count(*) FROM `log_table` WHERE `action_type` = 'app add'");
    while ($row = mysql_fetch_array($result)) {
        $NoOfAddAppReq = $row['count(*)'];
    }
    $result = mysql_query("SELECT count(*) FROM `log_table` WHERE `action_type` = 'key mod' or `action_type` = 'key add'");
    while ($row = mysql_fetch_array($result)) {
        $NoOfkeyModOrAddReq = $row['count(*)'];
    }
    return "This tool has been accessed by " . $NoOfUsers . " distinct users for " . $NoOfSearchReq . " searches and " . $NoOfViewReq . " views. While " . $NoOfkeyModOrAddReq . " keywords added/modified and " . $NoOfAddAppReq . " new AIB/BT application added so far...<br/>";
}

function oldRowCount($fistDayOfMonth) {
    $result = mysql_query("SELECT count(*) FROM `log_table` WHERE date < '" . $fistDayOfMonth . "'");
    while ($row = mysql_fetch_array($result)) {
        $rowCount = $row['count(*)'];
    }
    return $rowCount;
}

function cleanData(&$str) {
    if ($str == 't')
        $str = 'TRUE';
    if ($str == 'f')
        $str = 'FALSE';
    if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
    }
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

function logTableBackUp($fistDayOfMonth) {
// filename for download
    echo 'back up table step started </br>';
    $filename = "log_table_data_" . date('Ymd') . ".csv";

    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: text/csv");
    header("Pragma: no-cache");
    header("Expires: 0");


    $out = fopen("php://output", 'w');

    $flag = false;
    $result = mysql_query("SELECT * FROM log_table where date < '" . $fistDayOfMonth . "'") or die('Query failed!');
    while (false !== ($row = mysql_fetch_array($result, MYSQL_ASSOC))) {
        if (!$flag) {
            // display field/column names as first row
            fputcsv($out, array_keys($row), ',', '"');
            $flag = true;
        }
        array_walk($row, 'cleanData');
        fputcsv($out, array_values($row), ',', '"');
    }
    fclose($out);
}

?>
