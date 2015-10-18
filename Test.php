<?php?>
//echo $_SERVER['REMOTE_ADDR'];
//echo $_SERVER['REDIRECT_REMOTE_USER'];
<table  border="4" width="100%" bordercolor=orange cellspacing="5">
    <tr style="background-color: cornsilk" >
        <td align="center" width="40%"><br/>
            <font style="color: #CD3700;font-family:arial;size:21pt"><b>Enter Search String</b></font>
            <form action="testResult.php" method="post">
                <input onfocus="this.value = ''"
                       
                       type="text" name="searchStr"  size="40" value=""/>
            </form><br/>
        </td>
    </tr>
</table>

