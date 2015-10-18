<html>
    <head>
        <title>AIB Interface Diagram</title>
    </head>
    <body bgcolor="white">
        <?php include("header.php"); ?>
        <?php
        require_once 'DBLogic.php';
        $searchStr = isset($_POST['searchStr']) ? $_POST['searchStr'] : '';
        //echo "<br/>";
        //echo "searchStr =" . $searchStr;
        $searchData = searchKeyword($searchStr, -1);
        for ($i = 0; $i < count($searchData); $i++) {
            $keywordId[$i] = $searchData[$i]['keyword_id'];
            $keywordName[$i] = $searchData[$i]['keyword_name'];
            $type[$i] = $searchData[0]['type'];
            $relatedWord[$i] = $searchData[$i]['related_word'];
            $keywordInfo[$i] = $searchData[$i]['keyword_info'];
            $keywordDesc[$i] = $searchData[$i]['keyword_desc'];
            $keywordAppMappingData = searchKeywordAppMapping($keywordId[$i]);
//            $appNames[$i] = "";
//            for ($j = 0; $j < count($keywordAppMappingData); $j++) {
//                $appIds = $keywordAppMappingData[$j]['app_id'];
//                $appData = getAppInfo($appIds);
//                if ($j == 0) {
//                    $appNames[$i] = $appData[0]['app_name'];
//                } else {
//                    $appNames[$i] = $appData[0]['app_name'] . "," . $appNames[$i];
//                }
//                 echo "<br/>";
//                echo "mapping data seacrhe for ".$appIds[$j]. " result=". $appNames[$i];
//            }
            //echo "<br/>";
            //echo "whole data= " . $relatedWord[$i] . " " . $keywordInfo[$i] . " " . $keywordId[$i];

            //echo $appNames[$i];
        }
        $max_count = count($searchData);
        $max_per_page = 5;
        if ($max_count < $max_per_page) {
            $max_per_page = $max_count;
        }
        $start_index = isset($_POST['startIndex']) ? $_POST['startIndex'] : 0;
        $start_index = ($start_index - 1) * 5;
        if ($start_index + 5 > $max_count) {
            $end_index = $max_count % 5;
        } else {
            $end_index = $start_index + 5;
        }
        // echo "startindex=".$start_index." endindex=".$end_index;
//        $keywordId = $searchData[0]['keyword_id'];
//        $type = $searchData[0]['type'];
//        $relatedWord = $searchData[0]['related_word'];
//        $keywordInfo = $searchData[0]['keyword_info'];
//        $keywordDesc = $searchData[0]['keyword_desc'];
//        $keywordAppMappingData = searchKeywordAppMapping($keywordId);
//        $appIds = array();
//        $appNames = array();
//        for ($i = 0; $i < count($keywordAppMappingData); $i++) {
//            $appIds[$i] = $keywordAppMappingData[$i]['app_id'];
//            $appData = getAppInfo($appIds[$i]);
//            $appNames[$i] = $appData[0]['app_name'];
//        }
        ?>
        <table width=100% border=0>
            <tr>
                <td width="100%" align="left" style="color: #A62A2A" valign=middle
                    height="10%"><font size=5pt font=arial><u><?php echo $searchStr ?> found at
                below places: </u></font></td>
    </tr>
    <tr>
        <td>&nbsp</td>
    </tr>
</table>
<form></form>
<?php
for ($i = $start_index; $i < $end_index; $i++) {
    $keywordName[$i] = str_replace($searchStr, "<font style=\"color: blue;\">" . $searchStr . "</font>", $keywordName[$i]);
    $relatedWord[$i] = str_replace($searchStr, "<font style=\"color: blue;\">" . $searchStr . "</font>", $relatedWord[$i]);
    $keywordDesc[$i] = str_replace(strtolower($searchStr), "<font style=\"color: blue;\">" . $searchStr . "</font>", $keywordDesc[$i]);
    ?>

    <table width=100% border=0 bordercolor=orange>
        <tr width="100%">
            <td width="25%" align="left" border=0 bordercolor=orange><font
                    style="color: #CD3700;font-family:arial;size:11pt"><b><u>Interfaces:</u></b></font>
                <font style="color: black;font-family:arial;size:11pt"><?php echo $keywordName[$i] ?></font><br />
            </td>

            <td width="25%" align="left" border=0 bordercolor=orange><font
                    style="color: #CD3700;font-family:arial;size:11pt"><b><u>Related word:</u></b></font>
                <font style="color: black;font-family:arial;size:11pt"><?php echo $relatedWord[$i] ?></font><br />
            </td>
            <td width="25%" align="center">

                <form action="SearchResultDecider.php" method="post">

                    <input title="View Interface Diagram" style="background-color: #FFE4C4;border-color: black" type="submit" value="Open Interface" />
                    <input type="hidden" value="<?php echo $searchStr ?>" name="searchStr"/>
                    <input type="hidden" value="1" name="startIndex"/>
                    <input type="hidden" value="<?php echo $i; ?>" name="index"/>
                </form>                
            </td>
        </tr>
    </table>
    <table width=100% border=0 bordercolor=orange>
        <tr width=100%>
            <td align="left"><font style="color: #CD3700;font-family:arial;size:11pt"> <b><u>Application
                        description:</u></b></font>
                <p align=justify><font style="color: black;font-family:arial;size:11pt"><?php echo $keywordDesc[$i] ?></font></p>
            </td>
        </tr>
        <tr>
            <td><b><u>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</u></b></td>
        </tr>
    </table>
<?php } ?>

<?php if (count($searchData) > 5) { ?>
    <table width=100% border=0 bordercolor=orange>
        <tr width="100%">
            <td width="30%" valign="top" align="right">Page:
            </td>
            <?php
            $searchCount = (count($searchData) / 5) + 1;
            for ($i = 1; $i < $searchCount; $i++) {
                ?> 
                <td align="center" width="4pt">
                    <form name="SearchResultDecider.php" method="post">
                        <input type="submit" 
                        <?php
                        if ($_POST['startIndex'] == $i) {
                            echo "disabled";
                        }
                        ?>
                               size="4" value=<?php echo $i; ?> />
                        <input type="hidden" value="<?php echo $searchStr; ?>" name="searchStr"/>
                        <input type="hidden" value="<?php echo $i; ?>" name="startIndex"/>
                        <input type="hidden" value="-1" name="index"/>
                    </form>
                </td> 
            <?php } ?>
            <td align="left" width="<?php echo 100 - $searchCount * 4 ?>"></td>
        </tr>
    </table>
<?php } ?>

<?php include("footer.php"); ?>

</body>
</html>
