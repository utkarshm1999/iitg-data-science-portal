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
          <a class="nav-link js-scroll-trigger" href="#apply">View Applicants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#register">Close Registrations </a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#gradecard">Send Results</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#results">Sign Out</a>
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

            $host="localhost";
            $db="ds-portal";
            $dsn= "mysql:host=$host;dbname=$db";
            $conn=new mysqli();
            $conn=new mysqli($host,"root","",$db);
            if($conn->connect_error){
              die("Connection failed: " . $conn->connect_error);
              echo "failed";
            }

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

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="apply">
      <?php

      error_reporting(E_ALL ^ E_NOTICE );
      error_reporting(E_ERROR | E_PARSE);
      //session based login system
      session_start();

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
          $query="SELECT * FROM applications ORDER by gate_score DESC";
          try{

              if($res = mysqli_query($conn, $query))
              {
                if(mysqli_num_rows($res) > 0)
                {
                  echo "<table>";
                  echo "<tr>";
                  echo "<th>Apllication ID</th>";
                  echo "<th>Firstname</th>";
                  echo "<th>Lastname</th>";
                  echo "<th>Email</th>";
                  echo "<th>GATE Roll Number</th>";
                  echo "<th>GATE Score</th>";
                  echo "</tr>";

                  while(($id = mysqli_fetch_array($res)))
                  {
                    echo "<tr>";
                    echo "<td>" . $id[apply_id] . "</td>";
                    echo "<td>" . $id[first_name] . "</td>";
                    echo "<td>" . $id[last_name] . "</td>";
                    echo "<td>" . $id[email] . "</td>";
                    echo "<td>" . $id[gate_roll_no] . "</td>";
                    echo "<td>" . $id[gate_score] . "</td>";
                    echo "<td>" . '<img height="300" width="300" src= "data:image;base64,'.$id[file].' "> ' . "</td>";
                    echo "</tr>";
                    $count=$count+1;
                  }
                  echo "</table>";
                  mysqli_free_result($res);
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
          }
          catch(Exception $e)
          {
            echo "error is".$e;
          }
          $conn->close();
      ?>

    </section>


    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="register" >
      <form class="needs-validation" action="index.php" enctype="multipart/form-data" method="post">
   <input name="close" type="submit" value="Confirm to Close Registrations" id="close">
 </form>
      <?php
      function randomPassword()
      {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++)
        {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
      }
      if(isset($_POST["close"]))
      {
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
        $query="SELECT * FROM checkout WHERE id = '1'";
      //  echo "string";
        try{

            if($res = mysqli_query($conn, $query))
            {
              if(mysqli_num_rows($res) > 0)
              {
                while(($id = mysqli_fetch_array($res)))
                {

                  if($id[value]==1)
                  {
                    echo "<script type='text/javascript'>alert('Registrations already closed .');</script>";
                    return;
                  }
                  else {
                    ?>
                     <script type='text/javascript'>

                           document.getElementById("close").style.display = "none";


                     </script>
                    <?php

                  }
                  require '../libphp-phpmailer/class.phpmailer.php';
                  require '../libphp-phpmailer/class.smtp.php';

                    $query2 = "UPDATE checkout SET value = '1' WHERE id = '1';";
                    mysqli_query($conn, $query2);

                    $query5="SELECT * FROM applications ORDER by gate_score DESC";
                    try{

                        if($res = mysqli_query($conn, $query5))
                        {
                          if(mysqli_num_rows($res) > 0)
                          {

                            $count=1;



                            while(($id = mysqli_fetch_array($res)) && $count <=20)
                            {

                              $query6 = "UPDATE applications SET Selected = 'Yes' WHERE apply_id = '$id[apply_id]';";
                              mysqli_query($conn, $query6);
                              $count=$count+1;
                            }
                            mysqli_free_result($res);

                          }
                          else
                          {
                            //echo "No matching records are found.";
                          }
                        }
                        else
                        {
                          echo "Connection Error";
                          //echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                        }

                      $query3="SELECT * FROM applications WHERE Selected = 'Yes' ORDER by first_name ASC";
                      try{

                          if($res = mysqli_query($conn, $query3))
                          {
                            if(mysqli_num_rows($res) > 0)
                            {
                              echo '<h2> Selected Students:</h2>';
                              echo '<br>';
                              echo "<table>";
                              echo "<tr>";
                              echo "<th>ID</th>";
                              echo "<th>Name</th>";
                              echo "<th>Email</th>";
                              echo "<th>GATE Roll Number</th>";
                              echo "<th>GATE Score</th>";
                              echo "</tr>";
                              $count=1;



                              while(($id = mysqli_fetch_array($res)))
                              {
                                echo "<tr>";
                                echo "<td>" . $id[apply_id] . "</td>";
                                echo "<td>" . $id[first_name] . " " . $id[last_name] . "</td>";
                                echo "<td>" . $id[email] . "</td>";
                                echo "<td>" . $id[gate_roll_no] . "</td>";
                                echo "<td>" . $id[gate_score] . "</td>";
                                echo "<td>" . '<img height="300" width="300" src= "data:image;base64,'.$id[file].' "> ' . "</td>";

                                echo "</tr>";


                                $user=strtolower($id[first_name]) . $count;
                                $pass=randomPassword();
                                $mail = new PHPMailer;

                                $mail->SMTPDebug = 0;                               // Enable verbose debug output

                                $mail->isSMTP();                                      // Set mailer to use SMTP
                                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                $mail->Username = 'dsportaluk@gmail.com';                 // SMTP username
                                $mail->Password = 'dsportal@123';                           // SMTP password
                                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 587;                                    // TCP port to connect to

                                $mail->setFrom('dsportaluk@gmail.com', 'DS Portal');
                                $mail->addAddress($id[email]);     // Add a recipient
                                $mail->isHTML(true);                                  // Set email format to HTML

                                $mail->Subject = 'Selected for IITG Data Science M.Tech course';
                                $mail->Body    = "Dear " . $id[first_name] . " " . $id[last_name] . "<br>" . " Congratulations, you have been selected for the M.Tech course in Data Science Course at IIT Guwahati. Your username and password are as follows:<br>" . $user  . "<br>" . $pass ;
                                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                if(!$mail->send())
                                {
                                    echo 'Message could not be sent.';
                                  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
                                }
                                else
                                {
                                  //  echo 'Message has been sent';
                                    //$userid=$id[first_name] . $count;
                                    $pass=md5($pass);
                                    $query4="INSERT INTO users (userid,usertype,password,semester) VALUES ('$user','student','$pass','1')";
                                    $conn->query($query4);
                                    $query7 = "UPDATE applications SET roll_number='$count',userid = '$user',password='$pass' WHERE apply_id = '$id[apply_id]';";
                                    mysqli_query($conn, $query7);
                                }
                                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                                $count=$count+1;
                              }
                              echo "</table>";
                              mysqli_free_result($res);
                              echo "<script type='text/javascript'>alert('Registration closed and sent mail to selected students');</script>";

                            }
                            else
                            {
                              //echo "No matching records are found.";
                            }
                          }
                          else
                          {
                            echo "Connection Error";
                            //echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                          }

                      }
                      catch(Exception $e)
                      {
                        echo "error is".$e;
                      }
                  }
                  catch(Exception $e)
                  {
                    echo "error is".$e;
                  }
                }

                mysqli_free_result($res);
              }
            else
            {
              echo "ERROR: Conncetion Error!!\n Could not able to execute $query. " . mysqli_error($conn);
            }

        }
      }
        catch(Exception $e)
        {
          echo "error is".$e;
        }
        $conn->close();
      }

      ?>

    </section>

    <?php
    require '../libphp-phpmailer/class.phpmailer.php';
    require '../libphp-phpmailer/class.smtp.php';
    if(isset($_POST["submit1"]))
    {
      if($_SERVER["REQUEST_METHOD"]=="POST")
      {
        $student_id = $_POST["student_id"];

          $name = $_FILES['upload']['name'];
          $file = addslashes($_FILES['upload']['tmp_name']);
          $file = file_get_contents($file);
          $file = base64_encode($file);
          $data = $file;
          $tableName = "results";

          $host="localhost";
          $db="ds-portal";
          $dsn= "mysql:host=$host;dbname=$db";
          $conn=new mysqli();
          $conn=new mysqli($host,"root","",$db);
          if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
            echo "failed";
          }

          if(isset($name))
          {
              if(!empty($name))
              {

                  $query="INSERT INTO results (id,student_id,Attachment) VALUES (DEFAULT,'$student_id','$data');";

                  try
                  {
                    //  echo $query;
                    if ($conn->query($query) == TRUE)
                    {
                        $query3="SELECT * FROM applications WHERE roll_number = '$student_id'";
                        try{
                            if($res = mysqli_query($conn, $query3))
                            {
                              if(mysqli_num_rows($res) > 0)
                              {

                                while(($id = mysqli_fetch_array($res)))
                                {
                                  $email_id = $id[email];

                                  $mail = new PHPMailer;

                                  $mail->SMTPDebug = 0;                               // Enable verbose debug output

                                  $mail->isSMTP();                                      // Set mailer to use SMTP
                                  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                  $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                  $mail->Username = 'dsportaluk@gmail.com';                 // SMTP username
                                  $mail->Password = 'dsportal@123';                           // SMTP password
                                  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                  $mail->Port = 587;                                    // TCP port to connect to

                                  $mail->setFrom('dsportaluk@gmail.com', 'DS Portal');
                                  $mail->addAddress($email_id);     // Add a recipient
                                  $mail->isHTML(true);                                  // Set email format to HTML

                                  $mail->Subject = 'Your grade card';
                                  $mail->Body    = "Dear " . $id[first_name] . " " . $id[last_name] . "<br>" . "Please find attached your grade card.";
                                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                  $mail->addAttachment($_FILES['upload']['tmp_name'], 'gradecard' . $id[roll_number]);

                                  if(!$mail->send())
                                  {
                                      echo 'Message could not be sent.';
                                    //  echo 'Mailer Error: ' . $mail->ErrorInfo;
                                  }
                                  else
                                  {
                                    //  echo 'Message has been sent';

                                  }

                                }
                              }
                              $msg = "Successfully uploaded and sent mail";
                              echo "<script type='text/javascript'>alert('$msg');</script>";
                            }
                            else
                            {
                              echo "<script type='text/javascript'>alert('Failed!!!');</script>";
                            }
                          }
                          catch(Exception $e)
                          {
                            echo "error is".$e;
                          }
                    }
                    else
                    {
                        echo 'You should select a file to upload !!';
                    }

                  }
                  catch(Exception $e)
                  {
                    echo "error is".$e;
                  }

                  $conn->close();
              }
          }
      }
    }
    ?>


    <hr class="m-0">
    <form class="needs-validation" action="index.php" enctype="multipart/form-data" method="post">
    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="gradecard">
  <div class="w-100">
        <h2 class="mb-5">Send Results</h2>

        <label for="student_id">Select student roll number</label>
        <?php
        $host="localhost";
        $db="ds-portal";
        $dsn= "mysql:host=$host;dbname=$db";
        $conn=new mysqli();
        $conn=new mysqli($host,"root","",$db);
        if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
          echo "failed";
        }

        $query5="SELECT * FROM applications WHERE Selected = 'Yes' ORDER by roll_number ASC";
        try{

            if($res = mysqli_query($conn, $query5))
            {
              if(mysqli_num_rows($res) > 0)
              {
                echo '<select class="form-control" name="student_id">';
                while(($id = mysqli_fetch_array($res)))
                {
                  echo '<option value="'.$id[roll_number].'">' . $id[roll_number] . '</option>';
                }
                echo '  </select>';
                mysqli_free_result($res);

              }
              else
              {
                echo "<script type='text/javascript'>alert('No student record found');</script>";
                die();
              }
            }
            else
            {
              echo "Connection Error";
              //echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
            }
          }
          catch(Exception $e)
          {
            echo "error is".$e;
          }
         ?>
        <!--
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option> -->


        <label for="file"></label>
          <input name="upload" type="file" class="form-control" placeholder="" required>
          <div class="invalid-feedback">
            Please upload file.
          </div>
                  <button name= "submit1" class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
                  <button name= "download" class="btn btn-lg btn-primary btn-block" type="button">Download</button>
        </div>
    </section>
  </form>

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
