<?php 
ini_set('display_errors',1);

require('vendor/autoload.php');
\Paydunya\Setup::setMasterKey("w45AVPgF-JqMA-W45K-gGJm-XorU2n7bh8rU");
\Paydunya\Setup::setPublicKey("test_public_B2yRErL9pE3tJUHO2dikzi6OJrM");
\Paydunya\Setup::setPrivateKey("test_private_Lr86fcstnnw99fzsyPolvviBYfP");
\Paydunya\Setup::setToken("QUq2D7Ot9RW173IWXATM");
//A insérer dans le fichier du code source qui doit effectuer l'action

// PayDunya rajoutera automatiquement le token de la facture sous forme de QUERYSTRING "token"
// si vous avez configuré un "return_url" ou "cancel_url".
// Récupérez donc le token en pur PHP via $_GET['token']
$token = $_GET['token'];



//  $url = "https://paydunya.com/sandbox-checkout/receipt/".$token;


// echo "<a href=$url target='_blank'>download invoice</a>";






$invoice = new \Paydunya\Checkout\CheckoutInvoice();
  

if ($invoice->confirm($token)) {

  // Récupérer le statut du paiement
  // Le statut du paiement peut être soit completed, pending, cancelled
  echo $invoice->getStatus();

  // Vous pouvez récupérer le nom, l'adresse email et le
  // numéro de téléphone du client en utilisant
  // les méthodes suivantes
  echo $invoice->getCustomerInfo('name');
  echo $invoice->getCustomerInfo('email');
  echo $invoice->getCustomerInfo('phone');

  // Les méthodes qui suivent seront disponibles si et
  // seulement si le statut du paiement est égal à "completed".

  // Récupérer l'URL du reçu PDF électronique pour téléchargement
  echo $invoice->getReceiptUrl();

  // Récupérer n'importe laquelle des données personnalisées que
  // vous avez eu à rajouter précédemment à la facture.
  // Merci de vous assurer à utiliser les mêmes clés que celles utilisées
  // lors de la configuration.
  echo $invoice->getCustomData("category");
  echo $invoice->getCustomData("period");
  echo $invoice->getCustomData("numero_gagnant");
  echo $invoice->getCustomData("price");

  // Vous pouvez aussi récupérer le montant total spécifié précédemment
  echo $invoice->getTotalAmount();

}else{
  echo $invoice->getStatus();
  echo $invoice->response_text;
  echo $invoice->response_code;
}
?>
