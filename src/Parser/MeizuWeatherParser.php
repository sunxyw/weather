<?php

namespace Sunxyw\Weather\Parser;

use Sunxyw\Weather\WeatherReport;

class MeizuWeatherParser implements WeatherParserInterface
{
    /**
     * @inheritDoc
     */
    public function parse(array $raw): WeatherReport
    {
        $data = $raw['value'][0];

        $report = new WeatherReport();
        $report->setCity($data['city']);
        $report->setCityId($data['cityid']);

        $rt = $data['realtime'];
        $realtime = [];
        $realtime['temperature'] = $rt['temp'];
        $realtime['humidity'] = $rt['sD'];
        $realtime['wind_direction'] = $rt['wD'];
        $realtime['wind_speed'] = $rt['wS'];
        $realtime['air_quality'] = $data['pm25']['quality'];
        $realtime['weather'] = $rt['weather'];
        $report->setRealtime($realtime);

        $detail = $data['weatherDetailsInfo']['weather3HoursDetailsInfos'];
        $forecast = [];
        foreach ($detail as $item) {
            $forecast[] = [
                'start' => $item['startTime'],
                'end' => $item['endTime'],
                'temperature' => [
                    'min' => $item['lowerestTemperature'],
                    'max' => $item['highestTemperature'],
                ],
                'weather' => $item['weather'],
                'wind_direction' => $item['wd'],
                'wind_speed' => $item['ws'],
            ];
        }
        $report->setForecast($forecast);

        $weathers = $data['weathers'];
        $forecast_daily = [];
        foreach ($weathers as $item) {
            $forecast_daily[] = [
                'date' => $item['date'],
                'weather' => $item['weather'],
                'wind_direction' => $item['wd'],
                'wind_speed' => $item['ws'],
                'temperature' => [
                    'day' => $item['temp_day_c'],
                    'night' => $item['temp_night_c'],
                ],
                'sunrise' => $item['sun_rise_time'],
                'sunset' => $item['sun_down_time'],
            ];
        }
        $report->setForecastDaily($forecast_daily);

        $indexes = $data['indexes'];
        $advices = [];
        foreach ($indexes as $item) {
            $advices[] = [
                'title' => $item['name'],
                'advice' => $item['content'],
                'brief' => $item['level'],
            ];
        }
        $report->setAdvices($advices);

        return $report;
    }
}