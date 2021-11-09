<?php

  if(!empty($_POST['subcribe'])) {

      $email = $_POST['email_address'];
      $limit = $_POST['invoice_limits'];

      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/plan",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => [
            "name" => "Membership Monthly Subscription",
            "interval" => "monthly",
            "amount" => 500000,
            "invoice_limits" => $limit
      ],
            CURLOPT_HTTPHEADER => array(
                  "Authorization: Bearer sk_test_fd20ca4e220a38750623dcd5bb9b39ab3c484336",
                  "Cache-Control: no-cache"
            ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
            echo "cURL Error #:" . $err;
      } else {
             $result = json_decode($response);
             $plancode = $result->data->plan_code;
             require 'initialize.php';
      }
}

?>

<html>
    <head>
        Paystack Subcription Integration
    </head>
    <body>
        <form method="POST" action="index.php">

          <div>
          <label for="email">Email Address</label>
          <input type="email" name="email_address" required />
          </div>

          <select name="invoice_limits" required>
            <option value="" selected="selected" > Please Select </option>
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
            <option value="3"> 3 </option>
            <option value="4"> 4 </option>
            <option value="5"> 5 </option>
            <option value="6"> 6 </option>
            <option value="7"> 7 </option>
            <option value="8"> 8 </option>
            <option value="9"> 9 </option>
            <option value="10"> 10 </option>
            <option value="11"> 11 </option>
            <option value="12"> 12 </option>
          </select>

          <div>
          <button type="submit" name="subcribe" value="SUBCRIBE"> Pay </button>
          </div>

      
        </form>
    </body>
</html>