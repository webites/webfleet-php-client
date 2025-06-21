<?php

namespace Webites\WebfleetPhpClient\Response\Driver;

class ActivityDTO
{
    public function __construct(
        public string $tripId,
        public int $tripMode,
        public string $objectNo,
        public string $objectName,
        public string $startTime,
        public int $startOdometer,
        public string $startPostext,
        public string $endTime,
        public int $endOdometer,
        public string $endPostext,
        public int $duration,
        public int $idleTime,
        public int $distance,
        public int $avgSpeed,
        public int $maxSpeed,
        public float $fuelUsage,
        public float $startLongitude,
        public float $startLatitude,
        public string $startFormattedLongitude,
        public string $startFormattedLatitude,
        public float $endLongitude,
        public float $endLatitude,
        public string $endFormattedLongitude,
        public string $endFormattedLatitude,
        public string $driverNo,
        public string $driverName,
        public ?string $endAddrNo = null,
        public int $co2 = 0,
        public int $fuelType = 1,
        public int $epDistance = 0,
        public ?string $objectUid = null,
        public ?string $driverUid = null,
        public float $optidriveIndicator = 0.0,
        public float $speedingIndicator = 0.0,
        public float $drivingEventsIndicator = 0.0,
        public float $idlingIndicator = 0.0,
        public float $fuelUsageIndicator = 0.0,
        public float $coastingIndicator = 0.0,
        public float $constantSpeedIndicator = 0.0,
        public float $highRevvingIndicator = 0.0,
        public float $energyUsage = 0.0,
        public float $energyConsumptionDriving = 0.0,
        public float $energyConsumptionOther = 0.0,
        public float $energyRecovered = 0.0
    ) {}
}
