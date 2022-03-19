<?php

namespace Sunxyw\Weather;

class WeatherReport
{
    private string $city;

    private int $cityId;

    private array $realtime;

    private array $forecast;

    private array $forecastDaily;

    private array $advices;

    /**
     * WeatherReport constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     */
    public function setCityId(int $cityId): void
    {
        $this->cityId = $cityId;
    }

    /**
     * @return array
     */
    public function getRealtime(): array
    {
        return $this->realtime;
    }

    /**
     * @param array $realtime
     */
    public function setRealtime(array $realtime): void
    {
        $this->realtime = $realtime;
    }

    /**
     * @return array
     */
    public function getForecast(): array
    {
        return $this->forecast;
    }

    /**
     * @param array $forecast
     */
    public function setForecast(array $forecast): void
    {
        $this->forecast = $forecast;
    }

    /**
     * @return array
     */
    public function getForecastDaily(): array
    {
        return $this->forecastDaily;
    }

    /**
     * @param array $forecastDaily
     */
    public function setForecastDaily(array $forecastDaily): void
    {
        $this->forecastDaily = $forecastDaily;
    }

    /**
     * @return array
     */
    public function getAdvices(): array
    {
        return $this->advices;
    }

    /**
     * @param array $advices
     */
    public function setAdvices(array $advices): void
    {
        $this->advices = $advices;
    }

}