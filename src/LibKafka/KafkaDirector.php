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
    public function build(KafkaBuilder $builder) : Kafka
    {
        $builder->setConfig();
        $builder->setTopicConfig();
        $builder->createKafka();
        $builder->getKafka();
    }
}
