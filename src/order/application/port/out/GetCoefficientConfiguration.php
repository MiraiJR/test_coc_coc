<?php

declare(strict_types=1);

namespace app\order\application\port\out;

use app\order\domain\CoefficientConfiguration;

interface GetCoefficientConfiguration
{
    public function getConfiguration(): CoefficientConfiguration;
}
