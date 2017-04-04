Global Phone Number Validation and Information Lookup using Numverify API
=========================================================================
A Yii2 extension to use the NumVerify API, which offers a full-featured yet simple RESTful JSON API for national and international phone number validation and information lookup for a total of 232 countries around the world

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist giddyeffects/yii2-numverify "*"
```

or add

```
"giddyeffects/yii2-numverify": "*"
```

to the require section of your `composer.json` file.


Usage
-----

First get an Numverify API key [here](https://numverify.com/product).

Once the extension is installed, simply add the following code in your application configuration:

```php
return [
    //....
    'components' => [
        //...
        'numverify' => [
            'class' => 'giddyeffects\numverify\Numverify',
            'access_key' => 'YOUR_NUMVERIFY_API_KEY',
        ],
    ],
];
```
You can now access the extension via ```\Yii::$app->numverify;```

For more details refer to the [Numverify Documentation](https://numverify.com/documentation).

Example
-------
```
$response = \Yii::$app->numverify->verify(4158586273, ['country_code'=>'us']);
//check if there's an error
if ($response->error){
    echo $response->error->info;
}
else{
    if($response->valid){
        echo "Number '$response->number' is valid.";
        echo "<br>";
        echo "local_format:$response->local_format";
        echo "<br>";
        echo "international_format:$response->international_format";
        echo "<br>";
        echo "country_prefix:$response->country_prefix";
        echo "<br>";
        echo "country_code:$response->country_code";
        echo "<br>";
        echo "country_name:$response->country_name";
        echo "<br>";
        echo "location:$response->location";
        echo "<br>";
        echo "carrier:$response->carrier";
        echo "<br>";
        echo "line_type:$response->line_type";
        echo "<br>";
    }
    else{
        echo "Number given is not valid.";
    }
}
```