<?php
    session_start();
    if(empty($_SESSION['user']))
{
    header("Location: /CalgaryHacks24/login/loginForm.php");
    die("Redirecting to login.php");
}
?>
<!-- navigation bar -->
<?php include 'Navbar.php' ?> 

<div class="container">
    <div class="content">

<html>
  <head>
    <title>Overview</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="/CalgaryHacks24/user/style.css">


    <body>
    <form method="post" class = "inp">
        <label class = "Sel" for="month">Select a Month:</label>
        <select class = "Sel" id="month" name="month">
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
        <input type="submit" value="View" class = "SelBtn">
    </form>
    </body>
      <?php
            $selectedMonth = "";
            if(isset($_POST['month'])) {
            $selectedMonth = $_POST['month'];
            processMonth($selectedMonth);
            }


          function processMonth($selectedMonth) {
          // Add your logic here to process the selected month
         //echo "You selected: " . $selectedMonth;
        }

       $con = mysqli_connect("localhost","root","root","fml_db");
        // Check connection
        if ($con -> connect_errno)
        {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        }
        $email = $_SESSION['user'];

        $totalCount = mysqli_query($con, "SELECT SUM(value) AS total_value  FROM transaction WHERE transaction.month = '$selectedMonth' and transaction.email = '$email'");
        $row = mysqli_fetch_assoc($totalCount);
        $totalCount = $row['total_value'];
        if($totalCount === NULL){
          $totalCount = 0;
        }

        $Bills = mysqli_query($con, "SELECT SUM(value) AS total_value  FROM transaction WHERE transaction.month = '$selectedMonth' and transaction.type = 'Bills' and transaction.email = '$email'");
        $row = mysqli_fetch_assoc($Bills);
        $billCount = $row['total_value'];
        if($billCount === NULL){
          $billCount = 0;
        }


        $Food = mysqli_query($con, "SELECT SUM(value) AS total_value  FROM transaction WHERE transaction.month = '$selectedMonth' and transaction.type = 'Food' and transaction.email = '$email'");
        $row = mysqli_fetch_assoc($Food);
        $FoodCount = $row['total_value'];
        if($FoodCount === NULL){
          $FoodCount = 0;
        }
        
        $Subscriptions = mysqli_query($con, "SELECT SUM(value) AS total_value  FROM transaction WHERE transaction.month = '$selectedMonth' and transaction.type = 'Subscriptions' and transaction.email = '$email'");
        $row = mysqli_fetch_assoc($Subscriptions);
        $SubscriptionCount = $row['total_value'];
        if($SubscriptionCount === NULL){
          $SubscriptionCount = 0;
        }
        
        $Clothes = mysqli_query($con, "SELECT SUM(value) AS total_value  FROM transaction WHERE transaction.month = '$selectedMonth' and transaction.type = 'Clothes' and transaction.email = '$email'");
        $row = mysqli_fetch_assoc($Clothes);
        $ClotheCount = $row['total_value'];
        if($ClotheCount === NULL){
          $ClotheCount = 0;
        }
        
        $ETC = mysqli_query($con, "SELECT SUM(value) AS total_value  FROM transaction WHERE transaction.month = '$selectedMonth' and transaction.type = 'ETC' and transaction.email = '$email'");
        $row = mysqli_fetch_assoc($ETC);
        $ETCCount = $row['total_value'];
        if($ETCCount === NULL){
          $ETCCount = 0;
        }
      
        //echo $Subscriptions;
        echo "<h3><span>$selectedMonth</span> Spending Details</h1>";
        echo "<h2>Total <span>$selectedMonth</span>  Spending - $ $totalCount</h2>";

       ?>
   

   
   
   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      var Subscriptions = <?php echo $SubscriptionCount; ?>;
      var Bills = <?php echo $billCount; ?>;
      var Clothes = <?php echo $ClotheCount; ?>;
      var Food = <?php echo $FoodCount; ?>;
      var etc = <?php echo $ETCCount; ?>;
      var monthlyTotal = Subscriptions+Bills+Clothes+Food+etc;
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Payment Type', 'Hours per Day'],
          ['Subscriptions',     Subscriptions],
          ['Bills',      Bills],
          ['Clothes',  Clothes],
          ['Food',  Food],
          ['etc.', etc],
        ]);

        var options = {
          title: 'My Monthly Spending - Total: $' +  monthlyTotal
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>