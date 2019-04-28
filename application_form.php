<<<<<<< HEAD
<?php
=======

<?php

>>>>>>> ut
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
<<<<<<< HEAD

$target_dir = "/uploads";
$target_file = $target_dir . basename($_FILES["upload_file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
=======
>>>>>>> ut
if(isset($_POST["submit"]))
{
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $firstname = $_POST["firstName"];
    $lastname=$_POST["lastName"];
    $dob=$_POST["dob"];
    $gender=$_POST["gender"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $roll=$_POST["roll"];
    $score=$_POST["score"];

<<<<<<< HEAD
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
    //
    // if(isset($_FILES['upload_file']))
    // {
    //     $errors     = array();
    //     $maxsize    = 2097152;
    //     $acceptable = array(
    //         'image/jpeg',
    //         'image/jpg',
    //         'image/png'
    //     );
    //
    //     if(($_FILES['upload_file']['size'] >= $maxsize) || ($_FILES["upload_file"]["size"] == 0))
    //     {
    //         $errors[] = 'File too large. File must be less than 2 megabytes.';
    //     }
    //
    //     if((!in_array($_FILES['upload_file']['type'], $acceptable)) || (empty($_FILES["upload_file"]["type"])))
    //     {
    //         $errors[] = 'Invalid file type. Only JPG, JPEG and PNG types are accepted.';
    //     }
    //
    //     if(count($errors) == 0)
    //     {
    //       $file = addslashes($_FILES['upload_file']['tmp_name']);
    //       $file = file_get_contents($file);
    //       $file = base64_encode($file);
    //     }
    //     else
    //     {
    //         foreach($errors as $error)
    //         {
    //             echo '<script>alert("'.$error.'");</script>';
    //         }
    //         die(); //Ensure no more processing is done
    //     }
    // }

    // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["upload_file"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["upload_file"]["size"] > 2097152) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG & PNG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        die();
    // if everything is ok, try to upload file
    } else {
      $file = addslashes($_FILES['upload_file']['tmp_name']);
      $file = file_get_contents($file);
      $file = base64_encode($file);
    }



    // if(getimagesize($_FILES['upload_file']['tmp_name'])==FALSE)
    // {
    //   echo "Please select an image.";
    //   return;
    // }
    // else {
    //
    // }
  //  $file=$POST["upload_file"];
=======
>>>>>>> ut
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
<<<<<<< HEAD
    $query="INSERT INTO applications (apply_id, first_name, last_name, dob, gender, email, address, gate_roll_no, gate_score,file) VALUES (DEFAULT,'$firstname','$lastname','$dob','$gender','$email','$address','$roll','$score','$file')";
=======
    $query="INSERT INTO applications (apply_id, first_name, last_name, dob, gender, email, address, gate_roll_no, gate_score) VALUES (DEFAULT,'$firstname','$lastname','$dob','$gender','$email','$address','$roll','$score')";
>>>>>>> ut
    if ($conn->query($query) === TRUE) {
        $msg = "Your application number is: " . mysqli_insert_id($conn);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    } else {
      echo "<script type='text/javascript'>alert('Failed!!!');</script>";    }
<<<<<<< HEAD
    $conn->close();
  }
}
=======

    $conn->close();
  }
}

>>>>>>> ut
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Checkout example · Bootstrap</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.3/examples/checkout/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
<<<<<<< HEAD
=======

>>>>>>> ut
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Application form for M.Tech Data Science Course</h2>
    <p class="lead">Please fill these details correctly. Any wrong information may lead to disqualification. Applicants should have graduation degree either from
the CSE, ECE, EE or Math department, having a valid GATE score.</p>
  </div>

    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Personal Details</h4>
<<<<<<< HEAD
      <form class="needs-validation" action="application_form.php" enctype="multipart/form-data" method="post">
=======
      <form class="needs-validation" action="application_form.php" method="post">
>>>>>>> ut
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

<<<<<<< HEAD
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
=======

        <!-- $target = "pics/";
        $target = $target . basename( $_FILES['Filename']['name']);

        //This gets all the other information from the form
        $Filename=basename( $_FILES['Filename']['name']);
        $Description=$_POST['Description'];


>>>>>>> ut
        //Writes the Filename to the server
        if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
            //Tells you if its all ok
            echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
            // Connects to your Database
            mysql_connect("localhost", "root", "") or die(mysql_error()) ;
            mysql_select_db("altabotanikk") or die(mysql_error()) ;
<<<<<<< HEAD
=======

>>>>>>> ut
            //Writes the information to the database
            mysql_query("INSERT INTO picture (Filename,Description)
            VALUES ('$Filename', '$Description')") ;
        } else {
            //Gives and error if its not
            echo "Sorry, there was a problem uploading your file.";
        } -->



        <button name= "submit" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>


</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="form-validation.js"></script></body>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
