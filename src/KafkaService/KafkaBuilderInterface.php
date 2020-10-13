<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 12/10/2020
 * Time: 14:09
 */

namespace KafkaService;


interface KafkaBuilderInterface
{
    public function setBrokers();

    public function setConfig();

    public function setTopicConf();

    public function getKafka();
}
