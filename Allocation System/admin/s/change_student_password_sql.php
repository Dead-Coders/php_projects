


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_POST['new_pass']) && isset($_POST['re_pass']))     
{
        // if check condition for proper value
    $msg='';
    
    if($_POST['new_pass']==$_POST['re_pass']){
        if(!preg_match('/^(.{8,20})$/', $_POST['new_pass']) )                                             // check proper condition
        {
            $msg = 'password must between 8 to 20 character';                                         //      password between 8 to 20 charactor
            header("location:change_student_password.php?msg=".$msg."&id=".$_GET['id']);
        }
        else{      
            try{
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');

            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="update students SET password=? where student_id=?";   
            $query=$dbhandler->prepare($sql);
       
            $query->execute(array($_POST['new_pass'],$_GET['id']));
            

            }
            catch(PDOException $e){
                    $msg='student details can\'t change';
                    header("location:change_student_password.php?msg=".$msg."&id=".$_GET['id']);
            }
            header("location:update_student.php?msg=Student Password changed&id=".$_GET['id']);
        }
    }
}
else {
        header('location:update_student.php?msg=FILL REQUIRED DETAILS&id='.$_GET['id']);
    }

?>
