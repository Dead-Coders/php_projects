



<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_POST['p_id']) && isset($_POST['p_definition']) && isset($_POST['p_description']))     // check proper condition
{

    $temp=0;
    if(!preg_match('/^(\d{1,6})$/',$_POST['p_id']) || !preg_match('/^(.{2,25})$/', $_POST['p_definition']) || !preg_match('/^(.{2,50})$/', $_POST['p_description']))
    {
        $msg = 'details are not valid';                                        
        header("location:update_project.php?id=".$_POST['s_id']."&msg=".$msg);
    }
     else{      
        try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');

	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="update projects SET definition=?,description=?,enable=? where project_id=?";    
        $query=$dbhandler->prepare($sql);
        $p=0;
        if(isset($_POST['p_enable']))
        {
            $p=1;
        }
	$query->execute(array($_POST['p_definition'],$_POST['p_description'],$p,$_POST['p_id']));
	
        }
        catch(PDOException $e){
                $msg='project details can\'t change';
                $temp=1;
                header("location:../project.php?msg='.$msg");
        }
        if($temp==0){
            header("location:../project.php?msg=Project ".$_POST['p_definition']." with id ".$_POST['p_id']." is successfully updated");
        }
    }
}
else {
        header("location:../project.php?msg=FILL REQUIRED DETAILS");
    }

?>
