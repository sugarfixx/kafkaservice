<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 12/10/2020
 * Time: 14:10
 */

namespace KafkaService;


class KafkaConsumerBuilder implements KafkaBuilderInterface
{

    private $kafka;

    public function __construct(Kafka $kafka)
    {
        $this->kafka = $kafka;
    }

    public function setBrokers()
    {
        // TODO: Implement setBrokers() method.
    }

    public function setConfig($conf)
    {
        // TODO: Implement setConfig() method.
    }

    public function setTopicConf($conf)
    {
        // TODO: Implement setTopicConf() method.
    }

    public function getKafka()
    {
        // TODO: Implement getKafka() method.
    }

}
