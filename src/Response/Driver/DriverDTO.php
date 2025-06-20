<?php

namespace Webites\WebfleetPhpClient\Response\Driver;

class DriverDTO
{
    public function __construct(
        public string $driverId,
        public string $name,
        public ?string $telMobile = null,
        public ?string $telPrivate = null,
        public ?string $company = null,
        public ?string $objectNo = null,
        public ?string $signOnTime = null,
        public ?string $dtCardId = null,
        public ?string $currentWorkingTimeStart = null,
        public ?string $currentWorkingTimeEnd = null,
        public ?bool $manualAssignment = null,
        public ?string $objectUid = null,
        public ?string $driverUid = null,
        public ?string $description = null,
    ) {}
}
