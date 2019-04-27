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
    $query="SEARCH * FROM applications ORDER by gate_score";
    try{
      $result=$conn->query($query);
      $id=mysqli_fetch_assoc($result);
      echo "<tr>";
                echo "<td>" . $id[apply_id] . "</td>";
                echo "<td>" . $id[first_name] . "</td>";
                echo "<td>" . $id[last_name] . "</td>";
                echo "<td>" . $id[email] . "</td>";
                echo "<td>" . $id[gate_roll_no] . "</td>";
                echo "<td>" . $id[gate_score] . "</td>";
      echo "</tr>";
      exit();
    }
    catch(Exception $e){
      echo "error is".$e;
    }

    $conn->close();


?>
