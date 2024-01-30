<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BranchOffice;
use App\Models\LeadChannel;
use App\Models\LeadMedia;
use App\Models\LeadProbability;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\LeadType;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getStatus(Request $request)
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

    public function getType(Request $request)
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

    public function getProbability(Request $request)
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

    public function getChannel(Request $request)
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

    public function getMedia(Request $request)
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

    public function getSource(Request $request)
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

    public function getBranchOffice(Request $request)
    {
        $branchOffices = BranchOffice::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where('name', 'LIKE', "%$request->search%");
            }
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $branchOffices->map(function ($branchOffice) {
                return [
                    'id' => $branchOffice->id,
                    'name' => $branchOffice->name,
                ];
            })->toArray()
        ]);
    }
}
