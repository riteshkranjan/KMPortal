<?php
    $searchStr = isset($_POST['searchStr']) ? $_POST['searchStr'] : '';
    error_log($searchStr, 0);
    echo $searchStr;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
