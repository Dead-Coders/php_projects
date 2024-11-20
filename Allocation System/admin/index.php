


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:admin_login.php?msg=AUTHENTICATION REQUIRED");
}
?>


<!--         display all the stuff    -->

<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>
    <body>
        <h1 align="center">Student Project Allocation System</h1>
        <br>
        <h3 align="center"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>
        <br>
        <h3 class="msg">
                        <?php 
                            if(isset($_GET['msg']))
                                echo $_GET['msg'];
                        ?>
        </h3>
        <br>
        <a href="student.php">Student Details</a>
        <br><br>
        <a href="project.php">Project Details</a>
        <br><br>
        <?php
        
        if(isset($_SESSION['admin']))
        {
            echo '<a href="faculty.php">Faculty Details</a><br><br><a href="allocation/allocation_process.php">Allocation Process</a>';
        }
        ?>
        <br>
        <br>
        <br>
        <a href="../change_pass/change_password.php">Change Password</a>
    </body>
</html>