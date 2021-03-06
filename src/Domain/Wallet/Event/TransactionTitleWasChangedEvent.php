<?php

namespace Domain\Wallet\Event;

class TransactionTitleWasChangedEvent extends TransactionEvent
{
    private $title;

    public function __construct(string $transactionId, int $userId, string $title)
    {
        parent::__construct($transactionId, $userId);
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function serialize()
    {
        return [
            'transactionId' => $this->transactionId,
            'userId' => $this->userId,
            'title' => $this->title
        ];
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['transactionId'],
            $data['userId'],
            $data['title']
        );
    }
}
