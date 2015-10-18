<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

    </head>
    <body>
        <?php
        $imagepath = "Data/".$_GET["filePath"];
        $appName = $_GET["appName"];
        ?>
        <form id="DownloadForm" name="DownloadForm" method="post" action="download.php">

            <table width="700" border=0>
                <tr>
                    <td width="500" align="center" style="color: blue" valign=middle>
                        <h1><?php echo $appName ?></h1>

                    <td align="center" width="100">
                        <input title="Close Window" type="button" value="Close" onclick="window.close()">
                    </td>
                    <td align="center" width="100">
                        <input title="Download Interface Diagram" type="submit"  value="Download" name="Download" />
                        <input type="hidden" value="<?php echo $imagepath; ?>" name="fileName"/>
                        <!--button title="Download Interface Diagram" onclick="window.location=' //php echo $imagepath  '">Download</button-->
                    </td>
                </tr>
            </table>
        </form>

        <table width="700" border=0>
            <tr>
                <td width="800" align="center" style="color: blue" valign=middle
                    height=700><img src="<?php echo $imagepath ?>" border="3" height="700"
                                width="800"/>
                </td>
            </tr>
        </table>

    </body>
</html>
