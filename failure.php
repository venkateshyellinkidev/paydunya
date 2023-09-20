<h1>Failure</h1>
<?php
require('vendor/autoload.php');
\Paydunya\Setup::setMasterKey("w45AVPgF-JqMA-W45K-gGJm-XorU2n7bh8rU");
\Paydunya\Setup::setPublicKey("test_public_B2yRErL9pE3tJUHO2dikzi6OJrM");
\Paydunya\Setup::setPrivateKey("test_private_Lr86fcstnnw99fzsyPolvviBYfP");
\Paydunya\Setup::setToken("QUq2D7Ot9RW173IWXATM");
//To be inserted into the source code file that must perform the action

// PayDunya will automatically add the invoice token as a QUERYSTRING "token"
// if you have configured a "return_url" or "cancel_url".
// Get the pure PHP token via $_GET['token']
$token = $_GET['token'];

$invoice = new \Paydunya\Checkout\CheckoutInvoice();
if ($invoice->confirm($token)) {

  //Retrieve payment status
  // The payment status can be either completed, pending, cancelled
  echo $invoice->getStatus();

  // You can retrieve the name, email address and
  // customer's phone number using
  // the following methods
  echo $invoice->getCustomerInfo('name');
  echo $invoice->getCustomerInfo('email');
  echo $invoice->getCustomerInfo('phone');

  // The following methods will be available if and
  // only if the payment status is equal to "completed".

  // Retrieve the URL of the electronic PDF receipt for download
  echo $invoice->getReceiptUrl();

  // Recover any of the custom data that
  // you had to add to the bill previously.
  // Please make sure to use the same keys used
  // during the configuration.
  echo $invoice->getCustomData("category");
  echo $invoice->getCustomData("period");
  echo $invoice->getCustomData("numero_gagant");
  echo $invoice->getCustomData("price");

  // You can also recover the total amount specified previously
  echo $invoice->getTotalAmount();

}else{
  echo $invoice->getStatus();
  echo $invoice->response_text;
  echo $invoice->response_code;
}