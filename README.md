Minutemailer API PHP Library
======================
This library allows you to quickly get started with the Minutemailer API via PHP. Libraries for other languages will come soon.

Before you get started, read the [API documentation](http://minutemailer.com/api).

Installation
------------
`$ composer require minutemailer/api`
or download the php-file [Minutemailer.php](https://github.com/minutemailer/api/blob/master/src/Minutemailer/Minutemailer.php) if you are not using composer.

Usage
-----
First you need to create an API token. You can do so by logging in to your Minutemailer account and go to the [API settings page](https://app.minutemailer.com/u/settings/api).

Make sure the file is loaded, either by `require 'vendor/autoload.php'` if you are using composer or `require 'path/Minutemailer.php'` if you are not.

```php
<?php

require 'vendor/autoload.php';

$personalAccessToken = 'myAccessToken';

$client = new Minutemailer\Minutemailer($personalAccessToken);
$response = $client->contact_lists('123abc')->subscribe([
    'name'  => 'Firstname Lastname',
    'email' => 'validemail@domain.com'
]);
```

Email is required and name is optional. `$response` will be filled with the contact data if the request is valid. Otherwise, an error will be returned.
