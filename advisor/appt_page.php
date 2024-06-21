<?php
    session_start();
    if(empty($_SESSION['adv']))
{
    header("Location: /CalgaryHacks24/login/loginForm.php");
    die("Redirecting to login.php");
}

if(isset($_POST['add_appointment'])){
$conn = mysqli_connect("localhost","root","root","FML_DB");
// Check connection
if ($conn -> connect_errno)
{
echo "Failed to connect to MySQL: " . $conn -> connect_error;
}
    $appointment_date = $_POST['appointment_date'];
    $email = $_SESSION['adv'];
    $appointment_time = $_POST['appointment_time'];

    if(empty($appointment_date) || empty($email) || empty($appointment_time)){
        $message[] = 'Please fill out all the required information';
    }else{
        $insert = "INSERT INTO Availability(advEmail,dateA,timeA) VALUES('{$email}', '{$appointment_date}', '{$appointment_time}')";
        $upload = mysqli_query($conn,$insert);
        $message[] = 'new availability added sucessfully';
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
    <title>Appointments</title>

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
            <h3>Add Appointment Availability</h3>
            <!-- add a new type input box -->
            <input type="time" required placeholder="Enter Time" name="appointment_time" class="box">
            <input type="date" required placeholder="Enter Appointment Date" name="appointment_date" min=<?=$min->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> class="box">
            <!--<input type="email" placeholder="Enter your email" name="announcement_email" class="box">-->
            <input type="submit" class="btn" name="add_appointment" value="add Availability">
        </form>
    </div>

    <!-- displaying the announcements from database -->
    <?php 
        //issue for display
        $email = $_SESSION['adv'];
        $conn = mysqli_connect("localhost","root","root","FML_DB");
        $select = mysqli_query($conn, "SELECT * FROM appointment where advEmail = '$email'");        
    
    ?>

    <div class="announcement-display">
        <table class="announcement-display-table">
        <!-- table head element -->
            <thead>
                <!-- setting up the table to preview the annoucements added -->
            <tr>
                <th>Customer Email</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
            </tr>

            </thead>

            <?php
            
                while($row = mysqli_fetch_assoc($select)){
            
            ?>

            <tr>
                <td><?php echo $row['userEmail']; ?></td>
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