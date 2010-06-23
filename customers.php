<html>
  <head>
    <title>Customers</title>
  </head>
  <body>
  <pre>

<?php

// Require the Chargify.php file.
require_once('Chargify-PHP-Client/lib/Chargify.php');

// Create a ChargifyProduct object in test mode.
$test = TRUE;
$customer = new ChargifyCustomer(NULL, $test);


/**
 * Create a customer
 */
$new_customer = new ChargifyCustomer(NULL, $test);
$new_customer->first_name = 'Joe';
$new_customer->last_name = 'Smith';
$new_customer->email = 'joe.smith@example.com';
$saved_customer = $new_customer->create();
echo '<h2>Just created a single customer</h2>';
print_r($saved_customer);


/**
 * Get 50 customers at a time.
 */
$customer = new ChargifyCustomer(NULL, $test);
$customers = $customer->getAllCustomers();
echo '<h2>Array of 50 customer objects</h2>';
print_r($customers);


/**
 * Get the a customer by ID. Using the first id from getAllCustomers() example.
 */
$customer = new ChargifyCustomer(NULL, $test);
$customer->id = $customers[0]->id;
$customer_x = $customer->getByID();
echo '<h2>Single customer object by ID</h2>';
print_r($customer_x);


/**
 * Update a single customer record.
 */
$customer = new ChargifyCustomer(NULL, $test);
$customer->id = $customers[0]->id;
$customer_x->first_name = 'Jane';
$new_customer->last_name = 'Smith';
$customer_x->email = 'jane.smith@example.com';
$customer_x = $customer_x->update();
echo '<h2>Update single customer object</h2>';
print_r($customer_x);


/**
 * Deletes the customer record paired with the ID.
 */
/* Deleting customers through the API is not yet supported.
$customer = new ChargifyCustomer(NULL, $test);
$customer->id = $customers[0]->id;
$customer->delete();
*/

?>
  </body>
</html>