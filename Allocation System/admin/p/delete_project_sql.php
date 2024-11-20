



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
        
        $sql='delete from projects where project_id=?';
        
        $query=$dbhandler->prepare($sql);
        $query->execute(array($_GET['id']));
        
        $temp=1;
        header("location:../project.php?msg=student with id ".$_GET['id']." has been deleted");
        
    } catch (Exception $ex) {
        if($temp==0){
            header("location:../project.php?msg=sorry! provided project id not found");
        }
    }
    
}
else{
    header("location:../project.php?msg=please provide proper project id");
}
?>
