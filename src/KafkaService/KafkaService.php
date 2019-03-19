<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 18/03/2019
 * Time: 15:27
 */

namespace KafkaService;

use RdKafka\Producer;
use RdKafka\Consumer;
use RdKafka\TopicConf;

class KafkaService implements KafkaInterface
{
    private $brokers;

    private $topic;

    protected $params = [
        'logLevel' => LOG_DEBUG,
        'offset' => RD_KAFKA_OFFSET_STORED,
        'offsetStoreMethod' => 'file',
        'offsetStoragePath' => null,
        'groupId' => 'uefaDataFeedService'
    ];

    public function __construct()
    {
        if (function_exists('storage_path')) {
            $offsetStoragePath = storage_path(env('APP_LOG_PATH', 'logs/kafka-offset.log'));
            $this->params = array_merge($this->params, ['offsetStoragePath' => $offsetStoragePath]);
        }
    }

    public function configure( $topic, $brokers, $options = [])
    {
        $this->topic = $topic;
        $this->brokers = is_array($brokers) ? $brokers : [ $brokers ];
        $this->params = array_merge(
            $this->params,
            // remove unwanted keys passes as $params
            array_intersect_key($options, $this->params)
        );
    }

    public function produce($message = null, $test = false)
    {
        $producer = new Producer();
        $producer->setLogLevel($this->params['logLevel']);
        $producer->addBrokers(implode(',', $this->brokers));
        $topic = $producer->newTopic($this->topic);
        if ($test === true) {
            for ($i = 0; $i < 10; $i++) {
                $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
            }
        }
        else {
            $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
        }

    }

    public function consume()
    {
        $consumer = new Consumer();
        $consumer->setLogLevel($this->params['logLevel']);
        $consumer->addBrokers(implode(',', $this->brokers));

        $topicConf = new TopicConf();
        $topicConf->set('group.id', $this->params['groupId']); // required if "offset.store.method" : broker
        $topicConf->set("offset.store.method", $this->params['offsetStoreMethod']); // none, file, broker
        $topicConf->set("offset.store.path", $this->params['offsetStoragePath']);

        $topic = $consumer->newTopic($this->topic, $topicConf);
        $topic->consumeStart(0, $this->params['offset']);

        $payload = [];
        while (true) {
            $msg = $topic->consume(0, 1000);
            if ($msg->err) {
                echo $msg->errstr(), "\n";
                break;
            } else {
                $payload[] = $msg->payload;
            }
        }
        return !empty($payload) ? $payload : null;
    }
}
