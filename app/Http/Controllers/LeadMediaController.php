<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\LeadMedia;
use Illuminate\Http\Request;

class LeadMediaController extends Controller
{
    public function get(Request $request)
    {
        $medias = LeadMedia::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $medias->map(function ($media) {
                return [
                    'id' => $media->id,
                    'name' => $media->name,
                ];
            })->toArray()
        ]);
    }

    public function create(SettingRequest $request)
    {
        $media = LeadMedia::create($request->only('name'));
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save lead media'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $media->id,
                'name' => $media->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $media = LeadMedia::find($id);
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead media not found'
            ], 404);
        }

        $media->update($request->only('name'));
        $media->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $media->id,
                'name' => $media->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $media = LeadMedia::find($id);
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead media not found'
            ], 404);
        }

        $media->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
