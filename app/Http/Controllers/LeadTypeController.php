<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\LeadType;
use Illuminate\Http\Request;

class LeadTypeController extends Controller
{
    public function get(Request $request)
    {
        $types = LeadType ::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $types->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                ];
            })->toArray()
        ]);
    }

    public function create(SettingRequest $request)
    {
        $type = LeadType ::create($request->only('name'));
        if (!$type) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save lead type'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $type->id,
                'name' => $type->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $type = LeadType::find($id);
        if (!$type) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead type not found'
            ], 404);
        }

        $type->update($request->only('name'));
        $type->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $type->id,
                'name' => $type->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $type = LeadType::find($id);
        if (!$type) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead type not found'
            ], 404);
        }

        $type->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
