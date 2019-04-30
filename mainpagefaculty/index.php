<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
if(!$_SESSION["logon"]){
  header("Location:../index.php");
  die();
}
if(isset($_POST["submit"]))
{
  if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_FILES['myfile']['name'];
    $file = addslashes($_FILES['myfile']['tmp_name']);
    $file = file_get_contents($file);
    $file = base64_encode($file);
    $data = $file;
    $tableName = "assignments";

    $host="localhost";
    $db="ds-portal";
    $dsn= "mysql:host=$host;dbname=$db";
    $conn=new mysqli();
    $conn=new mysqli($host,"root","",$db);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
      echo "failed";
    }

    if(isset($name)){
        if(!empty($name)){

          $query="INSERT INTO assignments (id,Attachment) VALUES (DEFAULT,'$data');";

            try
            {
            //  echo $query;
            if ($conn->query($query) == TRUE) {
                $msg = "Successfully uploaded";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
              echo "<script type='text/javascript'>alert('Failed!!!');</script>";    }
            }
            catch(Exception $e)
            {
              echo "error is".$e;
            }
          }
      }
     else {
        echo 'You should select a file to upload !!';
    }

    $conn->close();
    }

}

if(isset($_POST["download"]))
{
  if($_SERVER["REQUEST_METHOD"]=="POST"){

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
    $query="SELECT * FROM assignments ORDER by id DESC";
    try{

        if($res = mysqli_query($conn, $query))
        {
          $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
          echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }

        if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM assignments WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];


        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        exit;


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
    }

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

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/resume.min.css" rel="stylesheet">

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
          <a class="nav-link js-scroll-trigger" href="#advertisements">Send Advertisements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#notices">Send Notices</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#apply">Upload Course Material</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#results">Application Form</a>
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

      <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="advertisements">
        <br><br><br>
        <form class="form-signin" action="index.php"  method="POST" enctype="multipart/form-data">

          <br><br>
          <br><br>
        <h1 class="h3 mb-3 font-weight-normal">Post a new Advertisement</h1>

        <br><br>
        <br><br>
        <label for="inputEmail" class="sr-only">Title</label>
        <input  id="inputEmail"  name="inputTitleAd" class="form-control" placeholder="Title" required autofocus>
        <br><br>
        <br><br>

        <div class="mb-3">
          <label for="upload_img_ad">Upload an image for the Advertisement</label>
            <input type="file" class="form-control" name="upload_img_ad" placeholder="" required>
              <div class="invalid-feedback">
                  Please upload an image of the Advertisement
                </div>
            </div>
        <br><br>
        <br><br>

        <textarea  cols="60" rows="10" name="inputDescriptionAd" placeholder="Description"></textarea>
        <br><br>

        <button class="btn btn-lg btn-primary btn-block" name="btn_send_ad" type="submit">Post Advertisement</button>

        <?php
          error_reporting(E_ALL ^ E_NOTICE );
          error_reporting(E_ERROR | E_PARSE);
          //session based login system

          $target_dir = "/uploads";
          $target_file = $target_dir . basename($_FILES["upload_img_ad"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          if(isset($_POST["btn_send_ad"]))
          {
            if($_SERVER["REQUEST_METHOD"]=="POST"){
              $title_ad=$_POST["inputTitleAd"];
              $description_ad=$_POST["inputDescriptionAd"];



                  $check = getimagesize($_FILES["upload_img_ad"]["tmp_name"]);
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
              if ($_FILES["upload_img_ad"]["size"] > 2097152) {
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
                $file = addslashes($_FILES['upload_img_ad']['tmp_name']);
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
              $query="INSERT INTO ads (title,description,image) VALUES ('$title_ad','$description_ad','$file')";
              if ($conn->query($query) === TRUE) {
                  $msg = "Posted the Advertisement successfully!";
                  echo "<script type='text/javascript'>alert('$msg');</script>";
              } else {
                echo "<script type='text/javascript'>alert('Failed!!!');</script>";    }
              $conn->close();
            }
          }
      ?>
      </form>
      </section>


      <hr class="m-0">

      <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="notices">
        <br><br><br>
        <form class="form-signin" action="index.php"  method="POST">

          <br><br>
          <br><br>
        <h1 class="h3 mb-3 font-weight-normal">Send a new notice</h1>

        <br><br>
        <br><br>
        <label for="inputEmail" class="sr-only">Title</label>
        <input  id="inputEmail"  name="inputTitle" class="form-control" placeholder="Title" required autofocus>

        <br><br>
        <br><br>

        <textarea  cols="60" rows="10" name="inputDescription" placeholder="Description"></textarea>
        <br><br>

        <button class="btn btn-lg btn-primary btn-block" name="btn_send" type="submit">Send Notice</button>

        <?php

            if(isset($_POST["btn_send"])){
              if($_SERVER["REQUEST_METHOD"]=="POST"){

                $title=$_POST["inputTitle"];
                $description=$_POST["inputDescription"];
                if($title!="" && $description!="" ){
                  $db="ds-portal";
                  $host="localhost";
                  $dsn= "mysql:host=$host;dbname=$db";
                  $conn=new mysqli();
                  $conn=new mysqli($host,"root","",$db);
                  if($conn->connect_error){
                    die("Connection failed: " . $conn->connect_error);
                    echo "failed";
                  }

                  $query="INSERT INTO notices (title, description) VALUES ('$title','$description') ";

                  try{

                    $conn->query($query);


                }
                catch(Exception $e){
                  echo "error is".$e;
                }
              }
              else{
                echo "Enter non empty title and description";
              }
            }
          }
         ?>
      </form>



      </section>

    <hr class="m-0">
    <form class="needs-validation" action="index.php" enctype="multipart/form-data" method="post">
    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="apply">
      <div class="w-100">
        <h2 class="mb-5">Course management</h2>
        <div class="mb-3">
        <label for="file"></label>
          <input type="file" class="form-control" name="myfile" placeholder="" required>
          <div class="invalid-feedback">
            Please upload file.
          </div>
        </div>

        <!-- <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
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
        </div> -->



        <button name= "submit" class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
        <button name= "download" class="btn btn-lg btn-primary btn-block" type="button">Download</button>
      </div>
    </section>
</form>
    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="results">
      <div class="w-100">
        <h2 class="mb-5">Skills</h2>

        <div class="subheading mb-3">Programming Languages &amp; Tools</div>
        <ul class="list-inline dev-icons">
          <li class="list-inline-item">
            <i class="fab fa-html5"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-css3-alt"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-js-square"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-angular"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-react"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-node-js"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-sass"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-less"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-wordpress"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-gulp"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-grunt"></i>
          </li>
          <li class="list-inline-item">
            <i class="fab fa-npm"></i>
          </li>
        </ul>

        <div class="subheading mb-3">Workflow</div>
        <ul class="fa-ul mb-0">
          <li>
            <i class="fa-li fa fa-check"></i>
            Mobile-First, Responsive Design</li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Cross Browser Testing &amp; Debugging</li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Cross Functional Teams</li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Agile Development &amp; Scrum</li>
        </ul>
      </div>
    </section>

    <hr class="m-0">
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

          if($newpwd==$renewpwd){
            $query="SELECT password FROM users WHERE userid='$username'";
            echo "user id is ".$username;
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




  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/resume.min.js"></script>

</body>

</html>
