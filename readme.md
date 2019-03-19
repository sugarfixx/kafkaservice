# KafkaService

Requiers librdkafka extension installed se https://github.com/arnaud-lb/php-rdkafka


### Installation


Add this to composer.json
````{
    "require": {
        "sugarfixx/kafkaservice":"0.1"
    },
    "repositories": [
      {
        "type": "vcs",
        "url": "git@github.com:sugarfixx/kafkaservice.git"
      }
    ]   
}
````

Run
```angular2html
composer install
```

### Simple usage

Include the autoload to your php file
```php
require "vendor/autoload.php";
```
#### Usage example
```php
use KafkaService\KafkaService;

// set the topic
$topic = '<myTopic>';

// set up brokers 
$brokers = ['<broker1>', '<broker2>']; // string or array

// $options will overwrite default values in the $params array
// if offsetStoreMethod is set to file, offestStoragePath must be set to an appropriate location 

$options = [
    'logLevel' => LOG_DEBUG,
    'offset' => RD_KAFKA_OFFSET_STORED, // RD_KAFKA_OFFSET_BEGINNING, KAFKA_OFFSET_END 
    'offsetStoreMethod' => 'file', // file, broker, none
    'offsetStoragePath' => $storedOffset, 
    'groupId' => '<yourGgroupId>' 
];

$ks = new KafkaService();

$ks->configure($topic, $brokers, $options);

// to consume
$consume = $ks->consume();

// to produce
$ks->produce('<your message>');

```

#### Test produce
To test the producer you can simply pass null as message and at true as a second param to enable a predefined loop creating 10 messages on the broker. 
```php
$ks->produce(null, true);

echo $ks->consume();
```

### Use with Lumen
Add service provider to app.php
```php
// bootstrap/app.php
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/
$app->register(KafkaService\KafkaServiceProvider);
```

To use the service just Inject it in controller
```php
use KafkaService\KafkaInterface;

class MyController extends Controller {

    private $brokers;
    
    private $topic;
    
    $private $options;
    
    public function __construct(KafkaInteface $kafkaInterface)
    {
        $this->kafkaInterface = $kafkaInterface;
    }
    
    public funciton consumeKafka()
    {
        $ks = $this->kafkaInterface->confugure($this->topic, $this->brokers, $this->options);
        return $ks->consume();
    }
}
```
