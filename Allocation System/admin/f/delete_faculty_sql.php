



<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_GET['id']))     // check proper condition
{
    $temp=0;
    try{
        
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql='delete from faculty where student_id=?';
        
        $query=$dbhandler->prepare($sql);
        $query->execute(array($_GET['id']));
        $temp=1;
        header("location:../faculty.php?msg=faculty with id ".$_GET['id']." has been deleted");
        
    } catch (Exception $ex) {
        if($temp==0){
            header("location:../faculty.php?msg=sorry! provided faculty id not found");
        }
    }
    
}
else{
    header("location:../faculty.php?msg=please provide proper faculty id");
}
?>
