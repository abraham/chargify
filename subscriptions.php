<html>
  <head>
    <title>Subscriptions</title>
  </head>
  <body>
  <pre>

<?php

// Require the Chargify.php file.
require_once('Chargify-PHP-Client/lib/Chargify.php');

$test = TRUE;


/**
 * Create a new subscription.
 */
// Create a ChargifyProduct object in test mode.
$customer = new ChargifyCustomer(NULL, $test);
$customer->email = "jane@smith.com";
$customer->first_name = "Jane";
$customer->last_name = "Smith";

$card = new ChargifyCreditCard(NULL, $test);
$card->first_name = "Jane";
$card->last_name = "Smith";
// 1 is used in test mode for a vald credit card.
$card->full_number = '1';
$card->cvv = '123';
$card->expiration_month = "02";
$card->expiration_year = "2011";
$card->billing_address = "123 any st";
$card->billing_city = "Anytown";
$card->billing_state = "CA";
$card->billing_zip = "55555";
$card->billing_country = 'US';

$product = new ChargifyProduct(NULL, $test);
$products = $product->getAllProducts();

$subscription = new ChargifySubscription(NULL, $test);
$subscription->customer_attributes = $customer;
$subscription->credit_card_attributes = $card;
// Uses the first exising product. Replace with a product handle string.
$subscription->product_handle = $products[0]->handle;

echo '<h2>Just created a new subscription</h2>';
try {
  $new_subscription = $subscription->create();
  print_r($new_subscription);
} catch (ChargifyValidationException $cve) {
  // Error handling code.
  echo $cve->getMessage();
}


/**
 * Read a subscription.
 */
// Create a ChargifyProduct object in test mode.
$subscription = new ChargifySubscription(NULL, $test);

echo '<h2>Showing the newly created subscription</h2>';
try {
  $subscription = $subscription->getByID($new_subscription->id);
  print_r($subscription);
} catch (ChargifyValidationException $cve) {
  // Error handling code.
  echo $cve->getMessage();
}


/**
 * Delete subscription.
 */
// Create a ChargifyProduct object in test mode.
$customer = new ChargifyCustomer(NULL, $test);
$customer->email = "jane@smith.com";
$customer->first_name = "Jane";
$customer->last_name = "Smith";

// Create a card to go with the customer.
$card = new ChargifyCreditCard(NULL, $test);
$card->first_name = "Jane";
$card->last_name = "Smith";
// 1 is used in test mode for a vald credit card.
$card->full_number = '1';
$card->cvv = '123';
$card->expiration_month = "02";
$card->expiration_year = "2011";
$card->billing_address = "123 any st";
$card->billing_city = "Anytown";
$card->billing_state = "CA";
$card->billing_zip = "55555";
$card->billing_country = 'US';

// Get a list of products. The first one will be used.
$product = new ChargifyProduct(NULL, $test);
$products = $product->getAllProducts();

// Build subscription.
$subscription = new ChargifySubscription(NULL, $test);
$subscription->customer_attributes = $customer;
$subscription->credit_card_attributes = $card;
// Uses the first exising product. Replace with a product handle string.
$subscription->product_handle = $products[0]->handle;

echo '<h2>Deleting a new subscription</h2>';
try {
  // Save a new subscription.
  $new_subscription = $subscription->create();
  try {
    // Delete the newly saved subscription with a message.
    $deleted_subscription = $new_subscription->cancel('Subscription canceled');
    var_dump($deleted_subscription);
  } catch (ChargifyValidationException $cve) {
    // Error handling code.
    echo $cve->getMessage();
  }
} catch (ChargifyValidationException $cve) {
  // Error handling code.
  echo $cve->getMessage();
}

?>
  </body>
</html>