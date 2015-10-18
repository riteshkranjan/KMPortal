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
       
        <?php include("header.php"); ?>
        <form name="form_1">
            <table width ="100%" border="0">
                <tr>
                    <td align="center"><br/>
                        <input type="radio" name="radio_1" onClick="findTheChecked();">
                        <font style="color: #CD3700;font-family:arial;size:21pt"><b>Add/modify Information</b></font>
                    </td>
                    <td align="center"><br/>
                        <input type="radio" name="radio_2" onClick="findTheChecked();">
                        <font style="color: #CD3700;font-family:arial;size:21pt"><b>Add Application</b></font>
                    </td>
                </tr>
            </table>
        </form>

<?php include("footer.php"); ?>
</body>
</html>

