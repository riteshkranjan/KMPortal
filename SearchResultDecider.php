<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

require_once 'DBLogic.php';
$strSrch = isset($_POST['searchStr']) ? $_POST['searchStr'] : '';
//$pageFrom = substr($_POST['pageFrom'], strrpos($_POST['pageFrom'], "/"));
//echo $pageFrom;
//echo strlen($strSrch);
if (strlen($strSrch) < 2) {
    echo '<script language="javascript">alert("Search String Length must be greater than 1. Please Try Again.")</script>';
    include('index.php');
} else {
    $countResult = searchKeywordCount($strSrch);
    $lastappId = isset($_POST['appId']) ? $_POST['appId'] : 0;
    $start_index = isset($_POST['startIndex']) ? $_POST['startIndex'] : 0;
    $index = isset($_POST['index']) ? $_POST['index'] : 0;
    if ($countResult == 0) {
        logRequest("Search", $strSrch);
        $_POST['error'] = "Result not found";
        include('errorPage.php');
    } elseif ($countResult == 1 || $index != -1) {
        $_POST['searchStr'] = $strSrch;
        $_POST['appId'] = $lastappId;
        $_POST['index'] = $index;
        $keywrodData = searchKeyword($strSrch, $index);
        $keywordId = $keywrodData[0]['keyword_id'];
        //echo $keywordId;
        $countResultforApps = searchKeywordAppMappingCount($keywordId);
        // echo $countResultforApps;
        if ($countResultforApps == 1 || $lastappId != 0) {
            include('SearchResult.php');
        } else {
            include('SearchResultMultiple.php');
        }
//    echo "I am here";
        if ($index == -1 && $start_index == 1 && $lastappId == 0) {
            logRequest("Search", $strSrch);
        }
    } else {
        if ($start_index == 1) {
            logRequest("Search", $strSrch);
        }
        $_POST['searchStr'] = $strSrch;
        $_POST['startIndex'] = $start_index;
        include('SearchResultMultipleKeyword.php');
    }
}
?>
