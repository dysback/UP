<?php
  require_once 'vendor/autoload.php';
  require_once 'lib.php';
  require_once "conf.php";

  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
//  define("AUTHORIZENET_LOG_FILE", "phplog");

function authorizeCreditCard(   $amount,
                                $creDitCardNumber,
                                $expiratonDate,
                                $cardCode,
                                $firstName,
                                $lastName,
                                $address,
                                $city,
                                $state,
                                $zip,
                                $country,
                                $email
                                )
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(Config::$MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(Config::$MERCHANT_TRANSACTION_KEY);

    // Set the transaction's refId
    $refId = 'ref' . time();
    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($creDitCardNumber);
    $creditCard->setExpirationDate($expiratonDate);
    $creditCard->setCardCode($cardCode);
    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);
    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber(getInvoiceNumber());
    $order->setDescription("Paycheck Stub");
    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($firstName);
    $customerAddress->setLastName($lastName);
    //$customerAddress->setCompany("Souveniropolis");
    $customerAddress->setAddress($address);
    $customerAddress->setCity($city);
    $customerAddress->setState($state);
    $customerAddress->setZip($zip);
    $customerAddress->setCountry($country);
    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    //$customerData->setId("99999456654");
    $customerData->setEmail($email);
    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    ///$duplicateWindowSetting->setSettingName("duplicateWindow");
    ///$duplicateWindowSetting->setSettingValue("60");
    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    /*
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("customerLoyaltyNum");
    $merchantDefinedField1->setValue("1128836273");
    $merchantDefinedField2 = new AnetAPI\UserFieldType();
    $merchantDefinedField2->setName("favoriteColor");
    $merchantDefinedField2->setValue("blue");
    */
    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authOnlyTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);
    //$transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    //$transactionRequestType->addToUserFields($merchantDefinedField1);
    //$transactionRequestType->addToUserFields($merchantDefinedField2);
    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);
    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    if(Config::$IS_PRODUCTION) {
      $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    } else {
      $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    }
    //die("++" . print_r($response, true) . "++");


    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {
                ///echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                ///echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                ///echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                ///echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                ///echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
            } else {
                ///echo "Transaction Failed \n";
                if ($tresponse->getErrors() != null) {
                    ///echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                    ///echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                }
            }
            // Or, print errors if the API request wasn't successful
        } else {
            ///echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getErrors() != null) {
                ///echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                ///echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                ///echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                ///echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }
    } else {
        ///echo  "No response returned \n";
        return null;
    }
    //die("++" . print_r($response, true) . "++");

    return $response;
}


function capturePreviouslyAuthorizedAmount($transactionid)
{
   /* Create a merchantAuthenticationType object with authentication details
      retrieved from the constants file */
   $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
   $merchantAuthentication->setName(Config::$MERCHANT_LOGIN_ID);
   $merchantAuthentication->setTransactionKey(Config::$MERCHANT_TRANSACTION_KEY);

   // Set the transaction's refId
   $refId = 'ref' . time();
   // Now capture the previously authorized  amount
   //echo "Capturing the Authorization with transaction ID : " . $transactionid . "\n";
   $transactionRequestType = new AnetAPI\TransactionRequestType();
   $transactionRequestType->setTransactionType("priorAuthCaptureTransaction");
   $transactionRequestType->setRefTransId($transactionid);

   $request = new AnetAPI\CreateTransactionRequest();
   $request->setMerchantAuthentication($merchantAuthentication);
   $request->setTransactionRequest( $transactionRequestType);
   $controller = new AnetController\CreateTransactionController($request);
   if(Config::$IS_PRODUCTION) {
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
  } else {
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
  }

   if ($response != null)
   {
     if($response->getMessages()->getResultCode() == "Ok")
     {
       $tresponse = $response->getTransactionResponse();

         if ($tresponse != null && $tresponse->getMessages() != null)
       {
           //echo " Transaction Response code : " . $tresponse->getResponseCode() . "\n";
           //echo "Successful." . "\n";
           //echo "Capture Previously Authorized Amount, Trans ID : " . $tresponse->getRefTransId() . "\n";
           //echo " Code : " . $tresponse->getMessages()[0]->getCode() . "\n";
           //echo " Description : " . $tresponse->getMessages()[0]->getDescription() . "\n";
       }
       else
       {
         //echo "Transaction Failed \n";
         if($tresponse->getErrors() != null)
         {
           //echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
           //echo " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
         }
       }
     }
     else
     {
       //echo "Transaction Failed \n";
       $tresponse = $response->getTransactionResponse();
       if($tresponse != null && $tresponse->getErrors() != null)
       {
         //echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
         //echo " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
       }
       else
       {
         //echo " Error code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
         //echo " Error message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
       }
     }
   }
   else
   {
     //echo  "No response returned \n";
   }
   return $response;
 }


function voidTransaction($transactionid)
{
  /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName(Config::$MERCHANT_LOGIN_ID);
  $merchantAuthentication->setTransactionKey(Config::$MERCHANT_TRANSACTION_KEY);

  // Set the transaction's refId
  $refId = 'ref' . time();
  //create a transaction
  $transactionRequestType = new AnetAPI\TransactionRequestType();
  $transactionRequestType->setTransactionType( "voidTransaction");
  $transactionRequestType->setRefTransId($transactionid);
  $request = new AnetAPI\CreateTransactionRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setRefId($refId);
  $request->setTransactionRequest( $transactionRequestType);
  $controller = new AnetController\CreateTransactionController($request);
  if(Config::$IS_PRODUCTION) {
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
  } else {
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
  }

  if ($response != null) {
    if($response->getMessages()->getResultCode() == "Ok") {
      $tresponse = $response->getTransactionResponse();
      if ($tresponse != null && $tresponse->getMessages() != null) {
        /*
        echo " Transaction Response code : " . $tresponse->getResponseCode() . "\n";
        echo " Void transaction SUCCESS AUTH CODE: " . $tresponse->getAuthCode() . "\n";
        echo " Void transaction SUCCESS TRANS ID  : " . $tresponse->getTransId() . "\n";
        echo " Code : " . $tresponse->getMessages()[0]->getCode() . "\n";
        echo " Description : " . $tresponse->getMessages()[0]->getDescription() . "\n";
        */
      }
    else {
      //echo "Transaction Failed \n";
      if($tresponse->getErrors() != null) {
//        echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
//        echo " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
     }
    }
  } else {
//    echo "Transaction Failed \n";
    $tresponse = $response->getTransactionResponse();
    if($tresponse != null && $tresponse->getErrors() != null) {
//      echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
//      echo " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
    } else {
//      echo " Error code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
//      echo " Error message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
    }
  }
} else {
//  echo  "No response returned \n";
}
return $response;
}
