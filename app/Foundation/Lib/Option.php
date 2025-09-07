<?php

namespace Foundation\Lib;

/**
 * Class Option
 * @package Foundation\Lib
 */
final class Option
{

    const VACANCY_LABEL = 0;

    const AVAILABILITY_TYPE = 1;

    const EDUCATION_LEVEL = 2;

    /**
     * @var $all
     */
    public static $all = [
        self::VACANCY_LABEL     => 'Vacancy Level',
        self::AVAILABILITY_TYPE => 'Availability Type',
        self::EDUCATION_LEVEL   => 'Education Level',
    ];

}
