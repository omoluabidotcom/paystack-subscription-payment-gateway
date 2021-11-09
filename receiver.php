<?php

$input = @file_get_contents("php://input");
$data = json_decode($input);

$event = $data->event;
$created = $data->created_at;
$amount = $data->plan->amount;
$interval = $data->plan->interval;
$fname = $data->customer->first_name;
$lname = $data->customer->last_name;
$email = $data->customer->email;
$customer_code = $data->customer->customer_code;
$fullname = $fname . ' ' . $lname;

if($event == 'subscription.create') {

    require 'dbconnect.php';

    $db = new dbconnect();
    $query = "INSERT INTO paystack(id, fullname, email, intervall, amount, customer_code, createdAt) 
              VALUES('', :fullname, :email, :intervall, :amount, :customer_code, :createdAt)";

    $stmt = $db->connector()->prepare($query);

    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':intervall', $interval);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':customer_code', $customer_code);
    $stmt->bindParam(':createdAt', $created);

    $stmt->execute();
    $stmt->close();

    } else {

        header("Location: error.html");
    }

http_response_code(200); 

?>