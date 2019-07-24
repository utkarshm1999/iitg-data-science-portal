<?php

error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();

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
            echo "<th>Firstname</th>";
            echo "<th>Lastname</th>";
            echo "<th>Email</th>";
            echo "<th>GATE Roll Number</th>";
            echo "<th>GATE Score</th>";
            echo "</tr>";

            while(($id = mysqli_fetch_array($res)) && $count <=2)
            {
              echo "<tr>";
              echo "<td>" . $id[apply_id] . "</td>";
              echo "<td>" . $id[first_name] . "</td>";
              echo "<td>" . $id[last_name] . "</td>";
              echo "<td>" . $id[email] . "</td>";
              echo "<td>" . $id[gate_roll_no] . "</td>";
              echo "<td>" . $id[gate_score] . "</td>";
              echo "<td>" . '<img height="300" width="300" src= "data:image;base64,'.$id[file].' "> ' . "</td>";
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
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <!-- <img src="showimage.php?id=22"; -->
  </body>
</html>
