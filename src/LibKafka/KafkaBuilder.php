<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 14/10/2020
 * Time: 08:25
 */

namespace LibKafka;


interface KafkaBuilder
{
    public function setConfig();

    public function setTopicConfig($conf);

    public function createKafka($conf);

    public function getKafka(): Kafka;
}
