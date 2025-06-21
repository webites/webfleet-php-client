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
                    startTime: $activity->start_time ?? '',
                    startOdometer: $activity->start_odometer ?? 0,
                    startPostext: $activity->start_postext ?? '',
                    endTime: $activity->end_time ?? '',
                    endOdometer: $activity->end_odometer ?? 0,
                    endPostext: $activity->end_postext ?? '',
                    duration: $activity->duration ?? 0,
                    idleTime: $activity->idle_time ?? 0,
                    distance: $activity->distance ?? 0,
                    avgSpeed: $activity->avg_speed ?? 0,
                    maxSpeed: $activity->max_speed ?? 0,
                    fuelUsage: $activity->fuel_usage ?? 0.0,
                    startLongitude: $activity->start_longitude ?? 0.0,
                    startLatitude: $activity->start_latitude ?? 0.0,
                    startFormattedLongitude: $activity->start_formatted_longitude ?? '',
                    startFormattedLatitude: $activity->start_formatted_latitude ?? '',
                    endLongitude: $activity->end_longitude ?? 0.0,
                    endLatitude: $activity->end_latitude ?? 0.0,
                    endFormattedLongitude: $activity->end_formatted_longitude ?? '',
                    endFormattedLatitude: $activity->end_formatted_latitude ?? '',
                    driverNo: $activity->driverno ?? '',
                    driverName: $activity->drivername ?? '',
                    endAddrNo: $activity->endaddrno ?? null,
                    co2: $activity->co2 ?? 0,
                    fuelType: $activity->fueltype ?? 1,
                    epDistance: $activity->ep_distance ?? 0,
                    objectUid: $activity->objectuid ?? null,
                    driverUid: $activity->driveruid ?? null,
                    optidriveIndicator: $activity->optidriveindicator ?? 0.0,
                    speedingIndicator: $activity->speeding_indicator ?? 0,
                    drivingEventsIndicator: $activity->drivingeventsindicator ?? 0.0,
                    idlingIndicator: $activity->idling_indicator ?? 0,
                    fuelUsageIndicator: $activity->fuelusage_indicator ?? 0.0,
                    coastingIndicator: $activity->coasting_indicator ?? 0.0,
                    constantSpeedIndicator: $activity->constant_speed_indicator ?? 0.0,
                    highRevvingIndicator: $activity->high_revving_indicator ?? 0.0,
                    energyUsage: $activity->energy_usage ?? 0.0,
                    energyConsumptionDriving: $activity->energy_consumption_driving ?? 0.0,
                    energyConsumptionOther: $activity->energy_consumption_other ?? 0.0,
                    energyRecovered: $activity->energy_recovered ?? 0.0
                );
            }

            return $collection;
        } catch (\Exception $exception) {
            return [];
        }
    }
}
