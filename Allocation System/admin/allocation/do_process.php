


<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}
?>


<?php   /*
         * id=1 for found
         * 
         * start - 1
         * first_round - 2
         * first_round_allocation - 3
         * second_round - 4
         * second_round_allocation - 5
         * third_round - 6
         * third_round_allocation - 7
         * finished - 8
         */


if(isset($_GET['process']))
{
    $temp=0;
    try{
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="update allocation_process SET process=? where id=1";    
            $query=$dbhandler->prepare($sql);
            $query->execute(array($_GET['process']));
            if(isset($_GET['news'])){
                $s="update allocation_process SET news=? where id=1";    
                $q=$dbhandler->prepare($s);
                $q->execute(array($_GET['news']));
            }
            
            if($_GET['process']==3 || $_GET['process']==5 || $_GET['process']==7){
                $temp=1;
                header('location:allocate.php');
            }
            if($_GET['process']==8){
                $temp=1;
                header('location:flush.php');
            }
            if($temp!=1){
                header('location:../index.php?msg=sucessfully start next allocation process');
            }
           $temp=2;
        }
        catch(PDOException $e){
                $msg='Failed';
                if($temp!=2){
                  header("location:allocation_process.php?msg=".$msg);
                }
        }
}
else{
    header('location:allocation_process.php?msg=failed ! try again');
}
?>
