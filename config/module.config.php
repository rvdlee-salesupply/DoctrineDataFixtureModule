<?php

namespace DoctrineDataFixtureModule;

use DoctrineDataFixtureModule\Service\FixtureFactory;

return [
    'Laminas\Loader\StandardAutoloader' => [
        'namespaces' => [
            __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
        ],
    ],
    'factories' => [
        'doctrine.configuration.fixtures' => FixtureFactory::class,
    ],
];