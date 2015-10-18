<?php

require_once 'DBLogic.php';
$actionType = isset($_POST['actionId']) ? $_POST['actionId'] : '';
//$actionType = $_POST['actionId'];
$error_occured = true;
$alert_msg = "";
$fileKey = isset($_POST['fileKey']) ? $_POST['fileKey'] : 'file';
$fileName = processUploadedImage($_FILES, $fileKey);
if ($actionType == "app") {
    $appName = isset($_POST['appName']) ? $_POST['appName'] : '';
    $FullForm = isset($_POST['FullForm']) ? $_POST['FullForm'] : '';
    $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
    //echo $appName .$FullForm .$desc .$_FILES["file"]["name"];
    //echo $appName ."<br/>" . trim($appName);
    if (trim($appName) == "" || trim($FullForm) == "" || trim($desc) == "") {
        $alert_msg = "Input Incorrect!!!";
    } else {
        createNewApplication($appName, $FullForm, $desc, $fileName);
        $error_occured = false;
        $alert_msg = "Information added successfully";
    }
}

if ($actionType == "appUpdate") {
    $appId = isset($_POST["id"]) ? $_POST["id"] : '';
    updateApplication($appId, $fileName);
    $error_occured = false;
    $alert_msg = "Image added successfully";
}

if ($actionType == "intfAddDiagram") {
    $keywordIdUpdate = isset($_POST["id"]) ? $_POST["id"] : '';
    updateKeywordForDiagram($keywordIdUpdate, $fileName);
    $error_occured = false;
    $alert_msg = "Image added successfully";
}

if ($actionType == "intf") {
    $InterfaceName = isset($_POST['InterfaceName']) ? $_POST['InterfaceName'] : '';
    $Type = isset($_POST['Type']) ? $_POST['Type'] : '';
    $InterfaceDesc = isset($_POST['InterfaceDesc']) ? $_POST['InterfaceDesc'] : '';
    $SelectAppNames = isset($_POST["SelectAppNames"]) ? $_POST["SelectAppNames"] : '';
    //echo $SelectAppNames;
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $FullForm = isset($_POST['FullForm']) ? $_POST['FullForm'] : '';
    $relatedWord = isset($_POST['relatedWord']) ? $_POST['relatedWord'] : '';
    //echo "selected app name =".$SelectAppNames;
    $error_occured = true;
    if (trim($InterfaceName) == "") {
        $alert_msg = "Input Incorrect!!! Enter Information Name";
    } else if (trim($SelectAppNames) == "") {
        $alert_msg = "Input Incorrect!!! Select a AIB/BT Application";
    } else if (trim($Type) == "" &&
            trim($InterfaceDesc) == "" &&
            trim($remarks) == "" &&
            trim($FullForm) == "" &&
            trim($relatedWord) == "") {
        $alert_msg = "Input Incorrect!!! Enter what to update/add";
    } else {

        $keywordId = getKeywordID($InterfaceName);
        if ($keywordId == 0) {
            if ((trim($InterfaceDesc) == "" && trim($remarks) == "" ) || trim($SelectAppNames) == "") {
                $alert_msg = "Input Incorrect!!!";
                //$error_occured = true;
            } else {
                if (trim($Type) == "")
                    $Type = "Unknown";
                if (trim($InterfaceDesc) == "")
                    $InterfaceDesc = $remarks;
                if (trim($remarks) == "")
                    $remarks = $InterfaceDesc;
                if (trim($relatedWord) == "")
                    $relatedWord = $InterfaceName;
                createnewRowinKeywords($InterfaceName, $Type, $InterfaceDesc, $SelectAppNames, $remarks, $FullForm, $relatedWord, $fileName);
            }
        } else {
            updateRowInKeywords($keywordId, $Type, $InterfaceDesc, $SelectAppNames, $remarks, $FullForm, $relatedWord, $fileName);
        }
        $error_occured = false;
        $alert_msg = "Information added successfully";
    }
    //echo "trying to add interface - code under construction";
}
//header("Location: index.php");
setcookie("msg", $alert_msg);
if ($error_occured) {
    $_POST['actionId'] = $actionType;
    if ($alert_msg != "") {
        echo '<script language="javascript">alert("' . $alert_msg . '")</script>';
    }
    include('addData.php');
} else {
    //include('index.php');
    header("Location: index.php");
}
?>
