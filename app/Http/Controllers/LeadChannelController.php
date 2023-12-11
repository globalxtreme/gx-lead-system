<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\LeadChannel;
use Illuminate\Http\Request;

class LeadChannelController extends Controller
{
    public function get(Request $request)
    {
        $channels = LeadChannel::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $channels->map(function ($channel) {
                return [
                    'id' => $channel->id,
                    'name' => $channel->name,
                ];
            })->toArray()
        ]);
    }

    public function create(SettingRequest $request)
    {
        $channel = LeadChannel::create($request->only('name'));
        if (!$channel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save lead channel'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $channel->id,
                'name' => $channel->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $channel = LeadChannel::find($id);
        if (!$channel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead channel not found'
            ], 404);
        }

        $channel->update($request->only('name'));
        $channel->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $channel->id,
                'name' => $channel->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $channel = LeadChannel::find($id);
        if (!$channel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead channel not found'
            ], 404);
        }

        $channel->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
