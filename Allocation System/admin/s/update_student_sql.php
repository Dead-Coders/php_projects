


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_POST['s_id']) && isset($_POST['s_birthday']) && isset($_POST['s_f_name']) && isset($_POST['s_l_name']) && isset($_POST['s_cpi']))     // check proper condition
{
    $msg='';
    
    if(!preg_match('/^(\d{1,6})$/',$_POST['s_id']) || !preg_match('/^([a-zA-Z ]{2,15})$/',$_POST['s_f_name']) || !preg_match('/^([a-zA-Z ]{2,15})$/',$_POST['s_l_name']) || !preg_match('/^(\d\d\d\d-\d\d-\d\d)$/',$_POST['s_birthday']) || !preg_match('/^(\d{1,2}(\.\d{1,2})?)$/',$_POST['s_cpi']) || $_POST['s_cpi']>10)
    {
        $msg = 'details are not valid';                                         //      check proper reguler expression over here
        header("location:update_student.php?id=".$_POST['s_id']."&msg=".$msg);
    }
    else {
        $temp=0;
        try{
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');

            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="update students SET cpi=?,first_name=?,last_name=?,birthdate=?,email=?,contact_no=?,participate=? where student_id=?";    //   leader is 0 means not decided
            $query=$dbhandler->prepare($sql);
            $p=0;
            if(isset($_POST['s_participate']))
            {
                $p=1;
            }
            $r=NULL;
            if(isset($_POST['s_email']) && isset($_POST['s_contact'])){    
                $r=$query->execute(array($_POST['s_cpi'],$_POST['s_f_name'],$_POST['s_l_name'],$_POST['s_birthday'],$_POST['s_email'],$_POST['s_contact'],$p,$_POST['s_id']));
            }
            else if(isset($_POST['s_email'])){
                $r=$query->execute(array($_POST['s_cpi'],$_POST['s_f_name'],$_POST['s_l_name'],$_POST['s_birthday'],$_POST['s_email'],'',$p,$_POST['s_id']));
            }
            else if(isset($_POST['s_contact'])){
                $r=$query->execute(array($_POST['s_cpi'],$_POST['s_f_name'],$_POST['s_l_name'],$_POST['s_birthday'],'',$_POST['s_contact'],$p,$_POST['s_id']));
            }
            else{
                $r=$query->execute(array($_POST['s_cpi'],$_POST['s_f_name'],$_POST['s_l_name'],$_POST['s_birthday'],'','',$p,$_POST['s_id']));
            }
            
        }
        catch(PDOException $e){
                $msg='please try again some problem occured';
                $temp=1;
                  header("location:update_student.php?id=".$_POST['s_id']."&msg=".$msg);
        }
        if($temp == 0){
            header("location:../student.php?msg=Student ".$_POST['s_f_name']." with id ".$_POST['s_id']." is successfully updated");
        }
    }
}
else {
        header("location:update_student.php?msg=FILL REQUIRED DETAILS&id=".$_POST['s_id']);
    }

?>
