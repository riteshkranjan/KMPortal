<form action="addDataUtil.php" method="post" enctype="multipart/form-data">
    <table border=0 width="100%">

        <tr>
            <td>
                <?php
                $resultArray = splitString($appDiagrams, ",");

                for ($i = 1; $i <= count($resultArray); $i++) {
                    echo "<input title=\"View " . $entityName . " Interface Diagram\" type=\"button\" style=\"background-color: #FFE4C4;border-color: black\"";
                    echo " value=\"Interface Diagram " . $i . "\" onclick=\"window.open('OpenImage.php?appName=" . $entityName . "&filePath=" . $resultArray[$i - 1];
                    echo "','window','width=800,height=600,scrollbars=1,resizable=1')\"></input>&nbsp";
                }
                ?>
            </td>

        <div id="appPage" style="display:none">  
            <td align="right">
                <label for="file"><font style="color: black;size:10pt">Upload more Diagrams:</font></label>
                <input type="file" name="file" id="file" /> 
            </td>
            <td align="center">
                <input type="hidden" name="actionId" value="<?php echo $actionId; ?>"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit"  value="Submit" name="Update" />
            </td>
            </tr>


    </table>
</form>