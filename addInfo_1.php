<html>
    <head>
        <title>AIB Interface Diagram</title>
        <script type="text/javascript">
            function showResult(str)
            {
                if (str.length==0)
                {
                    document.getElementById("livesearch").innerHTML="";
                    document.getElementById("livesearch").style.border="0px";
                    return;
                }
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
                        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                        document.getElementById("livesearch").innerHTML.scrollHeight="10";
                    }
                }
                xmlhttp.open("GET","livesearch.php?q="+str,true);
                xmlhttp.send();
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
        <form action="addResponse.php" method="post">
            <table width="100%" border="1" bordercolor=orange>
                <tr style="background-color: whitesmoke" >
                    <td>
                        <table width="100%" border="1" bordercolor=orange>
                            <tr style="background-color: whitesmoke" >
                                <td align="center"></br><font style="color: #CD3700;font-family:arial;size:21pt"><b> Add or Modify new Information</b></td>
                            </tr>
                        </table>

                        <table width="100%" border="0">
                            <tr>
                                <td>
                                    <font style="color: black;size:10pt">Enter Information Name</font>
                                    <input id="ritesh" type="text" name="InterfaceName"  size="40" onkeyup="showResult(this.value)" value=""/>
                                    <div onclick="" id="livesearch" style="background-color: white"  draggable="true"></div>
                                </td>
                                <td align="right">
                                    <font style="color: black;size:10pt">Full Form</font>
                                    <input align="right" type="text" name="FullForm"  size="29" value=""/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br/>
                                    <font style="color: black;size:10pt"> Enter Type of Information</font>
                                    <input type="text" name="Type"  size="38" value=""/>
                                </td> <td align="right">
                                    <font style="color: black;size:10pt">Interfacing AIB Application Names</font>
                                    <label for="SelectAppNames"></label>
                                    <?php createDropdown($appNames, $appIds, 'SelectAppNames', $lastAppName); ?>
                                </td></tr>
                        </table>
                        <table width="100%" border="0">
                            <tr>
                                <td><br/>
                                    <font style="color: black;size:10pt">More Description</font>
                                    <input type="text" name="InterfaceDesc"  size="46" value=""/>
                                </td> <td align="right">
                                    <font style="color: black;size:10pt">Interface Details</font>
                                    <input type="text" name="remarks"  size="50" value=""/>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" border="0">
                            <tr>
                                <td align="left"><br/>
                                    <font style="color: black;size:10pt">Enter search Keywords</font>
                                    <input type="text" name="relatedWord"  size="40" value=""/>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" border="0">
                            <tr>
                                <td align="center">
                                    <input type="submit"  value="Submit" name="submit" />
                                    <input type="hidden" name="actionId" value="intf"/>
                                </td>
                            </tr>
                        </table>
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

