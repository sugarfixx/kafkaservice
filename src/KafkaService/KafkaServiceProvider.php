<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 18/03/2019
 * Time: 15:28
 */

namespace KafkaService;

use KafkaService\KafkaInterface;
use KafkaService\KafkaService;
use Illuminate\Support\ServiceProvider;

class KafkaServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KafkaInterface::class, function() {
            return $this->app->make(KafkaService::class);
        });
    }
}
