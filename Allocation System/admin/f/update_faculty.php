

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
        <script type="text/javascript" src="validate.js"></script>
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="../faculty.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>        
        <form action="update_faculty_sql.php" onsubmit="return Validate()" method="post">
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
                    <th colspan="2">Update Faculty</th>
                </tr>
            <?php
            try{
                if(!isset($_GET['id']))
                {
                    header("location:../faculty.php?msg=please provide proper id");
                }
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query=$dbhandler->prepare("select * from faculty where faculty_id=?");
                $query->execute(array($_GET['id']));
                $r=$query->fetch();
                if($r==null)
                {
                    header("location:../faculty.php?msg=faculty with provided id is not available");
                }
                else{
                    echo '<tr>
                    <td>* Faculty Id</td>
                    <td><input type="hidden" id="id" name="f_id" value="'.$r['faculty_id'].'">'.$r['faculty_id'].'</td>
                </tr>
       
                <tr>
                    <td>* Name</td>
                    <td><input type="text" id="name" class="textbox" name="f_name" value="'.$r['name'].'" required></td>
                </tr>
       
                <tr>
                    <td>Email</td>
                    <td><input type="email" id="email" class="textbox" name="f_email" value="'.$r['email'].'"></td>
                </tr>
                <tr>
                    <td>Contact no.</td>
                    <td><input type="text" id="no" class="textbox" name="f_contact" value="'.$r['contact_no'].'"></td>
                </tr>
                <tr>
                    <td>Faculty Enable</td>
                    <td><input type="checkbox" name="f_enable" ';if($r['enable']){echo 'checked';}else{echo 'unchecked';}echo '></td>
                </tr>';
                }
            }
            catch (PDOException $e){
                header("location:../faculty.php?msg=hi");
            }
            ?>
            
                
               <tr>
                    <td colspan="2">&emsp;&emsp;<input type="submit" class="button shadow" value="UPDATE FACULTY">&emsp;&emsp;&emsp;
                    <input type="reset" class="button shadow" value="Reset"></td>
                </tr>
            </table>
            <?php
                echo '<a href="change_faculty_password.php?id='.$_GET['id'].'" >change faculty password</a>';
            ?>
        </form>
        <br><h4>
            <h3><i><ul>&nbsp;&nbsp;&nbsp;Notes</ul></i></h3>
            Faculty id can't change
            <br>
            Provide proper Name
            <br>
            <br>
            *  Required Details
            
        </h4>
    </body>
</html>

