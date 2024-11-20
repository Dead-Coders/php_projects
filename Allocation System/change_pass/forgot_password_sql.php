
<?php

/*
 * ****************************************************************************
 * ****************************************************************************

  HEllo, THis projecT of PHP
  subject - Project Allocation

  c3 Batch sem-4

  CE046	HireN ItaliyA
  CE047	JaganI VatsaL   #
  CE048	MohiT JaiN
  CE049	AkshiT JariwalA

 * ****************************************************************************
 * ****************************************************************************
 */
?>


<?php

if (isset($_POST['user_type']) && isset($_POST['id']) && isset($_POST['email'])) {

    try {
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_POST['user_type'] == 'student') {
            $sql = "select email from students where student_id=" . $_POST['id'] . " && participate=1";
        } else {
            $sql = "select email from faculty where faculty_id=" . $_POST['id'] . "";
        }
        $query = $dbhandler->query($sql);
        $r = $query->fetch();

        if($r!=null){
        if ($r['email'] != $_POST['email']) {
            header("location:forgot_password.php?msg=Wrong Email validation");
        } else if (isset($_POST['new_pass']) && isset($_POST['re_pass'])) {     // check proper condition
            // if check condition for proper value
            $msg = '';

            if ($_POST['new_pass'] == $_POST['re_pass']) {
                if (!preg_match('/^(.{8,20})$/', $_POST['new_pass'])) {
                    $msg = 'password must between 8 to 20 character';                                         //      password between 8 to 20 charactor
                    header("location:forgot_password.php?msg=" . $msg);
                } else {
                    $sql = '';

                    if ($_POST['user_type'] == 'student') {
                        $sql = "update students SET password=? where student_id=" . $_POST['id'] . "";
                    } else {
                        $sql = "update faculty SET password=? where faculty_id=" . $_POST['id'] . "";
                    }
                    $query = $dbhandler->prepare($sql);
                    $query->execute(array($_POST['new_pass']));

                    if ($_POST['user_type'] == 'student') {
                        header("location:../index.php?msg=Your Password changed");
                    } else {
                        header("location:../admin/admin_login.php?msg=Your Password changed");
                    }
                }
            } else {
                header("location:forgot_password.php?msg=Enter proper same password");
            }
        }
        }
    } catch (PDOException $e) {
        $msg = 'password can\'t change';
        header("location:forgot_password.php?msg=" . $msg);
    }
} else {
    header("location:forgot_password.php?msg=Fill required details");
}
?>
