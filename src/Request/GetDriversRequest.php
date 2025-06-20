<?php

namespace Webites\WebfleetPhpClient\Request;

use GuzzleHttp\Exception\GuzzleException;
use Webites\WebfleetPhpClient\Response\Driver\DriverDTO;

class GetDriversRequest extends AbstractRequest
{
    protected const ENDPOINT = 'extern';
    protected const ACTION = 'showDriverReportExtern';
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
        } catch (GuzzleException $exception) {

        }

        if ($response->getStatusCode() !== 200 || empty($response->getBody())) {
            throw new \RuntimeException('Failed to fetch drivers data. Please check your API credentials and parameters.');
        }

        $drivers = json_decode($response->getBody()->getContents());

        $collection = [];
        foreach ($drivers as $driver) {
            $collection[] = new DriverDTO(
                driverId: $driver->driverno,
                name: $driver->name1,
                telMobile: $driver->telmobile ?? null,
                telPrivate: $driver->telprivate ?? null,
                company: $driver->company ?? null,
                objectNo: $driver->objectno ?? null,
                signOnTime: $driver->signontime ?? null,
                dtCardId: $driver->dt_cardid ?? null,
                currentWorkingTimeStart: $driver->current_workingtimestart ?? null,
                currentWorkingTimeEnd: $driver->current_workingtimeend ?? null,
                manualAssignment: isset($driver->manualassignment) ? (bool)$driver->manualassignment : null,
                objectUid: $driver->objectuid ?? null,
                driverUid: $driver->driveruid ?? null,
                description: $driver->description ?? null,
            );
        }

        return $collection;
    }
}
