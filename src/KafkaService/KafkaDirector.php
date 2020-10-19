<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 12/10/2020
 * Time: 14:10
 */

namespace KafkaService;


class KafkaDirector
{
    private $data;

    public function __construct($conf)
    {
        $this->data = $conf;
    }

    public function build(KafkaBuilderInterface $builder)
    {
        $builder->setBrokers();
        $builder->setConfig($this->data);
        $builder->setTopicConf($this->data);
        return $builder->getKafka();
    }
}
