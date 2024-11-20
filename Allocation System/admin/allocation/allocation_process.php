

<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}
?>




<html>
    <head>
        <title>Student Project Allocation System</title>
        <link rel='icon' href="../../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../../main.css">
    </head>
    <body>
        <h1 align="center">Student Project Allocation System</h1>
        <h3 align="center"><a href="../index.php"  class="back shadow"><= Back</a></h3>
        <h3 align="center"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>        
        <h3 class="msg"><?php if(isset($_GET['msg']))
        {
            echo $_GET['msg'];
        }
            ?></h3>
        
        Currently   :   <?php
        
        /*
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
        
            try{
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="select * from allocation_process where id=1";    
                $query=$dbhandler->query($sql);
                $r=$query->fetch();
                
                switch ($r['process']){
                    case 1:echo 'Starting';
                        break;
                    case 2:echo 'First Round';
                        break;
                    case 3:echo 'First Round Allocation';
                        break;
                    case 4:echo 'Second Round';
                        break;
                    case 5:echo 'Second Round Allocation';
                        break;
                    case 6:echo 'Third Round';
                        break;
                    case 7:echo 'Third Round Allocation';
                        break;
                    case 8:echo 'Finished';
                        break;
                }
                
            }
             catch (Exception $ex){
                 echo 'hey! Error ??'; 
            }
        echo '
        <br>
        <br>
        
        <form action="do_process.php">
            <select name="process" class="textbox">
                <option value="1">Start</option>
                
                <option value="2">First Round</option>
                <option value="3">First Round Allocation</option>
                
                <option value="4">Second Round</option>
                <option value="5">Second Round Allocation</option>
                
                <option value="6">Third Round</option>
                <option value="7">Third Round Allocation</option>
                           
                <option value="8">Finished</option>
            </select>
            <br>
            <br>
            <br>
            News Related to Allocation process : <br>   <textarea name="news" rows="3" cols="50" class="textbox">'.$r['news'].'</textarea>
            <br>';
        ?>
        <br>
        <input type="submit" class="button shadow" value="Change Process">
        </form>
        <br>
        when you start any allocation process then it automatic allocate projects
        <br>
        when finish process started it automatic flush all old data
        <br>
        And master reset over database.............
    </body>
</html>
