<?php
    session_start();
    if(empty($_SESSION['user']))
{
    header("Location: /CalgaryHacks24/login/loginForm.php");
    die("Redirecting to login.php");
}

if(isset($_POST['add_appt'])){
$conn = mysqli_connect("localhost","root","root","FML_DB");
// Check connections
if ($conn -> connect_errno)
{
echo "Failed to connect to MySQL: " . $conn -> connect_error;
}

    $appt = $_POST['ApptSelect'];
    $apptInfo = explode(',', $appt);
    

    if(empty($appt)){
        $message[] = 'Please fill out all the required information';
    }else{
        $insert = "INSERT INTO appointment VALUES(NULL,'{$apptInfo[0]}','{$_SESSION['user']}','{$apptInfo[1]}', '{$apptInfo[2]}')";
        mysqli_query($conn, $insert);
        $message[] = 'Appointment booked sucessfully';
    }


};

if(isset($_GET['delete'])){
    $announcement_title = $_GET['delete'];
    $conn = mysqli_connect("localhost","root","root","FML_DB");
    mysqli_query($conn, "DELETE FROM Announcement WHERE title = '{$announcement_title}'");
    header('location:admin_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style2.css">

</head>
<body>



<?php
/* if message is called then do the following */
if(isset($message)){
    foreach($message as $message){
        echo '<span class="message">'.$message.'</span>';
    }

}

?>
<?php include 'Navbar.php' ?>
<div class="container">

    <div class="admin-machine-form-container">

        <?php
            $max = new DateTime();
            $max->modify("+7 days");
            $min = new DateTime();
            $min->modify("+1 days");
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Book an Appointment with Advisor</h3>
            <!-- add a new type input box -->
            <select required name= "ApptSelect" class="CourseSelections">
            <?php
                $con = mysqli_connect("localhost","root","root","FML_DB");
                // Check connection
                if ($con -> connect_errno)
                {
                    echo "Failed to connect to MySQL: " . $con -> connect_error;
                }
                $apptsSel = mysqli_query($con, "SELECT * FROM availability
                ORDER BY dateA DESC, timeA ASC");
                $count = 0;
                while($mrow = mysqli_fetch_array($apptsSel)){
                    $em = $mrow['advEmail'];
                    $date = $mrow['dateA'];
                    $time = $mrow['timeA'];
                    $timeNew = explode(':', $time);

                    $advSel = mysqli_query($con, "SELECT * FROM Person where email = '{$em}'");
                    $prow = mysqli_fetch_array($advSel);
                    $fn = $prow['Fname'];
                    $ln = $prow['LastName'];


                    $exprSel = mysqli_query($con, "SELECT * FROM advisor where email = '{$em}'");
                    $erow = mysqli_fetch_array($exprSel);
                    $expr = $erow['expertise'];


                    if($count == 0){
                        echo "<option value= '$em,$date,$time' selected> $fn $ln - $expr - $date - $timeNew[0]:$timeNew[1] </option>";
                    }else{
                        echo "<option value= '$em,$date,$time'> $fn $ln - $expr - $date - $timeNew[0]:$timeNew[1]</option>";
                    }
                    $count++;
                }
            ?>
            </select>   

            <!--<input type="email" placeholder="Enter your email" name="announcement_email" class="box">-->
            <input type="submit" class="btn" name="add_appt" value="Book Appointment">
        </form>
    </div>



    <!-- displaying the announcements from database -->
    <?php 
        //issue for display
        $email = $_SESSION['user'];
        $conn = mysqli_connect("localhost","root","root","FML_DB");
        $select = mysqli_query($conn, "SELECT * FROM appointment where userEmail = '$email' ORDER BY date DESC, time ASC");        
    
    ?>

    <div class="announcement-display">
        <table class="announcement-display-table">
        <!-- table head element -->
            <thead>
                <!-- setting up the table to preview the annoucements added -->
            <tr>
                <th>Advisor Email</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
            </tr>

            </thead>

            <?php
            
                while($row = mysqli_fetch_assoc($select)){
            
            ?>

            <tr>
                <td><?php echo $row['advEmail']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php 
                    $timeNew = explode(':', $row['time']);
                    echo "$timeNew[0]:$timeNew[1]"; 
                ?></td>
            </tr>

            <?php } ?> 

        </table>
    </div>

</div>

</body>

</html>