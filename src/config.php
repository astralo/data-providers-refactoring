<?php

if (!create_function('config')) {
    function config(): array
    {
        return [
            'production' => false,

            'user' => 'root',
            'password' => 'secret',
            'host' => '127.0.0.1',

            'defaultResponseFormat' => 'json',
            'allowedResponseFormates' => [
                'json' => \App\Responses\Formatters\JsonResponseFormatter::class,
                'xml' => \App\Responses\Formatters\XmlResponseFormatter::class,
            ]
        ];
    }
}
