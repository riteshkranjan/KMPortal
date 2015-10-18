<html>
    <head>
        <title>AIB Interface Diagram</title>
        <script type="text/javascript">
            function findTheChecked(){
                var radio_1 = window.document.form_1.radio_1;
                var radio_2 = window.document.form_1.radio_2;

                // the above locates the checkboxes

                if(radio_1.checked == true){ //this finds which one is checked
                    radio_2.checked = false;
                    window.location.replace("addModifyIntf.php"); // change that to the site
                }else{
                    if(radio_2.checked == true){
                        radio_1.checked = false;
                        window.location.replace("addNewApp.php");// change that to the other
                    }
                }
            }
        </script>
    </head>

    <body bgcolor="white">
        <?php
        require_once 'DBLogic.php';
        $allAppData = getAllApps();
        for ($i = 0; $i < count($allAppData); $i++) {
            $appNames[$i] = $allAppData[$i]['app_name'];
            $appIds[$i] = $allAppData[$i]['app_id'];
        }
        $allAppData = getAllApps();
        for ($i = 0; $i < count($allAppData); $i++) {
            $appNames[$i] = $allAppData[$i]['app_name'];
            $appIds[$i] = $allAppData[$i]['app_id'];
        }
        ?>
        <?php include("header.php"); ?>
        <form name="form_1">
            <table width ="100%" border="0">
                <tr>
                    <td align="center"><br/>
                        <input type="radio" name="radio_1" onClick="findTheChecked();">
                        <font style="color: #CD3700;font-family:arial;size:21pt"><b>Add/modify Information</b></font>
                    </td>
                    <td align="center"><br/>
                        <input type="radio" selected="selected" name="radio_2" onClick="findTheChecked();">
                        <font style="color: #CD3700;font-family:arial;size:21pt"><b>Add Application</b></font>
                    </td>
                </tr>
            </table>
        </form>

        <form action="addResponse.php" method="post" enctype="multipart/form-data">
            <table width="100%" border="1" bordercolor=orange>
                <tr style="background-color: whitesmoke">
                    <td>
                        <table width="100%" border="1" bordercolor=orange>
                            <tr style="background-color: whitesmoke" >
                                <td align="center"> <br/><font style="color: #CD3700;font-family:arial;size:21pt"><b>Add new AIB/BT Application</b></td>
                            </tr>
                        </table>
                        <table width="100%" border="0">
                            <tr style="background-color: whitesmoke" >
                                <td>
                                    <font style="color: black;size:10pt">Enter Application Name</font>
                                    <input type="text" name="appName"  size="37" value=""/>
                                </td> 
                                <td align="right">
                                    <font style="color: black;size:10pt">Full Form</font>
                                    <input type="text" name="FullForm"  size="50" value=""/>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" border="0">
                            <td>
                                <br/>
                                <font style="color: black;size:10pt">Description</font>
                                <input type="text" name="desc"  size="50" value=""/> </td>
                            <td align="right">
                                <label for="file"><font style="color: black;size:10pt">Interface Diagram file Upload:</font></label>
                                <input type="file" name="file" id="file" /> 
                            </td>
                </tr>
            </table>
            <table width="100%" border="0">
                <tr>
                    <td align="center">
                        <input type="hidden" name="actionId" value="app"/>
                        <input type="submit"  value="Submit" name="submit" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>    
</form> 

<?php include("footer.php"); ?>
</body>
</html>

