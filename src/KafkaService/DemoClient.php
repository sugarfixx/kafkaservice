<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 13/10/2020
 * Time: 11:05
 */

namespace KafkaService;


class DemoClient
{
    private function runConsumer()
    {


    }

    public function buildConsumer($config)
    {
        $consumer = new Consumer($this->consumerConfig());
        $consumer->addBrokers(implode(',', $this->brokers));
        $topicConf = $this->topicConfig();
        $queue = $consumer->newQueue();
        $topic = $consumer->newTopic($this->topic, $topicConf);
        $topic->consumeQueueStart(0, $this->params['offset'], $queue);
        if ($this->topic != env('KAFKA_TRACKING_DATA_TOPIC')) {
            $topic->consumeQueueStart(1, $this->params['offset'], $queue);
            $topic->consumeQueueStart(2, $this->params['offset'], $queue);
        }
        return $queue;
    }

    public function consumerConfig()
    {
        return true;
    }

    public function topicConfig()
    {
        return true;

    }

}
