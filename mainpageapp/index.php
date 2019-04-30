<?php session_start();
      if(!$_SESSION["logon"]){
        header("Location:../index.php");
        die();
      }
?>

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
          <a class="nav-link js-scroll-trigger" href="#advertisements">Advertisements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#notices">View Selections</a>
        </li>


        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#form">Apply</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#changepwd">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="signout.php">Sign Out</a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="container-fluid p-0">
    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="advertisements">
      <div class="w-100">
        <h2 class="mb-5">Advertisements</h2>
        <section class="hero-section overflow-hidden">
          <div class="hero-slider owl-carousel">

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
    $query="SELECT * FROM ads";
    try{

      $result=$conn->query($query);
      if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
          ?>


  		<<?php  echo	' <div class="hero-item set-bg d-flex align-items-center justify-content-center text-center" data-setbg="data:image;base64,'.$row["image"].' "> '; ?>
  				<div class="container">
  					<h2><?php echo $row["title"]; ?></h2>
  					<p> <?php echo $row["description"]; ?></p>
  					<a href="#" class="site-btn">Read More  <img src="img/icons/double-arrow.png" alt="#"/></a>
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

  </div>



    </section>

    <hr class="m-0">
    <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="notices">


        <?php

        error_reporting(E_ALL ^ E_NOTICE );
        error_reporting(E_ERROR | E_PARSE);
        //session based login system

            // $firstname = $_POST["firstName"];
            // $lastname=$_POST["lastName"];
            // $dob=$_POST["dob"];
            // $gender=$_POST["gender"];
            // $email=$_POST["email"];
            // $address=$_POST["address"];
            // $roll=$_POST["roll"];
            // $score=$_POST["score"];
            $count=1;
            $host="localhost";
            $db="ds-portal";
            $dsn= "mysql:host=$host;dbname=$db";
            $conn=new mysqli();
            $conn=new mysqli($host,"root","",$db);
            if($conn->connect_error){
              die("Connection failed: " . $conn->connect_error);
              echo "failed";
            }
          //  echo $username."  ".$pwd;
          //  echo $conn;
            $query="SELECT * FROM applications ORDER by gate_score DESC";
            try{

                if($res = mysqli_query($conn, $query))
                {
                  if(mysqli_num_rows($res) > 0)
                  {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Apllication ID</th>";
                    echo "     "."<th>Applicant Name</th>";
                    echo "</tr>";

                    while(($id = mysqli_fetch_array($res)))
                    {
                      echo "<tr>";
                      echo "<td>" . $id[apply_id] . "</td>";
                      echo "<td>"."     ". $id[first_name] . " " .  $id[last_name] . "</td>";

                  //    echo "<td>" . "<img src='",$id['file'],"' width='175' height='200' />"  /*img src= "data:'image';base64,".base64_encode($id[file]);*/ ."</td>";
                      // echo '<img src="data:image/jpeg;base64,'.$id[file].'"/>';
        //echo '<img src="data:image/jpeg;base64,'.base64_encode( $id[file] ).'"/>';

        //$imagedata=$id[file];
                      echo "</tr>";
                      $count=$count+1;
                    }
                    echo "</table>";
                    mysqli_free_result($res);
          //          header("content-type: image/jpeg");
            //        echo $imagedata;
                  }
                  else
                  {
                    echo "No matching records are found.";
                  }
                }
                else
                {
                  echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                }
                // $retval = mysqli_query($conn, $query);
                // if(! $retval )
                // {
                //   die('Could not get data: ' . mysqli_error());
                // }
                //
                // while($row = mysqli_fetch_array($retval, MYSQL_ASSOC) && count <=2)
                // {
                //   echo "<tr>";
                //        echo "<td>" . $id[apply_id] . "</td>";
                //        echo "<td>" . $id[first_name] . "</td>";
                //        echo "<td>" . $id[last_name] . "</td>";
                //        echo "<td>" . $id[email] . "</td>";950
                //        echo "<td>" . $id[gate_roll_no] . "</td>";
                //        echo "<td>" . $id[gate_score] . "</td>";
                //   echo "</tr>";
                //  echo "<br>";
            }
            catch(Exception $e)
            {
              echo "error is".$e;
            }
            $conn->close();
        ?>






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

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="form">
      <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h2>Application form for M.Tech Data Science Course</h2>
      <p class="lead">Please fill these details correctly. Any wrong information may lead to disqualification. Applicants should have graduation degree either from
  the CSE, ECE, EE or Math department, having a valid GATE score.</p>
    </div>

      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Personal Details</h4>
        <form class="needs-validation" action="application_form.php" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" name="firstName" placeholder="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" name="lastName" placeholder="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="dob">Date of birth</label>
              <input type="date" class="form-control" max="2019-04-27"  name="dob" placeholder="Date of birth" required>
              <div class="invalid-feedback" style="width: 100%;">
                Date of birth is required.
              </div>
          </div>

          <div class="mb-3">
            <label for="gender">Gender</label>
            <select class="form-control" name="gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
          </div>



          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
            <div class="invalid-feedback">
              Please enter your residential address.
            </div>
          </div>

          <div class="mb-3">
            <label for="roll">GATE Roll Number</label>
            <input type="number" class="form-control" name="roll" placeholder="" required>
            <div class="invalid-feedback">
              Please enter your valid gate roll number.
            </div>
          </div>

          <div class="mb-3">
          <label for="score">GATE score</label>
            <input type="number" class="form-control" name="score" placeholder="" required>
            <div class="invalid-feedback">
              Please enter your correct gate score.
            </div>
          </div>

          <div class="mb-3">
          <label for="upload_file"></label>
            <input type="file" class="form-control" name="upload_file" placeholder="" required>
            <div class="invalid-feedback">
              Please upload scanned image of your GATE report card.
            </div>
          </div>
          <!-- $target = "pics/";
          $target = $target . basename( $_FILES['Filename']['name']);
          //This gets all the other information from the form
          $Filename=basename( $_FILES['Filename']['name']);
          $Description=$_POST['Description'];
          //Writes the Filename to the server
          if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
              //Tells you if its all ok
              echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
              // Connects to your Database
              mysql_connect("localhost", "root", "") or die(mysql_error()) ;
              mysql_select_db("altabotanikk") or die(mysql_error()) ;
              //Writes the information to the database
              mysql_query("INSERT INTO picture (Filename,Description)
              VALUES ('$Filename', '$Description')") ;
          } else {
              //Gives and error if its not
              echo "Sorry, there was a problem uploading your file.";
          } -->



          <button name= "submit" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>

        </form>
  </div>
</div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="changepwd">
      <form class="form-signin" action="index.php"  method="POST">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputoldPassword" class="sr-only">Old Password</label>
    <br><br>
    <input  id="inputoldPassword"  type="password" name="inputoldPassword" class="form-control" placeholder="Old Password" required>
    <br><br>

    <label for="inputnewPassword" class="sr-only">Password</label>
    <input type="password" id="inputnewPassword" name="inputnewPassword" class="form-control" placeholder="New Password" required>
    <br><br>

    <label for="inputrenewPassword" class="sr-only">Password</label>
    <input type="password" id="inputrenewPassword" name="inputrenewPassword" class="form-control" placeholder="Re enter new Password" required>
    <br><br>

    <button class="btn btn-lg btn-primary btn-block" name="changepwd_btn" type="submit">Change Password</button>


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
          $oldpwd=md5($_POST["inputoldPassword"] );
          $newpwd=$_POST["inputnewPassword"];
          $renewpwd=$_POST["inputrenewPassword"];
          $username = $_SESSION["userid"];
          echo "$username";
          if($newpwd==$renewpwd){
            $query="SELECT password FROM users WHERE userid='$username'";
            try{

              $result=$conn->query($query);
              $res_pwd=mysqli_fetch_assoc($result);
            //  echo "old pwd ".$oldpwd." db pwd ".$res_pwd["password"];
              if($oldpwd==$res_pwd["password"]){
                $hashed=md5($newpwd);
                $query="UPDATE users SET password='$hashed' WHERE userid='$username'";
                $result=$conn->query($query);
                echo "<script type='text/javascript'>alert('Password Successfully Updated');</script>";


              }
              else{
                echo  "<label >"."Incorrect Old Password"."</label>";

              }
            }
            Catch( Exception $e){

            }

          }
          else{
              echo  "<label >"."New passwords do not match"."</label>";
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
