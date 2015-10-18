<html>
    <head>
       <title>KM Portal</title>
    </head>
    <body>
        <?php
        include("header.php");
        if (isset($_COOKIE['Installation'])) {
            setcookie("Installation", "", time() - 3600);
            echo '<script language="javascript">alert("Congratulation!! Databse configured successfully. KM portal is now ready.")</script>';
        }
        if (isset($_COOKIE['msg'])) {
            //echo '<script language="javascript">alert("'.$msg.'")</script>';
            //echo $_COOKIE['msg'];
            if ($_COOKIE['msg'] != "") {
                $msg = $_COOKIE['msg'];
                echo '<script language="javascript">alert("' . $msg . '")</script>';
                setcookie("msg", "", time() - 3600);
            }
        }
        ?>
        <table border=0 width="100%">
            <tr >
                <td align="center" style="color: #A62A2A" valign=middle>
            <font size=14pt font=arial><u> Your app name </u></font>
        </td>
    </tr>
</table>
<table  border=0 bordercolor=orange width="100%">
    <tr>
<!--        <td width="15%" >
            <font style="color: #CD3700;font-family:arial;size:11pt"><b><u> MOTS-ID:</u></b> </font>
            <a href="javascript:;" title="Open Mots Link" onClick="window.open('http://ebiz.sbc.com/mots/detail.cfm?appl_id=5617','no','scrollbars=yes,width=550,height=400')" ><font style="color: black;font-family:arial;size:11pt">5617</font></a>
        </td>	-->

        <td width="45%">
            <font style="color: #CD3700;font-family:arial;size:11pt"><b><u>Acronym:</u></b> </font> <font style="color: black;font-family:arial;size:11pt">Full form </font>
        </td>


        <td width="20%" >
            <form>
                <input type="button"  title="View Interface Diagram" style="background-color: #FFE4C4;border-color: black" align="center" value="View Diagram" onclick="window.open('OpenImage.php?filePath=appname.jpg&appName=App name','window','width=800,height=600,scrollbars=1,resizable=1')"/>
            </form>

        </td>
    </tr>
</table>
<table width="100%" border=1 bordercolor=orange>
    <tr>
        <td style="color: black" valign="middle">
            <p align="justify"> <font style="color: black;font-family:arial;size:10pt"><br/>
               Please add introduction about your application here in index.php
                </br></br>

               Please add introduction about your application in detai here in index.php

                </font></p><br/>
        </td>
    </tr>
</table>
<marquee behavior=alternate><font style="color:red;size:2pt"> <?php echo getPortalUsageReport(); ?></font></marquee>

<?php include("footer.php"); ?>

</body>
</html>
