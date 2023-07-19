<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task1FormRequest;
use App\Http\Requests\Task2FormRequest;
use App\Models\Task1;
use App\Models\Task2;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends BaseController
{
    public function task1Packets(): JsonResponse
    {
        try {
            $packets = Task1::all(); // or we can use paginate

            return $this->sendResponse($packets, 'Packets retrieved successfully.');
        }catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    public function task1(Task1FormRequest $request): JsonResponse
    {
        $packetData = $request->validated()['data'];

        $deviceDataFiveData = explode('|', $packetData, 6);
        $deviceDataFiveData = array_slice($deviceDataFiveData, 0, 5);

        $restOfData = explode('|', $packetData);
        $restOfData = array_slice($restOfData, 5);

        $restOfData = array_map(function ($item) {
            return explode('-', $item);
        }, $restOfData); // Explode each element using the "-" delimiter

        // transform device timestamp to a readable format
        $deviceDataFiveData[3] = Carbon::createFromTimestamp($deviceDataFiveData[3])->toDateTimeString();

        try {
            foreach ($restOfData as $key => $data) {
                // using model create method
                Task1::create([
                    'packet_id' => $deviceDataFiveData[0],
                    'device_id' => $deviceDataFiveData[1],
                    'sensometer_id' => $deviceDataFiveData[2],
                    'device_timestamp' => $deviceDataFiveData[3],
                    'sensor_id' => $data[0],
                    'slave_address' => $data[1],
                    'value' => $data[2]
                ]);
            }

            return $this->sendResponse([], 'Data saved successfully.');
        }catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function task2Packets(): JsonResponse
    {
        try {
            $packets = Task2::all();

            return $this->sendResponse($packets, 'Packets retrieved successfully.');
        }catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function task2(Task2FormRequest $request): JsonResponse
    {
        $packetData = $request->validated()['data'];

        $data = explode("|", $packetData);

        // separate into two arrays, first 9 elements and the rest
        $deviceData = array_slice($data, 0, 9);
        $sensorData = array_slice($data, 9);

        foreach ($sensorData as $key => $value) {
            $sensorData[$key] = explode("-", $value);
        }

        foreach ($sensorData as $key => $value) {
            foreach ($value as $k => $v) {
                $sensorData[$key][$k] = explode("_", $v);

                $sensorData[$key][$k] = [
                    $sensorData[$key][$k][0] => $sensorData[$key][$k][1],
                ];
            }
        }

        foreach ($sensorData as $key => $value) {
            $sensorData[$key] = array_merge(...$value);
        }

        $sensorData = array_merge(...$sensorData);

        try {
            foreach ($sensorData as $key => $value) {
                $type = '';
                if ($key[0] == "V") $type = "Voltage";
                if ($key[0] == "A") $type = "Amp";
                if ($key[0] == "W") $type = "Watt";
                if ($key[0] == "E") $type = "Kilo watt hour";

                $task2 = new Task2();
                $task2->packet_id = $deviceData[0];
                $task2->device_id = $deviceData[1];
                $task2->sensometer_id = $deviceData[2];
                $task2->device_timestamp = Carbon::createFromTimestamp($deviceData[3])->toDateTimeString();
                $task2->data_count = $deviceData[4];
                $task2->meter_param_id = $deviceData[5];
                $task2->meter_id = $deviceData[6];
                $task2->phase = $deviceData[7];

                $task2->sensor_type = $key;
                $task2->type = $type;
                $task2->value = $value;
                $task2->save();
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse([], 'Data saved successfully.');
    }
}
