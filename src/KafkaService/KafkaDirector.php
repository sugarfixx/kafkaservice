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
    public function build(KafkaBuilderInterface $builder)
    {
        $builder->setBrokers();
        $builder->setConfig();
        $builder->setTopicConf();
        return $builder->getKafka();
    }
}
