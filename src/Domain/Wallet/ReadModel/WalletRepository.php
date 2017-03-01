<?php

namespace Domain\Wallet\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\ReadModel\RepositoryInterface;
use MongoDB\Collection;
use MongoDB\Driver\Exception\BulkWriteException;

class WalletRepository implements RepositoryInterface
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
        $walletData = $this->collection->findOne(['_id'=> (string) $id]);

        if (!$walletData) {
            return null;
        }

        return new Wallet((int)$walletData['_id'], $walletData['accountBalance'], $walletData['transactionCount']);
    }

    /**
     * @param array $fields
     *
     * @return ReadModelInterface[]
     */
    public function findBy(array $fields)
    {
        // TODO: Implement findBy() method.
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
