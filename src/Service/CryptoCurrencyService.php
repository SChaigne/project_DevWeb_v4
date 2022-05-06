<?php

namespace App\Service;

use App\Entity\CryptoCurrency;
use Doctrine\ORM\EntityManagerInterface;


class CryptoCurrencyService
{
    public function __construct(EntityManagerInterface $leEntityManager)
    {
        $this->em = $leEntityManager;
    }

    public function getAllCrypto()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=1&limit=5&convert=EUR',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-CMC_PRO_API_KEY: 2d24e990-199c-4d01-8080-4483594f73db',
                'Accept: application/json'
            ),
        ));

        return json_decode(curl_exec($curl));
        curl_close($curl);
    }

    public function insertDataAPIBD(CryptoCurrencyService $cryptoService, $emInsert)
    {
        $cryptosData = $cryptoService->getAllCrypto()->data;
        foreach ($cryptosData as $crypto => $value) {
            $cryptoInsert = new CryptoCurrency();
            // $crypto->setCategory();
            // $crypto->setNbFollowTt();
            // $crypto->setDescription();
            // dd($value);
            $cryptoInsert->setMarketcap($value->quote->EUR->market_cap);
            $cryptoInsert->setName($value->name);
            $cryptoInsert->setPrice($value->quote->EUR->price);
            $cryptoInsert->setSymbol($value->symbol);

            $emInsert->persist($cryptoInsert);
            $emInsert->flush();
        }
    }
}
