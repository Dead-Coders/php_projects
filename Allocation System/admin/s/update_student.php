


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}


    //  display the form for updating the student
    //   send data to update_student_sql.php by POST method
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
        <h3 align="left"><a href="../student.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>       
        <form action="update_student_sql.php" onsubmit="return Validate()" method="post">
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
                    <th colspan="2">Update Student</th>
                </tr>
            <?php
            try{
                if(!isset($_GET['id']))
                {
                    header("location:../student.php?msg=id value problem");
                }
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query=$dbhandler->prepare("select * from students where student_id=?");
                $query->execute(array($_GET['id']));
                $r=$query->fetch();
                if($r==null)
                {
                    header("location:../student.php?msg=student id not available");
                }
                else{
                    echo '<tr>
                    <td>* Student Id</td>
                    <td><input type="hidden" name="s_id" id="id" value="'.$r['student_id'].'">'.$r['student_id'].'</td>
                </tr>
                <tr>
                    <td>* Birth Date</td>
                    <td><input type="date" class="textbox" id="date" name="s_birthday" required>'.$r['birthdate'].'</td>    
                </tr>
                <tr>
                    <td>* CPI</td>
                    <td><input type="text" class="textbox" id="cpi" name="s_cpi" value="'.$r['cpi'].'" required></td>
                </tr>
                <tr>
                    <td>* First Name</td>
                    <td><input type="text" class="textbox" id="name1" name="s_f_name" value="'.$r['first_name'].'" required></td>
                </tr>
                <tr>
                    <td>* Last Name</td>
                    <td><input type="text" class="textbox" id="name2" name="s_l_name"  value="'.$r['last_name'].'" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" class="textbox" id="email" name="s_email" value="'.$r['email'].'"></td>
                </tr>
                <tr>
                    <td>Contact no.</td>
                    <td><input type="text" class="textbox" id="no" name="s_contact" value="'.$r['contact_no'].'"></td>
                </tr>
                <tr>
                    <td>Student can participate...</td>
                    <td><input type="checkbox" name="s_participate" ';if($r['participate']){echo 'checked';}else{echo 'unchecked';}echo '></td>
                </tr>';
                }
            }
            catch (PDOException $e){
                header("location:../student.php?msg=hi");
            }
            ?>
            
                
                <tr>
                    <td colspan="2">&emsp;&emsp;<input type="submit" class="button shadow" value="UPDATE STUDENT">&emsp;&emsp;&emsp;
                    <input type="reset" class="button shadow" value="Reset"></td>
                </tr>
            </table>
            <?php
                echo '<a href="change_student_password.php?id='.$_GET['id'].'" >change student password</a>';
            ?>
        </form>
        <br><h4>
            <h3><i><ul>&nbsp;&nbsp;&nbsp;Notes</ul></i></h3>
            Student id must be between 1 to 6 digit
            <br>
            
            *  Required Details
        </h4>
        
    </body>
</html>

