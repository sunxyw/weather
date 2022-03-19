<?php

namespace Sunxyw\Weather;

use JsonException;
use Sunxyw\Weather\Parser\MeizuWeatherParser;

class Weather
{
    private array $cities;

    /**
     * @throws JsonException
     */
    public function __construct()
    {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        $package_path = dirname($reflection->getFileName(), 2) . '/sunxyw/weather';
        $cities_link = 'https://raw.githubusercontent.com/shichunlei/-Api/master/Meizu_city.json';
        if (!file_exists($package_path . '/cities.json')) {
            $dl_cities = file_get_contents($cities_link);
            $dl_cities = json_decode($dl_cities, true, 512, JSON_THROW_ON_ERROR);
            $cities = [];
            foreach ($dl_cities as $city) {
                $cities[$city['countyname']] = $city['areaid'];
            }
            if (!file_exists($package_path) && !mkdir($package_path, 0777, true) && !is_dir($package_path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $package_path));
            }
            file_put_contents($package_path . '/cities.json', json_encode($cities, JSON_THROW_ON_ERROR));
        }

        $this->cities = json_decode(file_get_contents($package_path . '/cities.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Get weather info by city name.
     *
     * @param string $city
     * @return WeatherReport
     * @throws JsonException
     */
    public function getWeather(string $city): WeatherReport
    {
        $city_id = $this->cities[$city] ?? null;
        if ($city_id === null) {
            throw new \InvalidArgumentException('City not found');
        }
        $url = 'https://aider.meizu.com/app/weather/listWeather?cityIds=' . $city_id;
        $data = file_get_contents($url);
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        return (new MeizuWeatherParser())->parse($data);
    }
}