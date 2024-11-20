<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="main.css"> 
    </head>
    <body>
        <h1 align="center">Student Project Allocation System</h1>
        <form  method="post" >
            <table align="center">
                <tr>
                    <th colspan="2">Student Login</th>
                </tr>
                <tr>
                    <td>Student Id :</td>
                    <td><input type="text" name="student_id" class="textbox" required></td>
                </tr>
                <tr>
                    <td>Student Password :</td>
                    <td><input type="password" name="student_passwd" class="textbox" required></td>
                </tr>
                

                <?php
                try {
                    session_start();
                    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    if (isset($_POST['student_id']) && isset($_POST['student_passwd'])) {
                        $check = 0;
                        $s = '';
                        $u = $_POST['student_id'];
                        $p = $_POST['student_passwd'];
                        $query = $dbhandler->prepare('select password,first_name,last_name from students where student_id=? && participate=1');
                        $query->execute(array($u));
                        $r = $query->fetch();
                        if ($r['password'] == $p) {
                            $check = 1;
                            $s = $r['first_name'];
                        }
                        if ($check == 1) {    /// cheking student avaibility
                            
                            $_SESSION['student_id'] = $u;
                            $_SESSION['student_name'] = $s;
                            if(isset($_POST['code'])){
                                if($_SESSION['code']==$_POST['code']){
                                    unset($_SESSION['try']);
                                    header("location:student/index.php");
                                }
                            }
                            else{
                                header("location:student/index.php");
                            }
                      
                        } else {
                            if (isset($_SESSION['try'])) {
                                    echo '<tr>'
                                    . '<td>Enter Code :</td>'
                                            . '<td><img src="change_pass/captchafont.php">'
                                            . '</tr>'
                                            . '<tr>'
                                            . '<td colspan="2"><input type="text" name="code"></td>'
                                            . '</tr>'
                                            . '<tr>'
                                            . '<td colspan="2" align="right"><a href="change_pass/forgot_password.php">Forgot password !!</a></td>'
                                            . '</tr>';
                                    $_GET['msg']='INVALID LOGIN DETAILS';
                                }
                            else {
                                $_SESSION['try']=1;
                                $_GET['msg']='INVALID LOGIN DETAILS';
                            }
                        }
                    }
                    
                    echo '<tr>
                    <td colspan="2" align="center"><input type="submit" value="Login" class="button shadow"></td>
                </tr>
                <tr>
                    <td colspan="2" class="msg">';
                        if (isset($_GET['msg']))
                            echo $_GET['msg'];
                    echo '</td>
                </tr>
                        </table>
        </form>

        <div align="center">
        <br>
        <a href="admin/admin_login.php">Admin Login</a>
        <br>
        <br>
        <a href="about_us.php">About Us</a>
    </div> 
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>';
                    $q = $dbhandler->query('select news from allocation_process where id=1');
                    $r = $q->fetch();
                    echo '<div>'
                    . '<h4 align="center"style="color:purple"><marquee direction="left" height="300" width="400" scrollamount="5">' . $r['news'] . '</marquee></h4>'
                    . '</div>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    die();
                }
                ?>

       
                </html>
