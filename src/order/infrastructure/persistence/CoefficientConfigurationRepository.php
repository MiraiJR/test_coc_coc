<?php

declare(strict_types=1);

namespace app\order\infrastructure\persistence;

use app\order\application\port\out\GetCoefficientConfiguration;
use app\order\domain\CoefficientConfiguration;
use app\order\infrastructure\mapping\CoefficientConfigurationMapping;

class CoefficientConfigurationRepository implements GetCoefficientConfiguration
{
    private readonly CoefficientConfigurationMapping $coefficientConfigurationMapping;

    public function __construct(CoefficientConfigurationMapping $coefficient_configuration_mapping = null)
    {
        $this->coefficientConfigurationMapping = $coefficient_configuration_mapping ?? new CoefficientConfigurationMapping(
        );
    }

    /**
     * @throws \Exception
     */
    public function getConfiguration(): CoefficientConfiguration
    {
        $raw_data = file_get_contents(__DIR__ . '/../data_storage/coefficient/settings.json');

        if (!$raw_data) {
            throw new \Exception("Can not get coefficient configuration");
        }

        $coefficient_raw_data = json_decode($raw_data, true);
        return $this->coefficientConfigurationMapping->convertRawDataToDomainEntity($coefficient_raw_data);
    }
}
