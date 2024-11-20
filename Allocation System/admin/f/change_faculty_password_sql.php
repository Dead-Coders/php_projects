

<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_POST['new_pass']) && isset($_POST['re_pass']))     
{
    $msg='';
    
    if($_POST['new_pass']==$_POST['re_pass']){
        if(!preg_match('/^(.{8,20})$/', $_POST['new_pass']))                                             // check proper condition
        {
            $msg = 'password must between 8 to 20 character';                                         //    password between 8 to 20 charactor
            header("location:change_faculty_password.php?msg=".$msg."&id=".$_GET['id']);
        }
        else{
            try{
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');

            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="update faculty SET password=? where faculty_id=?";   
            $query=$dbhandler->prepare($sql);
       
            $query->execute(array($_POST['new_pass'],$_GET['id']));
            }
            catch(PDOException $e){
                    $msg='faculty password can\'t change';
                    header("location:change_faculty_password.php?msg=".$msg."&id=".$_GET['id']);
            }
            header("location:update_faculty.php?msg=Faculty Password changed&id=".$_GET['id']);
        }
    }
}
else {
        header("location:update_faculty.php?msg=FILL REQUIRED DETAILS&id=".$_GET['id']);
    }

?>
