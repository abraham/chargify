<html>
  <head>
    <title>Products</title>
  </head>
  <body>
  <pre>

<?php

// Require the Chargify.php file.
require_once('Chargify-PHP-Client/lib/Chargify.php');


/**
 * Create a ChargifyProduct object in test mode.
 */
$test = TRUE;
$product = new ChargifyProduct(NULL, $test);


/**
 * Get details about all products available through your Chargify site.
 */
$products = $product->getAllProducts();
echo '<h2>Array of all product objects</h2>';
print_r($products);


/**
 * Get the first product based by ID. Will fail if there are no products.
 */
$product_x = new ChargifyProduct(NULL, $test);
$product_x->id = $products[0]->id;
echo '<h2>Single product object by ID</h2>';
print_r($product_x->getByID());


/**
 * Get the first product based by handle. Will fail if there are no products.
 */
$product_y = new ChargifyProduct(NULL, $test);
$product_y->handle = $products[0]->handle;
echo '<h2>Single product object by handle</h2>';
print_r($product_y->getByHandle());

?>
  </body>
</html>