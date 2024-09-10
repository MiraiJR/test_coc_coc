<?php

declare(strict_types=1);

namespace app\order\infrastructure\persistence;

use app\order\domain\CoefficientConfiguration;
use phpmock\Mock;
use phpmock\MockBuilder;
use PHPUnit\Framework\TestCase;

class CoefficientConfigurationRepositoryTest extends TestCase
{
    private CoefficientConfigurationRepository $coefficientConfigurationRepository;
    const NAME_SPACE = 'app\order\infrastructure\persistence';
    private ?Mock $fileGetContentsMock = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->coefficientConfigurationRepository = new CoefficientConfigurationRepository();
    }

    public function tearDown(): void
    {
        if ($this->fileGetContentsMock) {
            $this->fileGetContentsMock->disable();
        }
    }

    public function testGetConfiguration_canNotGetFileContent()
    {
        $this->fileGetContentsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_get_contents")
            ->setFunction(
                function () {
                    return false;
                }
            )
            ->build()
        ;
        $this->fileGetContentsMock->enable();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Can not get coefficient configuration");

        $this->coefficientConfigurationRepository->getConfiguration();
    }

    public function testGetConfiguration_success()
    {
        $this->fileGetContentsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_get_contents")
            ->setFunction(
                function () {
                    return '
                        {
                            "weight": 1,
                            "dimension": 1
                        }
                    ';
                }
            )
            ->build()
        ;
        $this->fileGetContentsMock->enable();

        $expected_result = new CoefficientConfiguration(1, 1);
        $actual_result = $this->coefficientConfigurationRepository->getConfiguration();
        $this->assertEquals($expected_result, $actual_result);
    }
}
