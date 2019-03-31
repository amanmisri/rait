<?php

namespace Modules\Setting\Validators;

use Illuminate\Support\Facades\Redis;
use Predis\Connection\ConnectionException;

class RedisValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        if ($value !== 'redis') {
            return true;
        }

        $this->setRedisConfig();

        try {
            Redis::ping();

            return true;
        } catch (ConnectionException $e) {
            return false;
        }
    }

    private function setRedisConfig()
    {
        config()->set('database.redis.default.host', request('redis_host'));
        config()->set('database.redis.default.password', request('redis_password'));
        config()->set('database.redis.default.port', request('redis_port'));
    }
}
