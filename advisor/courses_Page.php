<?php
    session_start();
    if(empty($_SESSION['adv']))
{
    header("Location: /CalgaryHacks24/login/loginForm.php");
    die("Redirecting to login.php");
}

if(isset($_POST['add_course'])){
$conn = mysqli_connect("localhost","root","root","FML_DB");
// Check connections
if ($conn -> connect_errno)
{
echo "Failed to connect to MySQL: " . $conn -> connect_error;
}

    $course_name = $_POST['course_name'];
    $email = $_SESSION['adv'];
    $topic = $_POST['TopicSelect'];

    $select = " SELECT * FROM course WHERE name = '$course_name'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $message[] = 'Please Select a different name';
    }else{
        if(empty($course_name) || empty($email) || empty($topic)){
            $message[] = 'Please fill out all the required information';
        }else{
            $insert = "INSERT INTO course(name,adv_email,type) VALUES('{$course_name}', '{$email}', '{$topic}')";
            $upload = mysqli_query($conn,$insert);
            $message[] = 'new course added sucessfully';
        }
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
            <h3>Add a Course</h3>
            <!-- add a new type input box -->
            <input type="name" required placeholder="Type Name" name="course_name" class="box">
            <select required name= "TopicSelect" class="topicSelections">
            <option value='Mortgage'>Mortgage</option>
            <option value='Insurance'>Insurance</option>
            <option value='Investment'>Investment</option>
            </select>   

            <!--<input type="email" placeholder="Enter your email" name="announcement_email" class="box">-->
            <input type="submit" class="btn" name="add_course" value="add Course">
        </form>
    </div>


      <!-- displaying the announcements from database -->
      <?php 
        //issue for display
        $email = $_SESSION['adv'];
        $conn = mysqli_connect("localhost","root","root","FML_DB");
        $select = mysqli_query($conn, "SELECT * FROM course where adv_email='$email'");        
    
    ?>

    <div class="announcement-display">
        <table class="announcement-display-table">
        <!-- table head element -->
            <thead>
                <!-- setting up the table to preview the annoucements added -->
            <tr>
                <th>Your Current Courses</th>
            </tr>

            </thead>

            <?php
            
                while($row = mysqli_fetch_assoc($select)){
            
            ?>

            <tr>
                <td><?php echo $row['name']; ?></td>
            </tr>

            <?php } ?> 

        </table>
    </div>

</div>

</body>

</html>

</div>

</body>

</html>