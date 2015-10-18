<html>
    <head>
        <title>AIB Interface Diagram</title>
    </head>
    <body bgcolor="white">
        <?php include("header.php"); ?>
        <?php
        require_once 'DBLogic.php';
        $searchStr = isset($_POST['searchStr']) ? $_POST['searchStr'] : '';
        $index = isset($_POST['index']) ? $_POST['index'] : 0;
        $searchData = searchKeyword($searchStr, $index);
        $keywordId = $searchData[0]['keyword_id'];
        $type = $searchData[0]['type'];
        $relatedWord = $searchData[0]['related_word'];
        $keywordInfo = $searchData[0]['keyword_info'];
        $keywordDesc = $searchData[0]['keyword_desc'];
        $keywordAppMappingData = searchKeywordAppMapping($keywordId);
        $appIds = array();
        $appNames = array();
        for ($i = 0; $i < count($keywordAppMappingData); $i++) {
            $appIds[$i] = $keywordAppMappingData[$i]['app_id'];
            $appData = getAppInfo($appIds[$i]);
            $appNames[$i] = $appData[0]['app_name'];
        }
        ?>
        <table width="100%" border=0>
            <tr>
                <td width="100%" align="left" style="color: #A62A2A;;font-family:arial;size:5pt" valign=middle
                    height="10%"><u>Result for: <?php echo $searchStr ?>
                (Related with Application: <?php echo $keywordInfo ?>)</u></td>
    </tr>
    <tr><td>&nbsp</td></tr>
</table>


<table width="100%" border=1 bordercolor=orange>
    <tr width="100%">
        <td width="33%" align="left"><font
                style="color: #CD3700;font-family:arial;size:11pt"> <b>Application Name</b></font>
            <font style="color: black;font-family:arial;size:11pt"><?php echo $type ?></font><br/>
        </td>

        <td width="33%" align="left"><font
                style="color: #CD3700;font-family:arial;size:11pt"><b>Type</b></font> <font style="color: black;font-family:arial;size:11pt"><?php echo $keywordInfo ?></font><br/>
        </td>

        <td width="34%" align="left"><font
                style="color: #CD3700;font-family:arial;size:11pt"><b>Related word:</b></font>
            <font style="color: black;font-family:arial;size:11pt"><?php echo $relatedWord ?></font><br />
        </td>
    </tr>

</table>
<table border=0>
    <tr>
        <td width="34%" align="left"><font style="color: #CD3700;font-family:arial;size:11pt"><b><?php echo $searchStr ?> has interfaces with below AIB/BT applications. Click on interface buttons to view respective interface details</b></font>
        </td>
    </tr>
</table>

<table width="100%" border=0 bordercolor=orange>
    <td align="center">
        <form></form>
    </td>
    <tr>
        <?php for ($i = 0; $i < count($keywordAppMappingData); $i++) { ?>

            <td align="center">
                <form action="SearchResultDecider.php" method="post">
                    <input type="submit" style="background-color: #FFE4C4;border-color: black" value="<?php echo $appNames[$i] ?>" name="formisubmit"/>
                    <input type="hidden" value="<?php echo $appIds[$i] ?>" name="appId"/>
                    <input type="hidden" value="<?php echo $searchStr ?>" name="searchStr"/>
                    <input type="hidden" value="-1" name="index"/>
                    <input type="hidden" value="1" name="startIndex"/>
                </form>
            </td>
        <?php } ?>

    </tr>
</table>
<table width="100%" border=1 bordercolor=orange>
    <tr width="100%">
        <td width="100%" align="left"><font
                style="color: #CD3700;font-family:arial;size:11pt"><b><u>Application
                    description</u></b></font>
            <p align=justify><font style="color: black;font-family:arial;size:11pt"><?php echo $keywordDesc ?></font></p>
        </td>
    </tr>
</table>
<?php include("footer.php"); ?>
</body>
</html>
