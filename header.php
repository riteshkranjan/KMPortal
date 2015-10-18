<?php
require_once 'DBLogic.php';
$allAppData = getAllApps();
$page = $_SERVER['PHP_SELF'];
for ($i = 0; $i < count($allAppData); $i++) {
    $appNames[$i] = $allAppData[$i]['app_name'];
    $appIds[$i] = $allAppData[$i]['app_id'];
}

function createDropdown($arr, $ids, $frm, $default) {
    echo '<select id="' . $frm . '" name="' . $frm . '"><option value="">Select one</option>';
    for ($i = 0; $i < count($arr); $i++) {
        if ($ids[$i] == $default) {
            echo '<option selected="Select" value="' . $ids[$i] . '" >' . $arr[$i] . '</option>';
        } else {
            echo '<option value="' . $ids[$i] . '">' . $arr[$i] . '</option>';
        }
    }
    echo '</select>';
}
?>
<table border=0  width="100%">
    <tr>
        <td width="17%" align="left"><img src="images/bt_logo.gif" alt="British Telecom"></td>
        <td align="left">

        <td width="68%" align="center" style="font-size: 40px;font-family: impact;color: #009ACD" valign=middle>
            <b>BT-NEO-AIB: Knowledge Repository</b>
        </td>
        <td width="15%" valign="bottom" align="center" style=color:#607B8B; ><h5>Today's Date: &nbsp; <br/>
                <?php echo(date("m-d-Y")); ?></h5>
        </td>
    </tr>
</table>
<table  border="4" width="100%" bordercolor=orange cellspacing="5">
    <tr style="background-color: cornsilk" >
        <td align="center" width="40%"><br/>
            <font style="color: #CD3700;font-family:arial;size:21pt"><b>Enter Search String</b></font>
            <form action="displaySearchResult.php" method="post">
                <?php
                $searchStr = "";
                if ($_POST != NULL)
                //$searchStr = $_POST["searchStr"];
                    $searchStr = isset($_POST['searchStr']) ? $_POST['searchStr'] : '';
                ?>
                <input onfocus="this.value = ''"
                       onblur="if(this.value=='')this.value='<?php echo $searchStr; ?>'"
                       type="text" name="searchStr"  size="40" value="<?php echo $searchStr; ?>"/>
                <input type="submit"  value="Search" name="Search" />
                <input type="hidden" value="-1" name="index"/>
                <input type="hidden" value="1" name="startIndex"/>
                <input type="hidden" value="<?php echo $page; ?>" name="pageFrom"/>
            </form><br/>
        </td>

        <td align="center" width="40%"><br/><font style="color: #CD3700;font-family:arial;size:11pt"><b>BT Application Details</b></font>
            <form id="appselectForm" name="appselectForm" method="post" action="displayAppData.php">
                <?php
                $lastAppName = "";
                if ($_POST != NULL)
                    $lastAppName = isset($_POST['SelectAppNames']) ? $_POST['SelectAppNames'] : '';
                ?>
                <label for="SelectAppNames"></label>
                <?php createDropdown($appNames, $appIds, 'SelectAppNames', $lastAppName); ?>

                <input title="Click to View Interface Diagram" type="submit" value="View" name="View" />
            </form><br/>
        </td>


        <td align="center" width="20%">
            <form action="addData.php" method="post">
                <input title="Add/modify Portal repository" type="submit" 
                       value="ADD-Modify Info"/>
            </form>
        </td>
    </tr>
</table>