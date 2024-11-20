<?php
/*
 * ****************************************************************************
 * ****************************************************************************

  HEllo, THis projecT of PHP
  subject - Project Allocation

  c3 Batch sem-4

  CE046	HireN ItaliyA
  CE047	JaganI VatsaL   #
  CE048	MohiT JaiN
  CE049	AkshiT JariwalA

 * ****************************************************************************
 * ****************************************************************************
 */
?>


<?php
session_start();
if(!isset($_SESSION['student_id']) && !isset($_SESSION['faculty']))
{
    header("location:../index.php?msg=AUTHENTICATION REQUIRED");
}
?>

<?php
if(!isset($_SESSION['faculty'])){
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'select * from allocation_process where id=1';
    $query = $dbhandler->query($sql);
    $r = $query->fetch();
    if ($r['process'] == 8) {
        header('location:../index.php?msg=System closed !!!');
    }
} catch (Exception $ex) {
    echo 'problem occur try again ';
}
}
?>

<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../main.css"> 
        <script type="text/javascript" src="ch_pass.js"></script>
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="<?php if(isset($_SESSION['student_id'])){echo '../student/index.php';}else{echo '../admin/index.php';} ?>" class="back shadow"><= Back</a></h3>
        <?php
        if(isset($_SESSION['student_id'])){
        echo '<h3 align="right">Id: '.$_SESSION['student_id'].'  &emsp;       Name : '.$_SESSION['student_name'].' &emsp;<a href="../student/student_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>';
        }
        else{
            echo '<h3 align="right">   &emsp;    Id: '.$_SESSION['faculty'].'  &emsp;       Name : '.$_SESSION['faculty_name'].'&emsp;<a href="../admin/admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>';
        }
        ?>
        <h3 class="msg">
        <?php
                            if(isset($_GET['msg']))
                                echo $_GET['msg'];
                        ?>
        </h3>
        <form onsubmit="return Validate()" action="change_password_sql.php" method="post">      
            <table border="1" align="center">
                <tr>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td>Old Password :</td>
                    <td><input type="password" class="textbox" name="old_pass" required></td>
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
