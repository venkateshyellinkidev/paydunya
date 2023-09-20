<?php 
ini_set('display_errors',1);
require('vendor/autoload.php');

\Paydunya\Setup::setMasterKey("w45AVPgF-JqMA-W45K-gGJm-XorU2n7bh8rU");
\Paydunya\Setup::setPublicKey("test_public_B2yRErL9pE3tJUHO2dikzi6OJrM");
\Paydunya\Setup::setPrivateKey("test_private_Lr86fcstnnw99fzsyPolvviBYfP");
\Paydunya\Setup::setToken("QUq2D7Ot9RW173IWXATM");
\Paydunya\Setup::setMode("test"); // Optionnel en mode test. Utilisez cette option pour les paiements tests.


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
$invoice->addItem("Chaussures Croco", 3, 10000, 30000, "Chaussures faites en peau de crocrodile authentique qui chasse la pauvreté");
$invoice->addItem("Chemise Glacée", 1, 5000, 5000);

$invoice->setDescription("Optional Description");
$invoice->setTotalAmount(200);

if($invoice->create()) {
    header("Location: ".$invoice->getInvoiceUrl());
}else{
    echo $invoice->response_text;
}

?>