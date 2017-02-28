<?php

chdir(dirname(__DIR__));
require '../vendor/autoload.php';

const USER_ID = 22;
const TRANSACTION_ID = '58b34682aba23';
const PRECISION = 100;

$params = [
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'wallet_events'
];

$serializer = new \Broadway\Serializer\SimpleInterfaceSerializer();
$metaDataSerializer = new \Broadway\Serializer\SimpleInterfaceSerializer();

$mongoClient = new MongoDB\Client("mongodb://127.0.0.1:27017");
$dbCollection = $mongoClient->wallet->userWallet;
$transactionCollection = $mongoClient->wallet->userTransaciton;

$transactionRepositoryRead = new \Domain\Wallet\ReadModel\TransactionRepository($transactionCollection);
$transactionListener = new \Domain\Wallet\Listeners\TransactionListener($transactionRepositoryRead);

$walletRepositoryRead = new \Domain\Wallet\ReadModel\WalletRepository($dbCollection);
$walletListener = new \Domain\Wallet\Listeners\WalletListener($walletRepositoryRead);

$eventBus = new \Broadway\EventHandling\SimpleEventBus();
$eventBus->subscribe($walletListener);
$eventBus->subscribe($transactionListener);

$conn = Doctrine\DBAL\DriverManager::getConnection($params);

$walletEventStore = new \Broadway\EventStore\DBALEventStore($conn, $serializer, $metaDataSerializer, 'wallet_events');
$transactionEventStore = new \Broadway\EventStore\DBALEventStore($conn, $serializer, $metaDataSerializer, 'transaction_events');
//$schema = $walletEventStore->configureTable();
//$schemaTrans = $transactionEventStore->configureTable();

$walletRepository = new Domain\Wallet\EventSourcing\WalletRepository($walletEventStore, $eventBus);
$transactionRepository = new \Domain\Wallet\EventSourcing\TransactionRepository($transactionEventStore, $eventBus);

$commendHandler = new \Domain\Wallet\Commands\MoneyCommandHandler($walletRepository, $transactionRepository);
$transactionCommandHandler = new \Domain\Wallet\Commands\TransactionCommandHandler($walletRepository, $transactionRepository);

$commandBus = new \Broadway\CommandHandling\SimpleCommandBus();

$commandBus->subscribe($commendHandler);
$commandBus->subscribe($transactionCommandHandler);
$command = new \Domain\Wallet\Commands\AddMoneyCommand(uniqid(), USER_ID, $argv[1] * PRECISION, 'title++ ' . $argv[1]);
//$command = new \Domain\Wallet\Commands\SubMoneyCommand(uniqid(), USER_ID, 7.2 * PRECISION, 'title--');
//$command = new \Domain\Wallet\Commands\TransactionTitleChangeCommand(TRANSACTION_ID, USER_ID, 'newTitle =12');
//$command = new \Domain\Wallet\Commands\TransactionAmountChangeCommand(TRANSACTION_ID, USER_ID, $argv[1] * PRECISION);
//$commandBus->dispatch($command);
$commandBus->dispatch($command);

