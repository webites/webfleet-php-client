<?php

namespace Webites\WebfleetPhpClient\Request;

use Webites\WebfleetPhpClient\Response\Driver\ActivityDTO;

class GetActivitiesRequest extends AbstractRequest
{
    protected const ENDPOINT = 'extern';
    protected const ACTION = 'showTripReportExtern';
    public function handle(): mixed
    {
        try {
            $response = $this->client->request(
                $this::METHOD,
                $this->fullUrl,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ],
            );

            if ($response->getStatusCode() !== 200 || empty($response->getBody())) {
                throw new \RuntimeException('Failed to fetch activities data. Please check your API credentials and parameters.');
            }

            $activities = json_decode($response->getBody()->getContents());

            if (!is_array($activities) || empty($activities)) {
                $this->logError(new \Exception($response->getBody()->getContents()));
                return [];
            }

            $collection = [];
            foreach ($activities as $activity) {
                $collection[] = new ActivityDTO(
                    tripId: $activity->tripid,
                    tripMode: $activity->tripmode,
                    objectNo: $activity->objectno,
                    objectName: $activity->objectname,
                    startTime: $activity->starttime,
                    startOdometer: $activity->startodometer,
                    startPostext: $activity->startpostext ?? '',
                    endTime: $activity->endtime ?? '',
                    endOdometer: $activity->endodometer ?? 0,
                    endPostext: $activity->endpostext ?? '',
                    duration: $activity->duration ?? 0,
                    idleTime: $activity->idletime ?? 0,
                    distance: $activity->distance ?? 0,
                    avgSpeed: $activity->avgspeed ?? 0,
                    maxSpeed: $activity->maxspeed ?? 0,
                    fuelUsage: $activity->fuelusage ?? 0.0,
                    startLongitude: $activity->startlongitude ?? 0.0,
                    startLatitude: $activity->startlatitude ?? 0.0,
                    startFormattedLongitude: $activity->startformattedlongitude ?? '',
                    startFormattedLatitude: $activity->startformattedlatitude ?? '',
                    endLongitude: $activity->endlongitude ?? 0.0,
                    endLatitude: $activity->endlatitude ?? 0.0,
                    endFormattedLongitude: $activity->endformattedlongitude ?? '',
                    endFormattedLatitude: $activity->endformattedlatitude ?? '',
                    driverNo: $activity->driverno ?? '',
                    driverName: $activity->drivername ?? '',
                    endAddrNo: $activity->endaddrno ?? null,
                    co2: $activity->co2 ?? 0,
                    fuelType: $activity->fueltype ?? 1,
                    epDistance: $activity->epdistance ?? 0,
                    objectUid: $activity->objectuid ?? null,
                    driverUid: $activity->driveruid ?? null,
                    optidriveIndicator: $activity->optidriveindicator ?? 0.0,
                    speedingIndicator: $activity->speedingindicator ?? 0,
                    drivingEventsIndicator: $activity->drivingeventsindicator ?? 0.0,
                    idlingIndicator: $activity->idlingindicator ?? 0,
                    fuelUsageIndicator: $activity->fuelusageindicator ?? 0.0,
                    coastingIndicator: $activity->coastingindicator ?? 0.0,
                    constantSpeedIndicator: $activity->constantspeedindicator ?? 0.0,
                    highRevvingIndicator: $activity->highrevvingindicator ?? 0.0,
                    energyUsage: $activity->energyusage ?? 0.0,
                    energyConsumptionDriving: $activity->energyconsumptiondriving ?? 0.0,
                    energyConsumptionOther: $activity->energyconsumptionother ?? 0.0,
                    energyRecovered: $activity->energyrecovered ?? 0.0
                );

                return $collection;
            }
        } catch (\Exception $exception) {
            return [];
        }
    }
}
