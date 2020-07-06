<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 5/2/2018
 * Time: 5:28 PM
 */

namespace Components\CalculatorBundle\Service;


use CmsBundle\Bridge\HttpClient;
use CmsBundle\Repository\ConfigRepository;
use CmsBundle\Services\ConfigService;
use Symfony\Component\HttpKernel\Client;

class CurrencyService
{
    const API="http://api.kursna-lista.info/1e35c8af1532e3810b219bc7191e3293/konvertor/eur/rsd/1";
    const RSDVALUE = "rsd-value";

    private $client;

    public function __construct(HttpClient $client, ConfigService $repository)
    {
        $this->client = $client;
        $this->config = $repository;
    }

    public function getEurToRsd()
    {

        $currency = $this->client->get(self::API);
        $currency = json_decode($currency, true);

        return $currency['result']['value'];

    }

    /**
     * @param $value
     */
    public function setCurrencyValueInConfig($value)
    {
        $val = ['currency_value' => $value, "date" => New \DateTime()];
        $this->config->setNewConfigValue(self::RSDVALUE,$val);
    }

    /**
     * @param $value
     * @return \CmsBundle\Entity\Config|null
     */
    public function updateCurrencyValue($value){

        $val = ['currency_value' => $value, "date" => New \DateTime()];
        return $this->config->updateConfigByKey(self::RSDVALUE, $val);
    }

    /**
     * @return mixed
     */
    public function getCurrencyValue()
    {
        $configValue = $this->config->getConfigValueByKey(self::RSDVALUE);


        if($configValue === null) {
            $currency = $this->getEurToRsd();
            $this->setCurrencyValueInConfig($currency);
            return $currency;
        }
        elseif (!isset($configValue['date'])){
            $newCurrency = $this->getEurToRsd();
            $this->updateCurrencyValue($newCurrency);
            return $newCurrency;
        }
         else if (\DateTime::__set_state($configValue['date'])->modify('+1 day') < (new \DateTime('now'))) {

                $newCurrency = $this->getEurToRsd();
                $this->updateCurrencyValue($newCurrency);
                return $newCurrency;
        }
        return $configValue["currency_value"];
    }
}