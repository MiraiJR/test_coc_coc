<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\CoefficientConfiguration;
use PHPUnit\Framework\TestCase;

class CoefficientConfigurationMappingTest extends TestCase
{
    public function testConvertRawDataToDomainEntity()
    {
        $coefficient_configuration_mapping = new CoefficientConfigurationMapping();
        $expected_result = new CoefficientConfiguration(11, 11);
        $actual_result = $coefficient_configuration_mapping->convertRawDataToDomainEntity(
            [
                CoefficientConfigurationMapping::RAW_DATA_WEIGHT_COEFFICIENT    => 11,
                CoefficientConfigurationMapping::RAW_DATA_DIMENSION_COEFFICIENT => 11,
            ]
        );

        $this->assertEquals($expected_result, $actual_result);
    }
}
