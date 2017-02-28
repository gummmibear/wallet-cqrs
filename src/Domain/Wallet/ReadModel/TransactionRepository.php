<?php

namespace Domain\Wallet\ReadModel;


use Broadway\ReadModel\RepositoryInterface;
use Broadway\ReadModel\ReadModelInterface;
use MongoDB\Collection;
use MongoDB\Driver\Exception\BulkWriteException;

class TransactionRepository implements RepositoryInterface
{
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function save(ReadModelInterface $data)
    {
        try {
            $this->collection->insertOne($data->serialize());
        } catch (BulkWriteException $exception) {

            $this->collection->updateOne(
                ['_id'=>$data->serialize()['_id']],
                ['$set'=>$data->serialize()]
            );
        }

        return $data;
    }

    /**
     * @param string $id
     *
     * @return ReadModelInterface|null
     */
    public function find($id)
    {
        $transactionData = $this->collection->findOne(['_id'=> (string) $id]);

        if (!$transactionData) {
            return null;
        }

        return new Transaction(
            $transactionData['_id'],
            $transactionData['userId'],
            $transactionData['amount'],
            $transactionData['type'],
            $transactionData['title'],
            new \DateTime($transactionData['dateTime'])
        );
    }

    /**
     * @param array $fields
     *
     * @return ReadModelInterface[]
     */
    public function findBy(array $fields)
    {
        $transactions = $this->collection->find($fields);

        $transactionsObj = [];

        foreach ($transactions as $transactionData) {
            $transactionsObj[] = new Transaction(
                $transactionData['_id'],
                $transactionData['userId'],
                $transactionData['amount'],
                $transactionData['type'],
                $transactionData['title'],
                new \DateTime($transactionData['dateTime'])
            );
        }

        return $transactionsObj;
    }

    /**
     * @return ReadModelInterface[]
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param string $id
     */
    public function remove($id)
    {
        // TODO: Implement remove() method.
    }
}