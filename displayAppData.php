<html>
   <head>
    <title>BT Neo AIB - KM Portal</title>
</head>

    <body>
        <?php
        include("header.php");
        $appId = isset($_POST["SelectAppNames"]) ? $_POST["SelectAppNames"] : '';
        require_once 'DBLogic.php';
        $appAllData = getAppInfo($appId);
        $appNames[0] = $appAllData[0]['app_name'];
        $appId[0] = $appAllData[0]['app_id'];
        $appDescs[0] = $appAllData[0]['app_desc'];
        $appDiagrams = $appAllData[0]['app_intf_diagram'];
        $appfullfrom[0] = $appAllData[0]['FULLFORM'];
        $entityName = $appNames[0];
        logRequest("View", $appNames[0]);
        ?>
        <table border=0 width="100%">
            <tr>
                <td>
                    <?php
                    $_POST["searchStr"] = "";
                    ?>
                    <table border=0 width="100%">
                        <tr>
                            <td width="100%" align="center" style="color: #A62A2A" valign=middle>
                        <font size=20pt font=arial><u> <?php echo $entityName; ?> </u></font>
                </td>
            </tr>
        </table>
                  
          
        <?php 
        $actionId = "appUpdate";
        $id = $appId;
        include("ImageDisplay.php"); 
        ?>

        <table border=2 bordercolor=orange width="100%">
            <tr><td>	
                    <table width="100%" border=0>	
                        <tr>
                            <td>
                                <font style="color: #CD3700;font-family:arial;size:11pt"> <b><u> Full Name:</u></b></font>
                                <p align="justify"><font style="color: black;font-family:arial;size:11pt"><?php echo $appfullfrom[0] ?> </font></p>
                            </td>

                        </tr>
                        <tr><td>&nbsp</td></tr>
                        <tr>
                            <td>
                                <font style="color: #CD3700;font-family:arial;size:11pt"><b><u> Description:</u></b></font>
                                <p align="justify"> <font style="color: black;font-family:arial;size:11pt"> <?php echo $appDescs[0] ?> </font></p>
                            </td>
                        <tr>
                    </table>

                </td></tr>
        </table>
    </td></tr>
</table>
<?php include("footer.php"); ?>
</body>
</html>