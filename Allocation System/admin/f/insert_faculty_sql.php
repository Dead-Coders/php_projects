


<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_POST['f_id'])  && isset($_POST['f_name']) )     // check proper condition
{
    
    $msg='';
    if(!preg_match('/^(\d{1,6})$/',$_POST['f_id']) || !preg_match('/^([a-zA-Z ]{2,25})$/',$_POST['f_name']))
    {
        $msg = 'details are not valid';                                         //      check proper reguler expression over here
        header("location:insert_faculty.php?msg=".$msg);
    }
    else {
        $temp=0;
        try{
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');

            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="insert into faculty (faculty_id,password,name,email,contact_no,enable,admin) values (?,?,?,?,?,?,0)";    
            $query=$dbhandler->prepare($sql);
            $p=0;
            if(isset($_POST['f_enable']))
            {
                $p=1;
            }
            $r=NULL;
            if(isset($_POST['f_email']) && isset($_POST['f_contact'])){    
                $r=$query->execute(array($_POST['f_id'],$_POST['f_id'],$_POST['f_name'],$_POST['f_email'],$_POST['f_contact'],$p));
            }
            else if(isset($_POST['s_email'])){
                $r=$query->execute(array($_POST['f_id'],$_POST['f_id'],$_POST['f_name'],$_POST['f_email'],'',$p));
            }
            else if(isset($_POST['s_contact'])){
                $r=$query->execute(array($_POST['f_id'],$_POST['f_id'],$_POST['f_name'],'',$_POST['f_contact'],$p));
            }
            else{
                $r=$query->execute(array($_POST['f_id'],$_POST['f_id'],$_POST['f_name'],'','',$p));
            }
            
        }
        catch(PDOException $e){
                $msg='faculty with this id is already exsist';
                $temp=1;
                  header("location:insert_faculty.php?msg=".$msg);
        }
        if($temp == 0){
            header("location:insert_faculty.php?msg=Faculty ".$_POST['f_name']." with id ".$_POST['f_id']." is successfully added");
        }
    }
}
else {
        header("location:insert_faculty.php?msg=FILL REQUIRED DETAILS");
    }

?>
