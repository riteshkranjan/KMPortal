<head>
   <title>BT Neo AIB - KM Portal</title>
</head>
<body bgcolor="white">
    <?php include("header.php"); ?>
    <?php
    require_once 'DBLogic.php';
    //echo "i m here";
    $searchStr = isset($_POST['searchStr']) ? $_POST['searchStr'] : '';
    $index = isset($_POST['index']) ? $_POST['index'] : 0;
    //echo "in search result=" . $index;
    $searchData = searchKeyword($searchStr, $index);
    $keywordId = $searchData[0]['keyword_id'];
    $type = $searchData[0]['type'];
    $relatedWord = $searchData[0]['related_word'];
    $keywordInfo = $searchData[0]['keyword_info'];
    $keywordDesc = $searchData[0]['keyword_desc'];
    $appDiagrams = $searchData[0]['keyword_diagram'];
    $appIdPosted = isset($_POST['appId']) ? $_POST['appId'] : 0;
    // echo $searchStr;
    // echo $appIdPosted;
    if ($appIdPosted == 0) {
        $keywordAppMappingData = searchKeywordAppMapping($keywordId);
    } else {
        $keywordAppMappingData = searchKeywordAppMappingforRemarks($keywordId, $appIdPosted);
    }
    $appId = $keywordAppMappingData[0]['app_id'];
    $appData = getAppInfo($appId);
    $appName = $appData[0]['app_name'];
    $entityName = $searchData[0]['keyword_name'];
//    $fileNames = $appData[0]['app_intf_diagram'];
//    $outputStr = splitString($fileNames, ",");
    $combinedDesc = $keywordAppMappingData[0]['keyword_app_remarks'];
    //logRequest("Search",$searchStr);
    ?>
    <table width=100% border=0>
        <tr>
            <td width="100%" align="left" style="color: #A62A2A" valign=middle height="10%">
        <font size=5pt font=arial><u>Result for: <?php echo $searchStr ?>(Related with Application:  <?php echo $appName ?>)</u></font>
    </td>
</tr>
</table>

<?php
$actionId = "intfAddDiagram";
$id = $keywordId;
include("ImageDisplay.php")
?>

<table width=100% border=1 bordercolor=orange>
    <tr>
        <td  width="25%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"> <b>Name:</b></font> 
            <font style="color: black;font-family:arial;size:11pt"><?php echo $entityName ?></font><br/></td>

        <td  width="25%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"> <b>Type:</b></font> 
            <font style="color: black;font-family:arial;size:11pt"><?php echo $type ?></font><br/></td>

        <td width="25%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"><b>Interface with:</b></font>  
            <font style="color: black;font-family:arial;size:11pt"><?php echo $appName ?></font><br/></td>
        <td width="25%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"><b>Related word:</b></font>  
            <font style="color: black;font-family:arial;size:11pt"><?php echo $relatedWord ?></font><br/></td>
    </tr>
</table>
<table width=100% border=1 bordercolor=orange>
    <tr>
        <td width="100%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"><b><u>Application description:</u></b></font> 
            <p align=justify><font style="color: black;font-family:arial;size:11pt"><?php echo $keywordDesc ?></font></p></td>
    </tr>

    <tr>
        <td width="100%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"><b><u>Interface Description:</u></b></font> 
            <p align=justify> <font style="color: black;font-family:arial;size:11pt"><?php echo $combinedDesc ?></font></p>
        </td>
    </tr>
</table>
<?php include("footer.php"); ?>
</body>
</html>
