



<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>
    <body>
        <h1 align="center">Student Project Allocation System</h1>
        <h3 align="center"><a href="../index.php"  class="back shadow"><= Back</a></h3>
        <form  method="post">
            <table align="center">
                <tr>
                    <th colspan="2">Admin Login</th>
                </tr>
                <tr>
                    <td>Admin Id :</td>
                    <td><input type="text" name="admin_id" class="textbox" required></td>
                </tr>
                <tr>
                    <td>Admin Password :</td>
                    <td><input type="password" name="admin_passwd" class="textbox" required></td>
                </tr>
                
        <?php
        session_start();
        if(isset($_POST['admin_id']) && isset($_POST['admin_passwd']))
	{
		$u=$_POST['admin_id'];
		$p=$_POST['admin_passwd'];
                
                try{
                    
                    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql='select password,admin,name from faculty where faculty_id=? && enable=1';
                    $query=$dbhandler->prepare($sql);
                    $query->execute(array($u));
                    $r=$query->fetch();
                
                    if( $r != NULL)
                    {
                        if($r['password']==$p){
                            
                            $_SESSION['faculty']=$u;
                            $_SESSION['faculty_name']=$r['name'];
                            if($r['admin']==1){
                                $_SESSION['admin']=$u;
                            }
                            if(isset($_POST['code'])){
                                if($_SESSION['code']==$_POST['code']){
                                    unset($_SESSION['try']);
                                    header("location:index.php");
                                }
                            }
                            else{
                                header("location:index.php");
                            }	
                    } else {
                            if (isset($_SESSION['try'])) {
                                    echo '<tr>'
                                    . '<td>Enter Code :</td>'
                                            . '<td><img src="../change_pass/captchafont.php">'
                                            . '</tr>'
                                            . '<tr>'
                                            . '<td colspan="2"><input type="text" name="code"></td>'
                                            . '</tr>';
                                    $_GET['msg']='INVALID LOGIN DETAILS';
                                }
                            else {
                                $_SESSION['try']=1;
                                $_GET['msg']='INVALID LOGIN DETAILS';
                            }
                        }
                    }
                    else{
                        if (isset($_SESSION['try'])) {
                                    echo '<tr>'
                                    . '<td>Enter Code :</td>'
                                            . '<td><img src="../change_pass/captchafont.php">'
                                            . '</tr>'
                                            . '<tr>'
                                            . '<td colspan="2"><input type="text" name="code"></td>'
                                            . '</tr>'
                                            . '<tr>'
                                            . '<td colspan="2" align="right"><a href="../change_pass/forgot_password.php">Forgot password !!</a></td>'
                                            . '</tr>';
                                    $_GET['msg']='INVALID LOGIN DETAILS';
                                }
                            else {
                                $_SESSION['try']=1;
                                $_GET['msg']='INVALID LOGIN DETAILS';
                            }
                    }
                }
                catch (Exception $ex){
                    echo 'ohh! Error';
                }
	}
        ?>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Login" class="button shadow"></td>
                </tr>
                <tr>
                    <td colspan="2" class="msg">
                        <?php 
                            if(isset($_GET['msg']))
                                echo $_GET['msg'];
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <br>
        <br>
    </body>
</html>
