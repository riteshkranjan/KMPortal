<?php

require_once 'DBLogic.php';
$actionType = isset($_POST['actionId']) ? $_POST['actionId'] : ''; 
//$actionType = $_POST['actionId'];
//echo $actionType;
$error_occured = true;
$alert_msg = "";
if ($actionType == "app") {
    $appName = isset($_POST['appName']) ? $_POST['appName'] : '';
    $FullForm = isset($_POST['FullForm']) ? $_POST['FullForm'] : '';
    $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
    //echo $appName .$FullForm .$desc .$_FILES["file"]["name"];
    //echo $appName ."<br/>" . trim($appName);
    if (trim($appName) == "" || trim($_FILES["file"]["name"]) == "" || trim($FullForm) == "" || trim($desc) == "") {
        $alert_msg = "Input Incorrect!!!";
    } else {
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/pjpeg"))
                && ($_FILES["file"]["size"] < 2000000)) {
            if ($_FILES["file"]["error"] > 0) {
                $alert_msg = "File upload error. Information not added. Please try Again!!! Return Code: " . $_FILES["file"]["error"];
                //$error_occured = true;
            } else {
                $fileName = $_FILES["file"]["name"];
                $fileName = $appName . substr($fileName, stripos($fileName, "."));
                if (file_exists("Data/" . $fileName)) {
                    $alert_msg = "Application already present. Information not added. Please try Again!!!";
                    //echo $fileName . " already exists. ";
                    //$error_occured = true;
                } else {
                    //echo $fileName;
                    move_uploaded_file($_FILES["file"]["tmp_name"], "Data/" . $fileName);
                    //echo "Stored in: " . "Data/" . $_FILES["file"]["name"];
                    createNewApplication($appName, $FullForm, $desc, $fileName);
                    $error_occured = false;
                    $alert_msg = "Information added successfully";
                }
            }
        } else {
            $alert_msg = "Invalid file. Please try Again!!!";
            //$error_occured = true;
            //echo "Invalid file new"; //. $_FILES["file"]["type"] . " " . $_FILES["file"]["size"];
        }
    }
} else {
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
                    $type = "Unknown";
                if (trim($InterfaceDesc) == "")
                    $InterfaceDesc = $remarks;
                if (trim($remarks) == "")
                    $remarks = $InterfaceDesc;
                if (trim($relatedWord) == "")
                    $relatedWord = $InterfaceName;
                createnewRowinKeywords($InterfaceName, $Type, $InterfaceDesc, $SelectAppNames, $remarks, $FullForm, $relatedWord);
            }
        } else {
            updateRowInKeywords($keywordId, $Type, $InterfaceDesc, $SelectAppNames, $remarks, $FullForm, $relatedWord);
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
    include('addInfo.php');
} else {
    //include('index.php');
    header("Location: index.php");
}
?>
