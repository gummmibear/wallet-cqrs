<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 28.02.17
 * Time: 02:28
 */

namespace App\DataProvider;


use Domain\Wallet\ReadModel\WalletRepository;

class WalletDataProvider
{
    private $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function getByUserId(string $userId)
    {
        return $this->walletRepository->find($userId);
    }
}