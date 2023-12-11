<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\LeadStatus;
use Illuminate\Http\Request;

class LeadStatusController extends Controller
{
    public function get(Request $request)
    {
        $statuses = LeadStatus ::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $statuses->map(function ($status) {
                return [
                    'id' => $status->id,
                    'name' => $status->name,
                ];
            })->toArray()
        ]);
    }

    public function create(SettingRequest $request)
    {
        $status = LeadStatus ::create($request->only('name'));
        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save lead status'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $status->id,
                'name' => $status->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $status = LeadStatus::find($id);
        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead status not found'
            ], 404);
        }

        $status->update($request->only('name'));
        $status->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $status->id,
                'name' => $status->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $status = LeadStatus::find($id);
        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead status not found'
            ], 404);
        }

        $status->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
