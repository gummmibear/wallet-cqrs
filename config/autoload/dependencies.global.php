<?php
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
            \Broadway\Serializer\SimpleInterfaceSerializer::class => \Broadway\Serializer\SimpleInterfaceSerializer::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            Doctrine\DBAL\Connection::class => App\Service\DBConnectionFactory::class,
            \MongoDB\Client::class => \App\Service\MongoConnectionFactory::class,
            \Domain\Wallet\ReadModel\WalletRepository::class => \App\Service\ReadModel\WalletRepositoryFactory::class,
            \Domain\Wallet\ReadModel\TransactionRepository::class => \App\Service\ReadModel\TransactionRepositoryFactory::class,
            \Domain\Wallet\Listeners\WalletListener::class => \App\Service\ReadModel\WalletListenerFactory::class,
            \Domain\Wallet\Listeners\TransactionListener::class => \App\Service\ReadModel\TransactionListenerFactory::class,
            \Broadway\EventHandling\SimpleEventBus::class => \App\Service\SimpleEventBusFactory::class,
            'WalletEventStore' => \App\Service\EventStore\WalletEventStoreFactory::class,
            'TransactionEventStore' => \App\Service\EventStore\TransactionEventStoreFactory::class,
            \Domain\Wallet\EventSourcing\WalletRepository::class => \App\Service\EventStore\WalletRepositoryFactory::class,
            \Domain\Wallet\EventSourcing\TransactionRepository::class => \App\Service\EventStore\TransactionRepositoryFactory::class,
            \Domain\Wallet\Commands\MoneyCommandHandler::class => \App\Service\Command\MoneyCommandHandlerFactory::class,
            \Domain\Wallet\Commands\TransactionCommandHandler::class => \App\Service\Command\TransactionCommandHandlerFactory::class,
            \Broadway\CommandHandling\SimpleCommandBus::class => \App\Service\SimpleCommandBusFactory::class,
            ///
            \App\DataProvider\TransactionDataProvider::class => \App\DataProvider\TransactionDataProviderFactory::class,
            \App\DataProvider\WalletDataProvider::class => \App\DataProvider\WalletDataProviderFactory::class
        ],
    ],
];
