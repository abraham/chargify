Chargify example application
============================

Hello, my name is Abraham and I'm here to tell you a story. Well maybe not a
story but once you are rolling in bling maybe you will tell a story about me.

Once you have read gone through this example application you should be able to
integrate a PHP application with the Chargify API like a dream.


License
=======

This example application is open sourced under the MIT license.


Support
=======

If you have improvements or find bugs with this example application please open
an issue on Github. For problems with Chargify please use their support site.

Example issue tracker: <http://github.com/abraham/chargify/issues/>

Chargify support: <http://support.chargify.com/>


Chargify-PHP-Client
===================

In this example application I'm using an open source PHP library that can be
found on GitHub. I could write my own classes to directly interact with Chargify
but they would likely have errors as well as take longer to learn for new
developers. If the PHP library does not work how you want; fork it, hack it, and
contribute back to the community.

The Chargify PHP Client has a test mode which we will be using for this entire 
example application. 

Source code: <http://github.com/jforrest/Chargify-PHP-Client/>


Getting started
===============


Installation
------------

Download the Chargify PHP Client code either as an archive or with Git.

    git clone http://github.com/jforrest/Chargify-PHP-Client.git 

Edit lib/ChargifyConnector.php and save your API key and domain. It is 
recommended to always use a Chargify set to test mode when starting out.

Anytime you wish to interact with Chargify require the Chargify.php file.

    require_once('Chargify-PHP-Client/lib/Chargify.php');


Products
--------

Products in Chargify are the things to which you are giving access through 
Subscriptions.

The Products API currently only allows listing and lookup operations.

Example code is in `products.php`.

Product API docs: <http://support.chargify.com/faqs/api/api-products/>


#### Get all products

    $test = TRUE;
    $products = new ChargifyProduct(NULL, $test);
    $all_products = $products->getAllProducts();
    
`$all_products` will contain details of all your products and their settings.

`products.php` has examples for getting product objects by ID and handle.


Customers
---------

Customers in Chargify are the people or entities which are gaining access to 
your Products through Subscriptions. Customers may correlate to the Users in 
your application.

Example code is in `customers.php`.

Customer API docs: <http://support.chargify.com/faqs/api/api-customers/>


#### Create a customer

    $test = TRUE;
    $customer = new ChargifyCustomer(NULL, $test);
    $customer = new ChargifyCustomer(NULL, $test);
    $customer->first_name = 'Joe';
    $customer->last_name = 'Smith';
    $customer->email = 'joe.smith@example.com';
    $new_customer = $customer->create();

`$new_customer` will contain details of the new customer record.


#### List customers

    $test = TRUE;
    $customer = new ChargifyCustomer(NULL, $test);
    $customers = $customer->getAllCustomers();

`$customers` will contain an array of up to 50 customers. You can page through
the results by passing a page number to `getAllCustomers(3)`


#### Get customers by ID

    $test = TRUE;
    $customer = new ChargifyCustomer(NULL, $test);
    $customer->id = $customers[0]->id;
    $customer_x = $customer->getByID();

`$customer_x` will contain a single customer object for the specified ID.


#### Update customer

    $test = TRUE;
    $customer = new ChargifyCustomer(NULL, $test);
    $customer->id = $id;
    $customer_x->first_name = 'Jane';
    $new_customer->last_name = 'Smith';
    $customer_x->email = 'jane.smith@example.com';
    $customer_x = $customer_x->update();

`$customer_x` gets updated with the new customer record information.


#### Delete customer

    $test = TRUE;
    $customer = new ChargifyCustomer(NULL, $test);
    $customer->id = $id;
    $deleted_customer = $customer->delete();

Deletes the the customer with the matching `$id`. Not yet supported by the API.

Subscriptions
-------------

Subscriptions in Chargify give access to a particular Product for a particular
Customer. They are usually recurring in nature, and all of the complexities of
renewal, dunning, and expiration management are handled by Chargify.

Example code is in `subscriptions.php`.

Customer API docs: <http://support.chargify.com/faqs/api/api-subscriptions/>


#### Create a subscription

    $test = TRUE;
    $customer = new ChargifyCustomer(NULL, $test);
    $customer = new ChargifyCustomer(NULL, $test);
    $customer->first_name = 'Joe';
    $customer->last_name = 'Smith';
    $customer->email = 'joe.smith@example.com';
    $new_customer = $customer->create();

`$new_customer` will contain details of the new customer record.

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

`$card` will contain details of the customers credit card.

    $product = new ChargifyProduct(NULL, $test);
    $products = $product->getAllProducts();
    
`$products` will include a list of products. The first will be used in the
subscription. You can skip this if you know the product handle.

    $subscription = new ChargifySubscription(NULL, $test);
    $subscription->customer_attributes = $customer;
    $subscription->credit_card_attributes = $card;
    // Uses the first exising product. Replace with a product handle string.
    $subscription->product_handle = $products[0]->handle;
    
    try {
      $new_subscription = $subscription->create();
      print_r($new_subscription);
    } catch (ChargifyValidationException $cve) {
      // Error handling code.
      echo $cve->getMessage();
    }

Create a new subscription or log/notify user of an issue.


#### Read a subscription

    $subscription = new ChargifySubscription(NULL, $test);
    
    try {
      $subscription = $subscription->getByID($new_subscription->id);
      print_r($subscription);
    } catch (ChargifyValidationException $cve) {
      // Error handling code.
      echo $cve->getMessage();
    }

`$subscriptoin` will contain details of the subscription matching the id.


#### Cancel a subscription

    $subscription = new ChargifySubscription(NULL, $test);
    
    try {
      $subscription = $subscription->getByID($new_subscription->id);
      print_r($subscription);
    } catch (ChargifyValidationException $cve) {
      // Error handling code.
      echo $cve->getMessage();
    }

`$subscriptoin` will contain details of the subscription matching the id.


Finish
======

There you have it. A quick into to using Chargify with PHP.

Be sure to report an issues with this example to the issue tracker.

<http://github.com/abraham/chargify/issues/>