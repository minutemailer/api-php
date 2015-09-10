Minutemailer API BETA
======================
These instructions are specifically for PHP. We'll add more general instructions soon in order to use the Minutemailer API.

Any questions or comments? Maybe you’re interested in trying out the Minutemailer API? Contact us at <hello@minutemailer.com> and we'll get back to you.

Installation
------------
`$ composer require minutemailer/api`
or download the php-file [Minutemailer.php](https://github.com/minutemailer/api/blob/master/src/Minutemailer/Minutemailer.php) if you are not using composer.

Usage
-----
Make sure the file is loaded, either by `require 'vendor/autoload.php'` if you are using composer or `require 'path/Minutemailer.php'` if you are not.

```php
<?php
require 'vendor/autoload.php';

$clientId = 'ThisIsMyId';
$clientSecret = '123456789asdf';
$client = new Minutemailer\Minutemailer($clientId, $clientSecret);

// Data required
$contactListToken = 'asdf123';
$postData = [
  'name'  => 'Firstname Lastname',
  'email' => 'validemail@domain.com'
];

$response = $client->subscribe($contactListToken)->post($postData);
```

Please note that both name and email are required. `$response` will be filled with the contact data if the request is valid. Otherwise, an error will be returned.
