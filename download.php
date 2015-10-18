<?php
$fileName = isset($_POST['fileName']) ? $_POST['fileName'] : "";
header('Content-Disposition: attachment; filename="'.$fileName.'"');
readfile($fileName);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
