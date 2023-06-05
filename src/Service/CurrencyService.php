<?php

namespace Service;

use Entity\Currency;
use GuzzleHttp\Psr7\Request;
use Http\Request\ApiClient;
use Logger\Logger;
use Psr\Http\Message\ResponseInterface;
use Repository\CurrencyRepository;

class CurrencyService
{

    private CurrencyRepository $currencyRepository;

    public function __construct()
    {
        $this->currencyRepository = new CurrencyRepository();
    }

    /**
     * @throws \HttpException
     */
    public function setPresentValueForAllCurrencyFromNBP(): void
    {
        $currencyList = $this->getCurrencyFromNBP();
        foreach ($currencyList as $currency) {
            $this->currencyRepository->addRecord(
                Currency::TABLE_NAME,
                $this->createCurrencyFromNBP($currency)->toArray()
            );
        }
    }

    /**
     * @throws \HttpException
     */
    private function connectToNBP(): ?ResponseInterface
    {
        $client = new ApiClient();
        $response = null;
        $request = new Request('GET', 'http://api.nbp.pl/api/exchangerates/tables/C?format=json');
        try {
            $response = $client->sendRequest($request);
        } catch (\HttpException $e) {
            Logger::log($e->getMessage(), Logger::ERROR);
        } finally {
            return $response;
        }
    }


    /**
     * @throws \HttpException
     */
    private function getCurrencyFromNBP(): array
    {
        $response = $this->connectToNBP();
        if (is_null($response)) {
            return [];
        }
        $body = json_decode($response->getBody(), true);
        return $body[0]['rates'];
    }


    private function createCurrencyFromNBP(array $currency): Currency
    {
        return new Currency(
            $currency['currency'],
            $currency['code'],
            round($currency['bid'] * 100),
            round($currency['ask'] * 100)
        );
    }


    public function getAllCurrencyForAvailableDate(int $todayTimestamp): array
    {
        $currencyList = $this->currencyRepository->findBy(Currency::TABLE_NAME, ['date' => $todayTimestamp]);
        if (empty($currencyList)) {
            $this->getAllCurrencyForAvailableDate($todayTimestamp - 86400);
        }
        return $currencyList;
    }

    public function getAvailableCurrencyCodes(): array
    {
        return $this->currencyRepository->getAvailableCurrencyCodes();
    }

}