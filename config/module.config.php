<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'hydrators' => [
        'aliases' => [
            \MSBios\Resource\Form\LayoutForm::class =>
                \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            \MSBios\Resource\Form\ModuleForm::class =>
                \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class
        ]
    ],

    'service_manager' => [
        'factories' => [
            Listener\SessionListener::class =>
                InvokableFactory::class,
            Session\SaveHandler\DoctrineGateway::class =>
                Factory\DoctrineGatewayFactory::class,
            Module::class =>
                Factory\ModuleFactory::class
        ],
    ],

    Module::class => [
        'listeners' => [
            [
                'listener' => Listener\SessionListener::class,
                'method' => 'onDispatch',
                'event' => \Zend\Mvc\MvcEvent::EVENT_DISPATCH,
                'priority' => -100500,
            ],
        ],
        'session' => [

            /**
             * Please note that before you enable the zDbSession make sure to import the schema first
             * into your database or it will cause your application to die with a fatal error.
             * For more information about this please consult the readme file.
             */
            'enabled' => false,

            /**
             * Below is the standard configuration as per Zend Session Config, consult
             * the ZF2 documentation (haha) or just post on stack overflow on the settings details.
             */
            'options' => [
                'cache_expire' => 86400,
                // 'cookie_domain' => 'mydomain.com',
                // 'name' => 'mydomain',
                'cookie_lifetime' => 1800,
                'gc_maxlifetime' => 1800,
                'cookie_path' => '/',
                'cookie_secure' => true,
                'remember_me_seconds' => 3600,
                'use_cookies' => true,
            ]
        ]
    ]
];
