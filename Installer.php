<?php
$sqlErrorText = '';
$sqlErrorCode = 0;
$sqlStmt = '';
$sqlFileToExecute = '/var/www/KMPortal/sql/PrepareDB.sql';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>BT Neo AIB - KM Portal</title>
    </head>
    <body>
        <table width="30%" bgcolor="aquatic" align="center" border="1">
            <tr>
                <td align="center">
                    <p>  Alert!!!! AIB Database is not configured. Please provide mysql server path to install necessary DB, tables and DATA.</p>
                </td>
            </tr>
        </table>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
            <table width="30%" bgcolor="aquatic" align="center" border="1">
                <tr><td>
                        <table width="100%" border="0">
                            <tr>
                                <td align="right" width="50%">Host name *</td>
                                <td><input name="hostname" type="text" /></td>
                            </tr>
                            <tr>
                                <td align="right">Username *</td>
                                <td><input name="username" type="text" /></td>
                            </tr>
                            <tr>
                                <td align="right">Password *</td>
                                <td><input name="password" type="password" /></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2">
                                    <input type="submit" name="submitBtn" value="Install" />
                                </td>
                            </tr>

                        </table>  <tr>
                            <td align="center">If installation is completed successfully, you will be redirected to home page. Best of luck!!</td>
                        </tr></td></tr></table> 
        </form>
        <?php
        if (isset($_POST['submitBtn'])) {
            $host = isset($_POST['hostname']) ? $_POST['hostname'] : '';
            $user = isset($_POST['username']) ? $_POST['username'] : '';
            $pass = isset($_POST['password']) ? $_POST['password'] : '';
            try {
                $con = mysql_connect($host, $user, $pass); // or die("<br><b><u> Connection error. Please provide correct credentials. mostly hostname is LOCALHOST, Username is ROOT and Password is empty</u></b><br/>");
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
            if ($con !== false) {
                // Load and explode the sql file
                if($f = fopen($sqlFileToExecute, "r+")){
                $sqlFile = fread($f, filesize($sqlFileToExecute));
                $sqlArray = explode(';', $sqlFile);

                //Process the sql file by statements
                foreach ($sqlArray as $stmt) {
                    if (strlen($stmt) > 3) {
                        $result = mysql_query($stmt);
                        if (!$result) {
                            $sqlErrorCode = mysql_errno();
                            $sqlErrorText = mysql_error();
                            $sqlStmt = $stmt;
                            break;
                        }
                    }
                }
                }
                echo '<table width="100%">';
                if ($sqlErrorCode == 0) {
                    echo "<tr><td>Installation completed succesfully!</td></tr>";
                    //$_POST['msg'] = "hi ritesh";
                    setcookie("Installation", "completed");
                    echo '<script language="javascript">alert("Congratulation!! Databse configured successfully. AIB KM portal is now ready.")</script>';
                    header("Location: index.php");
                } else {
                    echo "<tr><td>An error occured during installation!</td></tr>";
                    echo "<tr><td>Error code: $sqlErrorCode</td></tr>";
                    echo "<tr><td>Error text: $sqlErrorText</td></tr>";
                    echo "<tr><td>Statement:<br/> $sqlStmt</td></tr>";
                }
                echo '</table>';
            }
        }
        ?>
    </body>    
