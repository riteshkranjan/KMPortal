<html>
    <head>
        <title>BT Neo AIB - KM Portal</title>
        <script type="text/javascript">
            function Toggle(thediv) {
                if(thediv == 'intfPage'){
                    document.getElementById(thediv).style.display = "block";
                    document.getElementById('appPage').style.display = "none";
                }else{
                    document.getElementById(thediv).style.display = "block";
                    document.getElementById('intfPage').style.display = "none";
                }
            }
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
                        document.getElementById("livesearch").style.position="absolute";

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
        <form name="form_1">
            <table width ="100%" border="0">
                <tr>
                    <td align="center"><br/>
                        <input type="radio" name="radio_1" id ="1" value="intf" onClick="Toggle('intfPage');">
                        <font style="color: #CD3700;font-family:arial;size:21pt"><b>Add/modify Information</b></font>
                    </td>
                    <td align="center"><br/>
                        <input type="radio" name="radio_1" id="2" value="app" onClick="Toggle('appPage');">
                        <font style="color: #CD3700;font-family:arial;size:21pt"><b>Add Application</b></font>
                    </td>
                </tr>
            </table>
        </form>
        <form action="addDataUtil.php" method="post" enctype="multipart/form-data">
            <div id="intfPage" style="display:none">
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
                                        <font style="color: black;size:10pt">Keyword* : </font>
                                        <input id="ritesh" type="text" name="InterfaceName"  size="40" onkeyup="showResult(this.value)" value=""/>
                                        <div onclick="" id="livesearch" style="background-color: white;elevation: lower;left:168px;position: inherit"  draggable="true"></div>
                                    </td>
                                    <td align="right">
                                        <font style="color: black;size:10pt">Full Form : </font>
                                        <input align="right" type="text" name="FullForm"  size="40" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br/>
                                        <font style="color: black;size:10pt">Type* :</font>
                                        <!--input type="text" name="Type"  size="38" value=""/-->
                                        <label for="Type"></label>
                                        <?php
                                        $infoType = array();
                                        $infoType[0] = "Application/Interface";
                                        $infoType[1] = "KSU/KCI/ACT";
                                        $infoType[2] = "Message";
                                        $infoType[3] = "Journey";
                                        $infoType[4] = "Module/Capability";
                                        $infoType[5] = "Just a term";
                                        $infoType[6] = "BT Product";
                                        $infoType[7] = "KM Tips";
                                        $infoType[8] = "Not Known";
                                        createDropdown($infoType, $infoType, 'Type', "");
                                        ?>
                                    </td> <td align="right">
                                        <font style="color: black;size:10pt">Related To* :</font>
                                        <label for="SelectAppNames"></label>
                                        <?php createDropdown($appNames, $appIds, 'SelectAppNames', 0); ?>
                                    </td></tr>
                            </table>
                            <table width="100%" border="0">
                                <tr>
                                    <td><br/>
                                        <font style="color: black;size:10pt">Detailed Description : </font>
                                        <textarea rows="4" cols="50" name="InterfaceDesc"  value=""></textarea> 


                                    </td> <td align="right">
                                        <font style="color: black;size:10pt">Interface Description : </font>
                                        <textarea rows="4" cols="50" name="remarks"  size="50" value=""></textarea> 
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" border="0">
                                <tr>
                                    <td align="left"><br/>
                                        <font style="color: black;size:10pt">Additional Search Key : </font>
                                        <input type="text" name="relatedWord"  size="40" value=""/>
                                    </td>
                                    <td align="right">
                                        <label for="intfFile"><font style="color: black;size:10pt">Upload Diagram :</font></label>
                                        <input type="file" name="intfFile" id="intfFile" />
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" border="0">
                                <tr>
                                    <td align="center">
                                        <input type="submit"  value="Submit" name="submit" />
                                        <input type="hidden" name="actionId" value="intf"/>
                                        <input type="hidden" name="fileKey" value="intfFile"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <form action="addDataUtil.php" method="post" enctype="multipart/form-data">
            <div id="appPage" style="display:none">
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
                                        <font style="color: black;size:10pt">Application Name : </font>
                                        <input type="text" name="appName"  size="37" value=""/>
                                    </td>
                                    <td align="right">
                                        <font style="color: black;size:10pt">Full Form : </font>
                                        <input type="text" name="FullForm"  size="50" value=""/>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" border="0">
                                <td>
                                    <br/>
                                    <font style="color: black;size:10pt">Description : </font>
                                    <textarea rows="4" cols="50" name="desc"  size="50" value=""></textarea> </td>
                                <td align="right">
                                    <label for="appFile"><font style="color: black;size:10pt">Upload Diagram :</font></label>
                                    <input type="file" name="file" id="appFile" />
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
            </div>
        </form>
        <?php include("footer.php"); ?>
    </body>
</html>

