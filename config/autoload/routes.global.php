<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\ZendRouter::class,
        ],
        'factories' => [
            App\Action\AddTransactionAction::class => App\Action\AddTransactionActionFactory::class,
            \App\Action\ChangeTransactionAction::class => \App\Action\ChangeTransactionActionFactory::class,
            \App\Action\TransactionListAction::class => \App\Action\TransactionListActionFactory::class,
            \App\Action\IndexAction::class => \App\Action\IndexActionFactory::class,
            \App\Action\WalletAction::class => \App\Action\WalletActionFactory::class,
            \App\Action\TransactionStatsAction::class => \App\Action\TransactionStatsActionFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'index',
            'path' => '/',
            'middleware' => \App\Action\IndexAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'transaction.add',
            'path' => '/user/:userId/transaction',
            'middleware' => App\Action\AddTransactionAction::class,
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'transaction.edit',
            'path' => '/transaction/:transactionId',
            'middleware' => App\Action\ChangeTransactionAction::class,
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'user.wallet',
            'path' => '/user/:userId/wallet',
            'middleware' => \App\Action\WalletAction::class,
            'allowed_methods' => ['GET']
        ],
        [
            'name' => 'transaction.list',
            'path' => '/user/transaction/list',
            'middleware' => App\Action\TransactionListAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'transaction.stats',
            'path' => '/user/:userId/transaction/stats',
            'middleware' => App\Action\TransactionStatsAction::class,
            'allowed_methods' => ['GET'],
        ]
    ],
];
