


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
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="../faculty.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>        <br>
        <h3 class="msg"><?php if(isset($_GET['msg']))
        {
            echo $_GET['msg'];
        }
            ?></h3>
        <br>
        <form>
            <table align="center" border="1">
                <tr>
                    <th>Faculty Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Update faculty details</th>
                    <th>Delete</th>
                    
                </tr>
                <?php
                $count=0;
                    try{
                        $dbhandler=new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql='select * from faculty where enable=0';
                        
                        $query=$dbhandler->query($sql);                 //   there is some problem here
                        
                        while($r=$query->fetch())
                        {
                     
                                echo '<tr>'
                                . '<td>'.$r['faculty_id'].'</td>'
                                . '<td>'.$r['name'].'</td>'
                                . '<td>'.$r['email'].'</td>'
                                . '<td>'.$r['contact_no'].'</td>'
                                . '<td><a href="update_faculty.php?id='.$r['faculty_id'].'">update</a></td>'
                                . '<td><a href="delete_faculty_sql.php?id='.$r['faculty_id'].'">delete</a></td>'
   
                                        .'</tr>';
                               $count++;
                        }
                        
                    } catch (Exception $ex) {
                        echo 'hello! There is some error!';
                    }
                    
                    echo '<tr>
                    <td colspan="6"><br></td>
                </tr>
                
                <tr>
                    <td colspan="6"><b>DISABLED FACULTIES</b></td>
                </tr>
                <tr>
                    <td colspan="6">Total : '.$count.'</td>
                </tr>';
                ?>
            </table>
        </form>
        
    </body>
</html>
