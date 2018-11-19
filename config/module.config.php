<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use MSBios\Factory\ModuleFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            Module::class => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    Entity::class =>
                        Module::class
                ]
            ],
        ],
    ],

    'hydrators' => [
        'aliases' => [
            \MSBios\Resource\Form\LayoutForm::class =>
                \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            \MSBios\Resource\Form\ModuleForm::class =>
                \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class
        ]
    ],

    'form_elements' => [
        'factories' => [
            Form\PageTypeForm::class =>
                InvokableFactory::class
        ],
        'aliases' => [
            \MSBios\Resource\Form\PageTypeForm::class =>
                Form\PageTypeForm::class
        ]
    ],

    'service_manager' => [
        'factories' => [
            Listener\SessionListener::class =>
                InvokableFactory::class,
            Session\SaveHandler\DoctrineGateway::class =>
                Factory\DoctrineGatewayFactory::class,
            Module::class =>
                ModuleFactory::class
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
