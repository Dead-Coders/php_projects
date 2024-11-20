


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}


    //  display the form for updating the project
    //   send data to update_project_sql.php by POST method
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
        <form action="update_project_sql.php" onsubmit="return Validate()" method="post">
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
                    <th colspan="2">Update Project</th>
                </tr>
            <?php
            try{
                if(!isset($_GET['id']))
                {
                    header("location:../project.php?msg=please provide project id");
                }
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query=$dbhandler->prepare("select * from projects where project_id=?");
                $query->execute(array($_GET['id']));
                $r=$query->fetch();
                if($r==null)
                {
                    header("location:../project.php?msg=project id not available");
                }
                else{
                    echo '<tr>
                    <td>Project Id</td>
                    <td><input type="hidden" id="id" name="p_id" value="'.$r['project_id'].'">'.$r['project_id'].'</td>
                </tr>
                <tr>
                    <td>Definition</td>
                    <td><input type="text" id="definition" class="textbox" name="p_definition" value="'.$r['definition'].'" required></td>    
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea row="3" id="description" cols="30" class="textbox" name="p_description">'.$r['description'].'</textarea></td>
                </tr>
                
                <tr>
                    <td>Enable project to display</td>
                    <td><input type="checkbox" name="p_enable" ';if($r['enable']){echo 'checked';}else{echo 'unchecked';}echo '></td>
                </tr>';
                }
            }
            catch (PDOException $e){
                header("location:../project.php?msg=hi");
            }
            ?>
                <tr>
                    <td colspan="2">&emsp;&emsp;<input type="submit" class="button shadow" value="UPDATE PROJECT">&emsp;&emsp;&emsp;
                    <input type="reset" class="button shadow" value="Reset"></td>
                </tr>
            </table>
        </form>
    </body>
</html>

