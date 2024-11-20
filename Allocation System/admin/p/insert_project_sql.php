



<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}
?>

<?php
if(isset($_POST['p_id']) && isset($_POST['p_definition']) && isset($_POST['p_description']))     // check proper condition
{
    $temp=0;
    if(!preg_match('/^(\d{1,6})$/',$_POST['p_id']) || !preg_match('/^(.{2,25})$/', $_POST['p_definition']) || !preg_match('/^(.{2,50})$/', $_POST['p_description']))
    {
        $msg = 'details are not valid';                                         //      check proper reguler expression over here
        header("location:insert_project.php?msg=".$msg);
    }
    else {              
        try{
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');

            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="insert into projects (project_id,faculty,definition,description,enable,selected) values (?,?,?,?,?,0)";    
            $query=$dbhandler->prepare($sql);
            $p=0;
            if(isset($_POST['p_enable']))
            {
                $p=1;
            }
            $query->execute(array($_POST['p_id'],$_SESSION['faculty'],$_POST['p_definition'],$_POST['p_description'],$p));

        }
        catch(PDOException $e){
                $msg='project id already exsist';
                header("location:insert_project.php?msg=".$msg);
                $temp=1;
        }if($temp==0){
            header("location:insert_project.php?msg=Project ".$_POST['p_defination']." with id ".$_POST['p_id']." is successfully added");
        }
    }
}
else {
        header("location:insert_project.php?msg=FILL REQUIRED DETAILS");
    }

?>
