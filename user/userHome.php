<?php
    session_start();
    if(empty($_SESSION['user']))
{
    die("Redirecting to login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User page</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>

<!-- navigation bar -->
<?php include 'Navbar.php' ?> 

<div class="container">
    <div class="content">



        <h3>Hello 
        <?php
            // Create connection
            $conn = mysqli_connect("localhost","root","root","FML_DB");
            // Check connection
            if ($conn -> connect_errno)
            {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
            }
            $email = $_SESSION["user"];

            $select = " SELECT * FROM Person WHERE email = '$email'";

            $result = mysqli_query($conn, $select);
            $fn = "";
            $ln = "";
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $fn = $row["Fname"];
                $ln = $row["LastName"];
            }
            echo "<span> $fn $ln </span>";

            echo "<h1>Welcome to your Finance Hub<span></span></h1>";
            $course = "";

            $select = " SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $select);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $course = $row["courseName"];
            }
            if(empty($course)){
                echo "<h2>You are not enrolled in any courses. <span></span></h2>";
            }else{
                echo "<h2>You are currently enrolled in Course  <span> $course </span></h2>";
            }
?>        
        <a href="/CalgaryHacks24/login/logOut.php" class='btn'>Logout</a>
    </div>
</div>

</body>
</html>