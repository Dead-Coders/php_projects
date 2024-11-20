


<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}
?>



<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../../main.css">
        <script type="text/javascript" src="../../change_pass/ch_pass.js"></script>
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="update_faculty.php?id=<?php echo $_GET['id']; ?>"  class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out">Logout</a>&emsp;</h3>        
            <?php
        echo '<form onsubmit="return Validate()" action="change_faculty_password_sql.php?id='.$_GET['id'].'" method="post">';
                ?>
            <table border="1" align="center">
                <tr>
                    <th colspan="2" class="msg"><?php if(isset($_GET['msg'])){echo $_GET['msg'];} ?></th>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td><input type="password" class="textbox" id="passwd" name="new_pass" required></td>
                </tr>
                <tr>
                    <td>Re-enter Password :</td>            
                    <td><input type="password" class="textbox" id="re-passwd" name="re_pass" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="button shadow" value="Change"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
