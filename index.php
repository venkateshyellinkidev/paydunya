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



// production keys


// \Paydunya\Setup::setMasterKey($MASTERKEY);
// \Paydunya\Setup::setPublicKey($LIVE_PUBLICKEY);
// \Paydunya\Setup::setPrivateKey($LIVE_PRIVATEKEY);
// \Paydunya\Setup::setToken($LIVE_TOKEN);
// \Paydunya\Setup::setMode("live"); // Optional. Use this option for test payments.



//Configuration des informations de votre service/entreprise
\Paydunya\Checkout\Store::setName("Magasin Chez Sandra"); // Seul le nom est requis
\Paydunya\Checkout\Store::setTagline("L'élégance n'a pas de prix");
\Paydunya\Checkout\Store::setPhoneNumber("336530583");
\Paydunya\Checkout\Store::setPostalAddress("Dakar Plateau - Etablissement kheweul");
\Paydunya\Checkout\Store::setWebsiteUrl("http://localhost/test_paydunya");
\Paydunya\Checkout\Store::setLogoUrl("http://www.chez-sandra.sn/logo.png");

\Paydunya\Checkout\Store::setCallbackUrl("http://localhost/test_paydunya/success.php");
\Paydunya\Checkout\Store::setCancelUrl("http://localhost/test_paydunya/failure.php");

\Paydunya\Checkout\Store::setReturnUrl("http://localhost/test_paydunya/success.php");

$invoice = new \Paydunya\Checkout\CheckoutInvoice();
$invoice->addItem("Chaussures Croco", 1, 300, 300, "Chaussures faites en peau de crocrodile authentique qui chasse la pauvreté");
// $invoice->addItem("Chemise Glacée", 1, 5000, 5000);

$invoice->setDescription("Optional Description");
$invoice->setTotalAmount(300);
// $invoice->addChannel('card'); // select single payment 

// $invoice->addChannels(['card', 'orange-money-senegal']); // select multiple payment methods
// $direct_pay = new Paydunya_DirectPay();


if($invoice->create()) {

    // print_r($invoice->create());exit;
    header("Location: ".$invoice->getInvoiceUrl());
}else{
    echo $invoice->response_text;
}




?>