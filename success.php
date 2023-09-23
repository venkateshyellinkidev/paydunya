<?php 
ini_set('display_errors',1);

require('vendor/autoload.php');

$PATH = __DIR__.'/';
$dotenv = Dotenv\Dotenv::createImmutable($PATH); // Replace __DIR__ with the path to your .env file if it's located elsewhere

$dotenv->load();

$MASTERKEY = $_ENV['MASTERKEY'];

$TEST_PUBLICKEY = $_ENV['TEST_PUBLICKEY'];
$TEST_PRIVATEKEY = $_ENV['TEST_PRIVATEKEY'];
$TEST_TOKEN = $_ENV['TEST_TOKEN'];

$LIVE_PUBLICKEY = $_ENV['LIVE_PUBLICKEY'];
$LIVE_PRIVATEKEY = $_ENV['LIVE_PRIVATEKEY'];
$LIVE_TOKEN = $_ENV['LIVE_TOKEN'];

\Paydunya\Setup::setMasterKey($MASTERKEY);
\Paydunya\Setup::setPublicKey($TEST_PUBLICKEY);
\Paydunya\Setup::setPrivateKey($TEST_PRIVATEKEY);
\Paydunya\Setup::setToken($TEST_TOKEN);
\Paydunya\Setup::setMode("test"); // Optionnel en mode test. Utilisez cette option pour les paiements tests.

//A insérer dans le fichier du code source qui doit effectuer l'action

// PayDunya rajoutera automatiquement le token de la facture sous forme de QUERYSTRING "token"
// si vous avez configuré un "return_url" ou "cancel_url".
// Récupérez donc le token en pur PHP via $_GET['token']



// print_r($status);exit;
$token = $_GET['token'];



$invoice = new \Paydunya\Checkout\CheckoutInvoice();
  

if ($invoice->confirm($token)) {

  // print_r($invoice);


  // Récupérer le statut du paiement
  // Le statut du paiement peut être soit completed, pending, cancelled
  echo $invoice->getStatus(); echo "<br>";

  // Vous pouvez récupérer le nom, l'adresse email et le
  // numéro de téléphone du client en utilisant
  // les méthodes suivantes
  echo $invoice->getCustomerInfo('name');  echo "<br>";
  echo $invoice->getCustomerInfo('email'); echo "<br>";
  echo $invoice->getCustomerInfo('phone'); echo "<br>";

  // Les méthodes qui suivent seront disponibles si et
  // seulement si le statut du paiement est égal à "completed".

  // Récupérer l'URL du reçu PDF électronique pour téléchargement
  echo $invoice->getReceiptUrl(); echo "<br>";

  // Récupérer n'importe laquelle des données personnalisées que
  // vous avez eu à rajouter précédemment à la facture.
  // Merci de vous assurer à utiliser les mêmes clés que celles utilisées
  // lors de la configuration.
  // echo $invoice->getCustomData("category");
  // echo $invoice->getCustomData("period");
  // echo $invoice->getCustomData("numero_gagnant");
  // echo $invoice->getCustomData("price");

  // Vous pouvez aussi récupérer le montant total spécifié précédemment
  echo $invoice->getTotalAmount(); echo "</br>";


//  $url = "https://paydunya.com/sandbox-checkout/receipt/".$token;
// echo "<a href=$url target='_blank'>download invoice</a>";


}else{
  echo $invoice->getStatus();
  echo $invoice->response_text;
  echo $invoice->response_code;
}
?>
