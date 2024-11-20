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


<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../main.css"> 
        <script type="text/javascript" src="ch_pass.js"></script>
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="../index.php" class="back shadow"><= Home</a></h3>
        
        <h3 class="msg">
        <?php
                            if(isset($_GET['msg']))
                                echo $_GET['msg'];
                        ?>
        </h3>
        <form onsubmit="return Validate()" action="forgot_password_sql.php" method="post">      
            <table border="1" align="center">
                <tr>
                    <th colspan="2">Forgotten Password</th>
                </tr>
                <tr>
                    <td colspan="2">Choose type : <select name="user_type"><option value="student">Student</option><option value="faculty">Faculty</option></select></td>
                </tr>
                <tr>
                    <td>Your Id :</td>
                    <td><input type="text" class="textbox" name="id" required></td>
                </tr>
                <tr>
                    <td>Your Email :</td>
                    <td><input type="email" class="textbox" name="email" required></td>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td><input type="password" class="textbox" id="passwd" name="new_pass" required></td>
                </tr>
                <tr>
                    <td>Re-enter Password :</td>            
                    <td><input type="password" class="textbox" id="re-passwd" name="re_pass" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="button shadow" value="Change"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
