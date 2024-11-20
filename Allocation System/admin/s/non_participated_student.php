


<?php
session_start();
if(!isset($_SESSION['faculty']))
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
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="../student.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3> 
        <h3 class="msg"><?php if(isset($_GET['msg']))
        {
            echo $_GET['msg'];
        }
            ?></h3>
        <br>
        <form>
            <table align="center" border="1">
                <tr>
                    <th>Student Id</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>CPI</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Update student's details</th>
                    <th>Delete</th>
                    
                </tr>
                <?php
                $count=0;
                    try{
                        $dbhandler=new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql='select * from students where participate=0';
                        
                        $query=$dbhandler->query($sql);                 //   there is some problem here
                        
                        while($r=$query->fetch())
                        {
                     
                                echo '<tr>'
                                . '<td>'.$r['student_id'].'</td>'
                                . '<td>'.$r['first_name'].' '.$r['last_name'].'</td>'
                                . '<td>'.$r['birthdate'].'</td>'
                                . '<td>'.$r['cpi'].'</td>'
                                . '<td>'.$r['email'].'</td>'
                                . '<td>'.$r['contact_no'].'</td>'
                                . '<td><a href="update_student.php?id='.$r['student_id'].'">Update</a></td>'
                                . '<td><a href="delete_student_sql.php?id='.$r['student_id'].'">Delete</a></td>'
                                        .'</tr>';
                               $count++;
                        }
                        
                    } catch (Exception $ex) {
                        echo 'hello! There is some error!';
                    }
                    
                    echo '<tr>
                    <td colspan="8"><br></td>
                </tr>
                
                <tr>
                    <td colspan="8"><b>NON PARTICIPATED STUDENTS</b></td>
                </tr>
                <tr>
                    <td colspan="8">Total : '.$count.'</td>
                </tr>';
                ?>
                
        
            </table>
        </form>
        
    </body>
</html>
