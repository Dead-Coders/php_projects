


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}


    //  display the form for inserting the project
    //   send data to insert_project_sql.php by POST method
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
        <script type="text/javascript" src="validate.js"></script>
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="../project.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>        
        <form action="insert_project_sql.php" onsubmit="return Validate()" method="post">
            <h3 class="msg">
                <?php
                if(isset($_GET['msg']))
                {
                    echo $_GET['msg'];
                }
                ?>
            </h3>
            <br>
            <table align="center" border="1">
                <tr>
                    <th colspan="2">New Project</th>
                </tr>
                <tr>
                    <td>Project Id</td>
                    <td><input type="text" id="id" class="textbox" name="p_id" required></td>
                </tr>
                <tr>
                    <td>Definition</td>
                    <td><input type="text" id="definition" class="textbox" name="p_definition" required></td>  
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea rows="3" id="description" cols="30" class="textbox" name="p_description" ></textarea></td>
                </tr>
                
                <tr>
                    <td>Project Enable</td>
                    <td><input type="checkbox" name="p_enable" checked></td>
                </tr>
                <tr>
                    <td colspan="2">&emsp;&emsp;<input type="submit" class="button shadow" value="ADD PROJECT">&emsp;&emsp;&emsp;
                    <input type="reset" class="button shadow" value="Reset"></td>
                </tr>
            </table>
        </form>
    </body>
</html>

