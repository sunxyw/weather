<?php

namespace Sunxyw\Weather\Parser;

use Sunxyw\Weather\WeatherReport;

interface WeatherParserInterface
{
    /**
     * Parse the raw data.
     *
     * @param array $raw
     *
     * @return WeatherReport
     */
    public function parse(array $raw): WeatherReport;
}