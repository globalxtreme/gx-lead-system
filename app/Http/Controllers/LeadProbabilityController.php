<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\LeadProbability;
use Illuminate\Http\Request;

class LeadProbabilityController extends Controller
{
    public function get(Request $request)
    {
        $probabilities = LeadProbability ::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $probabilities->map(function ($probability) {
                return [
                    'id' => $probability->id,
                    'name' => $probability->name,
                ];
            })->toArray()
        ]);
    }

    public function create(SettingRequest $request)
    {
        $probability = LeadProbability ::create($request->only('name'));
        if (!$probability) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save lead probability'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $probability->id,
                'name' => $probability->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $probability = LeadProbability::find($id);
        if (!$probability) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead probability not found'
            ], 404);
        }

        $probability->update($request->only('name'));
        $probability->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $probability->id,
                'name' => $probability->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $probability = LeadProbability::find($id);
        if (!$probability) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead probability not found'
            ], 404);
        }

        $probability->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
