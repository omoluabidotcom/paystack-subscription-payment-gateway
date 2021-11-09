<?php
  $url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => $email,
    'amount' => "500000",
    'plan' => $plancode
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_test_fd20ca4e220a38750623dcd5bb9b39ab3c484336",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  $data = json_decode($result);

  $redirect = $data->data->authorization_url;

  if($result) {

    header("Location: " . $redirect);
    exit;
  }
?>