# InFeed - Google AdManager

## Installation
To get started, install Infeed Google AdManager via the Composer package manager:
Add Infeed Google AdManager to your composer.json file.
```
require : {
    "kly-infeed/gam": "2.0"
}
```

Or with composer command:
```
composer require kly-infeed/gam
```

Add provider to your app/config/app.php providers
```
KLYinfeed\GAM\GamServiceProvider::class,
```

Publish config
```
php artisan vendor:publish
```

Add alias to app/config/app.php aliases
```
'GAM' => KLYinfeed\GAM\Facades\GAM::class,
```

## Configuration
Before using Infeed Google AdManager, you will also need to add credentials for the OAuth services your application utilizes. These credentials should be placed in your config/infeed_gam.php configuration file, and should use the client_id, client_secret, redirect on the providers your application requires. For example:
```
return [
    //auth
    "client_id" => CLIENT_ID,
    "client_secret" => 'CLIENT_SECRET',
    "redirect" => 'http://your-site.com/callback',    
    "access_token" => null,
    
    //cache
    "cache_enabled" => false,
    "cache_duration" => 3600, // Duration in minutes
    "cache_key_prefix" => "KLYinfeed.GAM.",
    "response_format" => "json", // json, xml
];
```

## Routing
Next, you are ready to authenticate app! You will need two routes: one for redirecting the user to the OAuth provider, and another for receiving the callback from Infeed Google AdManager after authentication. We will access Infeed Google AdManager using the GAM facade:
```
<?php namespace App\Http\Controllers;

use GAM;

class TestController 
{
    /**
     * Redirect the user to the Infeed Google AdManager authentication page.
     *
     * @return  \Illuminate\Http\Response
     */
    function auth()
    {
        return GAM::requestAccessToken([
            'get-advertisers' //scope
        ]);
    }
    
    function callback()
    {
        $callback = GAM::callback();
        
        dd($callback);
    }
}
```

The redirect method takes care of sending the user to the OAuth provider, while the user method will read the incoming request and retrieve the user's information from Infeed Google AdManager.

You will need to define routes to your controller methods:
```
Route::get('auth', 'TestController@auth');
Route::get('callback', 'TestController@callback');
```

Response Request Access Token
```
array:4 [▼
  "token_type" => "Bearer"
  "expires_in" => 1296000
  "access_token" => ""
  "refresh_token" => ""
]
```

When you get an access token, you should save it in the config/infeed_gam.php configuration file, because it avoids asking token access requests too often. By default Access token will expire in a year, but in our system will automatically refresh the token

## RESTfulness
The Infeed API follows the more standard REST convention of utilizing the HTTP response codes to identify the status of the response. These include, but are not limited to:

* 200 - SUCCESS
* 400 - INVALID
* 403 - FORBIDDEN
* 404 - NOT FOUND
* 500 - INTERNAL ERROR

GET requests will return data, POST requests are for creation, PATCH requests are for modification and DELETE requests are for removal.


## Get User
Get current user
```
GAM::me()
```

## Network
Get current network
```
GAM::get('network', null, function($result){
    dd($result);
});
```







