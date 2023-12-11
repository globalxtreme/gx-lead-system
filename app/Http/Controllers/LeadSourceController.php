<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\LeadSource;
use Illuminate\Http\Request;

class LeadSourceController extends Controller
{
    public function get(Request $request)
    {
        $sources = LeadSource ::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $sources->map(function ($source) {
                return [
                    'id' => $source->id,
                    'name' => $source->name,
                ];
            })->toArray()
        ]);
    }

    public function create(SettingRequest $request)
    {
        $source = LeadSource ::create($request->only('name'));
        if (!$source) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save lead source'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $source->id,
                'name' => $source->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $source = LeadSource::find($id);
        if (!$source) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead source not found'
            ], 404);
        }

        $source->update($request->only('name'));
        $source->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $source->id,
                'name' => $source->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $source = LeadSource::find($id);
        if (!$source) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead source not found'
            ], 404);
        }

        $source->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
