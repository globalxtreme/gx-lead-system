<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnuRequest;
use Illuminate\Http\Request;

class OnuController extends Controller
{
    /**
     * @param OnuRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOnu(OnuRequest $request)
    {
        $locationIds = ['wiantika582A', 'yohangG54D'];
        if (!in_array($request->locationId, $locationIds)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Location ID not found'
            ], 404);
        }

        $data = null;
        if ($request->locationId == 'wiantika582A') {
            $data = [
                "deliveryMethod" => "GPON",
                "description" => "wiantika582A",
                "distanceToOlt" => "11.37 km",
                "equipmentId" => "GP1702-1Gv2",
                "isDown" => false,
                "isGigabitSupported" => true,
                "isReplacementRequired" => false,
                "message" => "ONU Check Success",
                "moduleId" => "1154",
                "oltReceivePower" => "-31.5 dBm",
                "oltReceivePowerStatus" => "Receive Power too Low!",
                "onuPortStates" => [
                    [
                        "bandwidthProfile" => "Signature_100",
                        "isPortDown" => false,
                        "portNumber" => 1,
                        "profile" => "3604"
                    ]
                ],
                "onuStatus" => "Active",
                "receivePower" => "-24.8 dBm",
                "receivePowerStatus" => "Within Threshold.",
                "sendPower" => "1.9 dBm",
                "status" => "success"
            ];
        } elseif ($request->locationId == 'yohangG54D') {
            $data = [
                "deliveryMethod" => "GPON",
                "inactiveReason" => "None",
                "isDown" => true,
                "message" => "ONU is Down.",
                "onuStatus" => "Offline",
                "status" => "success"
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
