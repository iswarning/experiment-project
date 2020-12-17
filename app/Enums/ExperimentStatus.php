<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ExperimentStatus extends Enum
{
    const statusName = [
        1 => 'New',
        2 => "Old",
    ];
}
