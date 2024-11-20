



<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_GET['id']))     // check proper condition
{
    $temp=0;
    try{
        
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql='delete from students where student_id=?';
        
        $query=$dbhandler->prepare($sql);
        $query->execute(array($_GET['id']));
        $temp=1;
        header("location:../student.php?msg=student with id ".$_GET['id']." has been deleted");
        
    } catch (Exception $ex) {
        if($temp==0){
            header("location:../student.php?msg=sorry! provided student id not found");
        }
    }
    
}
else{
    header("location:../student.php?msg=please provide proper student id");
}
?>
