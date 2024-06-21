<?php
    session_start();
    if(empty($_SESSION['user']))
{
    header("Location: /CalgaryHacks24/login/loginForm.php");
    die("Redirecting to login.php");
}

if(isset($_POST['add_trans'])){
$conn = mysqli_connect("localhost","root","root","FML_DB");
// Check connections
if ($conn -> connect_errno)
{
echo "Failed to connect to MySQL: " . $conn -> connect_error;
}

    $email = $_SESSION['user'];
    $value = $_POST['value'];
    $type = $_POST['typeSelect'];
    $month = $_POST['monthSelect'];
    $date = $_POST['trans_date'];



    if(empty($email) || empty($value) || empty($type) || empty($month) || empty($date) ){
        $message[] = 'Please fill out all the required information';
    }else{
        $insert = "INSERT INTO transaction VALUES(NULL,'{$email}','{$type}','{$value}', '{$month}', '{$date}')";
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
    <title>Transactions</title>

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
            $max->modify("+1 days");
            $min = new DateTime();
            $min->modify("-30 days");
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Enter a Transaction</h3>
            <!-- add a new type input box -->
            <input type="number" required placeholder="Enter Value" name="value" min=<?=$min->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> class="box">
            <select required name= "typeSelect" class="CourseSelections">
                <option value= 'Subscriptions' selected> Subscriptions</option>
                <option value= 'Bills' > Bills</option>
                <option value= 'Clothes' > Clothes</option>
                <option value= 'Food' > Food</option>
                <option value= 'etc' > etc.</option>
            </select>   
            <select required name= "monthSelect" class="CourseSelections">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>   
            <input type="date" required placeholder="Enter Transaction Date" name="trans_date" min=<?=$min->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> class="box">

            <!--<input type="email" placeholder="Enter your email" name="announcement_email" class="box">-->
            <input type="submit" class="btn" name="add_trans" value="Enter Transaction">
        </form>
    </div>



    <!-- displaying the announcements from database -->
    <?php 
        //issue for display
        $email = $_SESSION['user'];
        $conn = mysqli_connect("localhost","root","root","FML_DB");
        $select = mysqli_query($conn, "SELECT * FROM transaction where email = '$email' ORDER BY date DESC");        
    
    ?>

    <div class="announcement-display">
        <table class="announcement-display-table">
        <!-- table head element -->
            <thead>
                <!-- setting up the table to preview the annoucements added -->
            <tr>
                <th>Transaction Type</th>
                <th>Transaction Value</th>
                <th>Transaction Month</th>
                <th>Transaction Date</th>
            </tr>

            </thead>

            <?php
            
                while($row = mysqli_fetch_assoc($select)){
            
            ?>

            <tr>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['value']; ?></td>
                <td><?php echo $row['month']; ?></td>
                <td><?php echo $row['date']; ?></td>
            </tr>

            <?php } ?> 

        </table>
    </div>

</div>

</body>

</html>