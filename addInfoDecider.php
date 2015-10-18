<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$actionType = $_GET['addInfo_type'];
if($actionType == "app"){
    header("Location: addNewApp.php"); 
}else if($actionType == "intf"){
    header("Location: addModifyIntf.php"); 
}else{
    header("Location: addInfo.php");
}

?>
