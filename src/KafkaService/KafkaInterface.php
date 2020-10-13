<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 18/03/2019
 * Time: 15:28
 */

namespace KafkaService;


interface KafkaInterface
{

    public function configure( $topic, $brokers);

    public function produce();

    public function consume();
}
