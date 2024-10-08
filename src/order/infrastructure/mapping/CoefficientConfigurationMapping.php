<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\CoefficientConfiguration;

class CoefficientConfigurationMapping
{
    const RAW_DATA_WEIGHT_COEFFICIENT = "weight";
    const RAW_DATA_DIMENSION_COEFFICIENT = "dimension";

    public function convertRawDataToDomainEntity(array $raw_data): CoefficientConfiguration
    {
        return new CoefficientConfiguration(
            $raw_data[self::RAW_DATA_WEIGHT_COEFFICIENT],
            $raw_data[self::RAW_DATA_DIMENSION_COEFFICIENT]
        );
    }
}
