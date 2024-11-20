

<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}


    //  display the form for inserting the student
    //   send data to insert_student_sql.php by POST method
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
        <form action="insert_faculty_sql.php" onsubmit="return Validate()" method="post">
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
                    <th colspan="2">New Faculty</th>
                </tr>
                <tr>
                    <td>* Faculty Id</td>                                       <!--   uses id as password initially   -->
                    <td><input type="text" id="id" class="textbox" name="f_id" required></td>
                </tr>
                
            
                <tr>
                    <td>* Name</td>
                    <td><input type="text" id="name" class="textbox" name="f_name" required></td>
                </tr>
          
                <tr>
                    <td>Email</td>
                    <td><input type="email" id="email" class="textbox" name="f_email"></td>
                </tr>
                <tr>
                    <td>Contact no.</td>
                    <td><input type="text" id="no" class="textbox" name="f_contact"></td>
                </tr>
                <tr>
                    <td>Faculty enable...</td>
                    <td><input type="checkbox" name="f_enable" checked></td>
                </tr>
                <tr>
                    <td colspan="2">&emsp;&emsp;<input type="submit" class="button shadow" value="ADD FACULTY">&emsp;&emsp;&emsp;
                    <input type="reset" class="button shadow" value="Reset"></td>
                </tr>
            </table>
        </form>
        <br><h4>
            <h3><i><ul>&nbsp;&nbsp;&nbsp;Notes</ul></i></h3>
            Faculty id must be between 1 to 6 digit
            <br>
            Please provide proper Name, Email & Contact No.
            <br>
            Id is the initial password for faculty later it can change
            <br>
            <br>
            *  Required Details
            
        </h4>
    </body>
</html>

