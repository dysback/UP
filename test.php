<?php
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

ini_set("display_errors", 1);
require 'sdk-php-master/autoload.php';
require 'vendor/autoload.php';

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName("463ysXYsA6K");
$merchantAuthentication->setTransactionKey("4FP5778k3wyL6q4P");

$refId = 'ref' . time();
// Create the payment data for a credit card
$creditCard = new AnetAPI\CreditCardType();
$creditCard->setCardNumber("4111111111111111");
$creditCard->setExpirationDate("2038-12");
$creditCard->setCardCode("123");

$paymentOne = new AnetAPI\PaymentType();
$paymentOne->setCreditCard($creditCard);

$order = new AnetAPI\OrderType();
$order->setInvoiceNumber("10101");
$order->setDescription("Golf Shirts");

$customerAddress = new AnetAPI\CustomerAddressType();
$customerAddress->setFirstName("Ellen");
$customerAddress->setLastName("Johnson");
$customerAddress->setCompany("Souveniropolis");
$customerAddress->setAddress("14 Main Street");
$customerAddress->setCity("Pecan Springs");
$customerAddress->setState("TX");
$customerAddress->setZip("44628");
$customerAddress->setCountry("USA");
// Set the customer's identifying information
$customerData = new AnetAPI\CustomerDataType();
$customerData->setType("individual");
$customerData->setId("99999456654");
$customerData->setEmail("EllenJohnson@example.com");

$duplicateWindowSetting = new AnetAPI\SettingType();
$duplicateWindowSetting->setSettingName("duplicateWindow");
$duplicateWindowSetting->setSettingValue("60");
// Add some merchant defined fields. These fields won't be stored with the transaction,
// but will be echoed back in the response.
$merchantDefinedField1 = new AnetAPI\UserFieldType();
$merchantDefinedField1->setName("customerLoyaltyNum");
$merchantDefinedField1->setValue("1128836273");
$merchantDefinedField2 = new AnetAPI\UserFieldType();
$merchantDefinedField2->setName("favoriteColor");
$merchantDefinedField2->setValue("blue");
// Create a TransactionRequestType object and add the previous objects to it
$transactionRequestType = new AnetAPI\TransactionRequestType();
$transactionRequestType->setTransactionType("authCaptureTransaction");
$transactionRequestType->setAmount(12);//$amount
$transactionRequestType->setOrder($order);
$transactionRequestType->setPayment($paymentOne);
$transactionRequestType->setBillTo($customerAddress);
$transactionRequestType->setCustomer($customerData);
$transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
$transactionRequestType->addToUserFields($merchantDefinedField1);
$transactionRequestType->addToUserFields($merchantDefinedField2);

// Assemble the complete transaction request
$request = new AnetAPI\CreateTransactionRequest();
$request->setMerchantAuthentication($merchantAuthentication);
$request->setRefId($refId);
$request->setTransactionRequest($transactionRequestType);
// Create the controller and get the response
$controller = new AnetController\CreateTransactionController($request);

$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);




print_r($response);

die("-----");

require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B', 24);
$pdf->Cell(100,10,'Hi Brennan!');
$pdf->SetFont('Arial','I', 9);
$pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
$pdf->SetFont('Arial','', 12);
$pdf->Cell(100,10,'11/07/2017');
$pdf->Output("testIIS.pdf", "D");

// phpinfo();
