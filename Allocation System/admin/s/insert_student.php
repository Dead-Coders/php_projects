


<?php
session_start();
if(!isset($_SESSION['faculty']))
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
        <h3 align="left"><a href="../student.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>        
        <form action="insert_student_sql.php" onsubmit="return Validate()" method="post">
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
                    <th colspan="2">New Student</th>
                </tr>
                <tr>
                    <td>* Student Id</td>
                    <td><input type="text" id="id" class="textbox" name="s_id" required></td>
                </tr>
                <tr>
                    <td>* Birth Date</td>
                    <td><input type="date" id="date" class="textbox" name="s_birthday" required></td>     <!--   uses birthdate as password initially   -->
                </tr>
                <tr>
                    <td>* CPI</td>
                    <td><input type="text" id="cpi" class="textbox" name="s_cpi" required></td>
                </tr>
                <tr>
                    <td>* First Name</td>
                    <td><input type="text" id="name1" class="textbox" name="s_f_name" required></td>
                </tr>
                <tr>
                    <td>* Last Name</td>
                    <td><input type="text" id="name2" class="textbox" name="s_l_name" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" id="email" class="textbox" name="s_email"></td>
                </tr>
                <tr>
                    <td>Contact no.</td>
                    <td><input type="text" id="no" class="textbox" name="s_contact"></td>
                </tr>
                <tr>
                    <td>Student can participate...</td>
                    <td><input type="checkbox" name="s_participate" checked></td>
                </tr>
                <tr>
                    <td colspan="2">&emsp;&emsp;<input type="submit" class="button shadow" value="ADD STUDENT">&emsp;&emsp;&emsp;
                    <input type="reset" class="button shadow" value="Reset"></td>
                </tr>
            </table>
        </form>
        <br><h4>
            <h3><i><ul>&nbsp;&nbsp;&nbsp;Notes</ul></i></h3>
            Student id must be between 1 to 6 digit
            <br>
            We consider birthdate as student's initial password later can changeability
            <br>
            password in this formate  :  yyyy-mm-dd
            <br>
            <br>
            *  Required Details
        </h4>
    </body>
</html>

