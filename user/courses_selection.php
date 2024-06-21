<?php
    session_start();
    if(empty($_SESSION['user']))
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

    $course_name = $_POST['CourseSelect'];


    if(empty($course_name)){
        $message[] = 'Please fill out all the required information';
    }else{
        $upUser = mysqli_query($conn, "UPDATE user set courseName ='{$course_name}'"); 
        $message[] = 'course selected sucessfully';
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
            <h3>Select a Course</h3>
            <!-- add a new type input box -->
            <select required name= "CourseSelect" class="CourseSelections">
            <?php
                $con = mysqli_connect("localhost","root","root","FML_DB");
                // Check connection
                if ($con -> connect_errno)
                {
                    echo "Failed to connect to MySQL: " . $con -> connect_error;
                }
                $coursesSel = mysqli_query($con, "SELECT * FROM Course");
                $count = 0;
                while($mrow = mysqli_fetch_array($coursesSel)){
                    $cn = $mrow['name'];
                    $type = $mrow['type'];
                    if($count == 0){
                        echo "<option value= '$cn' selected>$cn - $type </option>";
                    }else{
                        echo "<option value='$cn'>$cn - $type </option>";
                    }
                    $count++;
                }
            ?>
            </select>   

            <!--<input type="email" placeholder="Enter your email" name="announcement_email" class="box">-->
            <input type="submit" class="btn" name="add_course" value="Select Course">
        </form>
    </div>


</div>

</body>

</html>