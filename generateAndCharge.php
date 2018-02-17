<?php
require_once "lib.php";
require_once "authorize.php";
require_once 'vendor/autoload.php';
require_once "createPDF.php";

//die($PDFresp);
//die("RQ: " . print_r($_REQUEST, true));
$amount = Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"];

$error = new stdClass();
$error->errorCode = 0;
$error->message = "Success";
$error->errorDescription ="Transaction completed successfully";
$error->transactionLog = array();
$error->PDFurl = "";
$error->transactionid = 0;
if(1==1) {
  $filename = "dydy.pdf";//time() . ".pdf";
  $PDFresp = createPDF(Config::$PDF_LOCATION . "/$filename", "F", request("design"));
  $error->PDFurl = $PDFresp;
  $error->errorCode = 1;

} else
{
writeLog("AUTHORIZING TRANSACTION: " . print_r(array($amount, str_replace("-", "", request(cardNumber)), "20" . request("date"), request("cvc")
, request("pfirstname"), request("plastname"), request("street"), request("city"), request("state"), request("zip")
, request("country"), request("email")), Config::LOG_LEVEL_INFO), true);

$e = authorizeCreditCard($amount, str_replace("-", "", request(cardNumber)), "20" . request("date"), request("cvc")
                            , request("pfirstname"), request("plastname"), request("street"), request("city"), request("state"), request("zip")
                            , request("country"), request("email"));
writeLog("AUTHORIZE RESULT: " . print_r($e, true), Config::LOG_LEVEL_INFO);
$id = $e->getTransactionResponse()->getTransId();

$error->transactionid = $id;
if($e->getTransactionResponse()->getMessages()) {
  $code = $e->getTransactionResponse()->getMessages()[0]->getCode();
  $error->message = $e->getTransactionResponse()->getMessages()[0]->getDescription() . " ";
  $error->transactionLog[] = "AUTHORIZE: " . $e->getTransactionResponse()->getMessages()[0]->getCode() . " " . $e->getTransactionResponse()->getMessages()[0]->getDescription();
}
$msgCode = $e->getMessages()->getMessage()[0]->getCode();
$errors = count($e->getTransactionResponse()->getErrors());
if($errors > 0)
{
  $error->message = "TRANSACTION ID: $id DECLINED ";
  $error->errorCode = $e->getTransactionResponse()->getErrors()[0]->getErrorCode();
  $error->errorDescription = $e->getTransactionResponse()->getErrors()[0]->getErrorText();
}
writeLog("A: $id /MC $msgCode /EC $errors /C $code");

if($e->getMessages()->getMessage()[0]->getCode() == "I00001" && $errors == 0 && $code == 1) {
  $filename = time() . ".pdf";
  $PDFresp = createPDF(Config::$PDF_LOCATION . "/$filename");
  if($PDFresp) {
    writeLog("CAPTURING TRANSACTION $id:");
    $ec = capturePreviouslyAuthorizedAmount($id);
    writeLog("CAPTURE $id RESULT: " . print_r($ec, true));

    if($ec->getTransactionResponse()->getMessages()) {
      $code = $ec->getTransactionResponse()->getMessages()[0]->getCode();
      $error->message = $ec->getTransactionResponse()->getMessages()[0]->getDescription();
      $error->transactionLog[] = "CAPTURE: " . $ec->getTransactionResponse()->getMessages()[0]->getCode() . " " . $ec->getTransactionResponse()->getMessages()[0]->getDescription();
    }

    $msgCode = $ec->getMessages()->getMessage()[0]->getCode();
    $errors = count($ec->getTransactionResponse()->getErrors());
    if($errors > 0)
    {
      $error->message = "TRANSACTION ID: $id DECLINED";
      $error->errorCode = $ec->getTransactionResponse()->getErrors()[0]->getErrorCode();
      $error->errorDescription = $ec->getTransactionResponse()->getErrors()[0]->getErrorText();
    }
    $error->PDFurl = $PDFresp; //"http;//http://realpaystubdownload.com/$filename";
    writeLog("CR: $id /MC $msgCode /EC $errors /C $code");

  } else {
    writeLog("VOIDING TRANSACTION $id:");
    $ec = voidTransaction($id);
    writeLog("VOID $id RESULT: " . print_r($ec, true));
    $error->description = "PDF generating problem";
    if($ec->getTransactionResponse()->getMessages()) {
      $code = $ec->getTransactionResponse()->getMessages()[0]->getCode();
      $error->message = $ec->getTransactionResponse()->getMessages()[0]->getDescription();
      $error->transactionLog[] = "VOID: " . $ec->getTransactionResponse()->getMessages()[0]->getCode() . " " . $ec->getTransactionResponse()->getMessages()[0]->getDescription();
    }

    $msgCode = $ec->getMessages()->getMessage()[0]->getCode();
    $errors = count($ec->getTransactionResponse()->getErrors());
    if($errors > 0)
    {
      //$error->message = "TRANSACTION ID: $id DECLINED";
      $error->errorCode = $ec->getTransactionResponse()->getErrors()[0]->getErrorCode();
      $error->message = $ec->getTransactionResponse()->getErrors()[0]->getErrorText();
    }
    writeLog("VR: $id /MC $msgCode /EC $errors /C $code");
  }
}
writeLog("RETURNED MESSAGE: " . print_r($error, true));
}
header('Content-Type: application/json');
echo json_encode($error);
