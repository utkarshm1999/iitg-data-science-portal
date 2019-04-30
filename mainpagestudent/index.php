<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Data Science Portal </title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">


  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/animate.css"/>




  <link href="css/resume.min.css" rel="stylesheet">

	<!-- Main Stylesheets -->
  <link rel="stylesheet" href="css/style.css"/>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <span class="d-block d-lg-none">Clarence Taylor</span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/iitg.png" alt="">
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#course">Course Materials</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#notices">View Notices</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#apply">Download Gradecard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#changepwd">Change Password</a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="container-fluid p-0">
    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="course">
      <div class="w-100">
        <?php
          session_start();
          $sem=$_SESSION["semester"];
        ?>
        <h2 class="mb-5">Semester <?php echo $sem; ?></h2>
        <form  action="index.php"  method="POST">

        <button type="submit" class="btn btn-primary btn-lg btn-block" name="c1_button" >Course 1</button>
        <button type="submit" class="btn btn-secondary btn-lg btn-block" name="c2_button" >Course 2</button>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="c3_button" >Course 3</button>
        <button type="submit" class="btn btn-secondary btn-lg btn-block" name="c4_button" >Course 4</button>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="c5_button">Course 5</button>

        <?php
          if( isset($_POST["c1_button"]) ){
            session_start();
            $_SESSION["course"]=($sem-1)*5 + 1;
            header("Location:coursematerials.php");

          }
          else if(isset($_POST["c2_button"])){
            session_start();
            $_SESSION["course"]=($sem-1)*5 + 2;
            header("Location:coursematerials.php");
          }
          else if(isset($_POST["c3_button"])){
            session_start();
            $_SESSION["course"]=($sem-1)*5 + 3;
            header("Location:coursematerials.php");
          }
          else if(isset($_POST["c4_button"])){
            session_start();
            $_SESSION["course"]=($sem-1)*5 + 4;
            header("Location:coursematerials.php");
          }
          else if(isset($_POST["c5_button"])){
            session_start();
            $_SESSION["course"]=($sem-1)*5 + 5;
            header("Location:coursematerials.php");
          }
         ?>

      </form>


      </div>



    </section>

    <hr class="m-0">
    <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="notices">
      <div class="w-100">
        <h2 class="mb-5">Notices</h2>

    <?php
    $db="ds-portal";
    $host="localhost";
    $dsn= "mysql:host=$host;dbname=$db";
    $conn=new mysqli();
    $conn=new mysqli($host,"root","",$db);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
      echo "failed";
    }
    $query="SELECT * FROM notices";
    try{

      $result=$conn->query($query);
      if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
          ?>


              <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                <div class="resume-content">
                  <h3 class="mb-0"> <?php echo $row["title"]; ?> </h3>
                  <div class="subheading mb-3">Description</div>
                  <p><?php  echo $row["description"]; ?></p>
                </div>
                <div class="resume-date text-md-right">
                  <span class="text-primary"><?php echo $row["date"] ?></span>
                </div>
              </div>

              <?php
        }
      }
      else {
          echo "0 results";
      }
    }
    catch(Exception $e){
      echo "an Exception";
    }

    ?>

  </div>








    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="apply">
      <div class="w-100">
        <h2 class="mb-5">Education</h2>

        <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="resume-content">
            <h3 class="mb-0">University of Colorado Boulder</h3>
            <div class="subheading mb-3">Bachelor of Science</div>
            <div>Computer Science - Web Development Track</div>
            <p>GPA: 3.23</p>
          </div>
          <div class="resume-date text-md-right">
            <span class="text-primary">August 2006 - May 2010</span>
          </div>
        </div>

        <div class="resume-item d-flex flex-column flex-md-row justify-content-between">
          <div class="resume-content">
            <h3 class="mb-0">James Buchanan High School</h3>
            <div class="subheading mb-3">Technology Magnet Program</div>
            <p>GPA: 3.56</p>
          </div>
          <div class="resume-date text-md-right">
            <span class="text-primary">August 2002 - May 2006</span>
          </div>
        </div>

      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="changepwd">
      <form class="form-signin" action="index.php"  method="POST">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Old Password</label>
    <br><br>
    <input  id="inputoldPassword"  type="password" name="inputEmail" class="form-control" placeholder="Old Password" required autofocus>
    <br><br>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputnewPassword" name="inputPassword" class="form-control" placeholder="New Password" required>
    <br><br>

    <label for="inputrenewPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Re enter new Password" required>
    <br><br>

    <button class="btn btn-lg btn-primary btn-block" id="changepwd_btn" type="submit">Change Password</button>


    <?php
        if(isset($_POST["changepwd_btn"])){
          $db="ds-portal";
          $host="localhost";
          $dsn= "mysql:host=$host;dbname=$db";
          $conn=new mysqli();
          $conn=new mysqli($host,"root","",$db);

          if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
            echo "failed";
          }
          $oldpwd=$_POST["inputoldPassword"];
          $newpwd=$_POST["inputnewPassword"];
          $renewpwd=$_POST["inputrenewPassword"];
          $username = $_SESSION["userid"];

          if($newpwd==$renewpwd){
            

          }
          else{
              echo  <label > "New passwords do not match" </label>;
          }

        }

     ?>
   </form>
     </section>
    <hr class="m-0">





  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/resume.min.js"></script>
  <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.sticky-sidebar.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
