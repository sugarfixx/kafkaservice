<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 14/10/2020
 * Time: 08:31
 */

namespace LibKafka;


class KafkaDirector
{
    private $data;

    public function __construct($config)
    {
        $this->data = $config;
    }

    public function build(KafkaBuilder $builder) : Kafka
    {
        $builder->setConfig();
        $builder->setTopicConfig($this->data);
        $builder->createKafka($this->data);
        $builder->getKafka();
    }
}
