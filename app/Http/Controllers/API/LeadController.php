<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use App\Models\LeadStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function get(Request $request)
    {
        $leads = Lead::where(function ($query) use ($request) {
            if (strlen($request->search) > 3) {
                $query->where(function ($query) use ($request) {
                    $query->where("fullName", "LIKE", "%$request->search%")
                        ->orWhere("email", "LIKE", "$request->search%")
                        ->orWhere("number", "LIKE", "$request->search%");
                });
            }

            if ($request->statusId != '') {
                $query->where('statusId', $request->statusId);
            }

            if ($request->branchOfficeId != '') {
                $query->where('branchOfficeId', $request->branchOfficeId);
            }

            if ($request->fromDate != '' && $request->toDate != '') {
                $dateRange = [
                    Carbon::createFromFormat('d/m/Y', $request->fromDate),
                    Carbon::createFromFormat('d/m/Y', $request->toDate)
                ];
                $query->where('created_at', $dateRange);
            }
        })->paginate(50);

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => $leads->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'number' => $lead->number,
                    'fullName' => $lead->fullName,
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'address' => $lead->address,
                    'latitude' => $lead->latitude,
                    'longitude' => $lead->longitude,
                    'companyName' => $lead->companyName,
                    'gender' => $lead->gender,
                    'IDNumber' => $lead->IDNumber,
                    'IDNumberPhoto' => $lead->IDNumberPhotoUrl(),
                    'generalNotes' => $lead->generalNotes,
                    'branchOffice' => optional($lead->branchOffice)->only('id', 'name'),
                    'status' => optional($lead->status)->only('id', 'name'),
                    'probability' => optional($lead->probability)->only('id', 'name'),
                    'type' => optional($lead->type)->only('id', 'name'),
                    'channel' => optional($lead->channel)->only('id', 'name'),
                    'media' => optional($lead->media)->only('id', 'name'),
                    'source' => optional($lead->source)->only('id', 'name'),
                    'createdAt' => optional($lead->created_at)->format('d/m/Y H:i'),
                ];
            })->toArray(),
            'pagination' => [
                'count' => $leads->count(),
                'currentPage' => $leads->currentPage(),
                'perPage' => $leads->perPage(),
                'total' => $leads->total(),
                'totalPages' => $leads->lastPage()
            ]
        ]);
    }

    public function create(LeadRequest $request)
    {
        $status = LeadStatus::where('default', true)->first();
        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead status default not found!!'
            ], 404);
        }

        $IDNumberPhoto = null;
        if ($request->has('IDNumberPhoto') && $request->file('IDNumberPhoto')->isValid()) {
            $IDNumberPhoto = $request->file('IDNumberPhoto')->store('leads', 'public');
        }

        $lead = Lead::create([
            'number' => Lead::generateNumber(),
            'fullName' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'companyName' => $request->companyName,
            'gender' => $request->gender,
            'IDNumber' => $request->IDNumber,
            'IDNumberPhoto' => $IDNumberPhoto,
            'generalNotes' => $request->generalNotes,
            'branchOfficeId' => $request->branchOfficeId,
            'statusId' => $status->id,
            'probabilityId' => $request->probabilityId,
            'typeId' => $request->typeId,
            'channelId' => $request->channelId,
            'mediaId' => $request->mediaId,
            'sourceId' => $request->sourceId,
        ]);
        if (!$lead) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to create lead'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $lead->id,
                'number' => $lead->number,
                'fullName' => $lead->fullName,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'address' => $lead->address,
                'latitude' => $lead->latitude,
                'longitude' => $lead->longitude,
                'companyName' => $lead->companyName,
                'gender' => $lead->gender,
                'IDNumber' => $lead->IDNumber,
                'IDNumberPhoto' => $lead->IDNumberPhotoUrl(),
                'generalNotes' => $lead->generalNotes,
                'branchOffice' => optional($lead->branchOffice)->only('id', 'name'),
                'status' => optional($lead->status)->only('id', 'name'),
                'probability' => optional($lead->probability)->only('id', 'name'),
                'type' => optional($lead->type)->only('id', 'name'),
                'channel' => optional($lead->channel)->only('id', 'name'),
                'media' => optional($lead->media)->only('id', 'name'),
                'source' => optional($lead->source)->only('id', 'name'),
                'createdAt' => optional($lead->created_at)->format('d/m/Y H:i'),
            ]
        ]);
    }

    public function detail($id)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead channel not found'
            ], 404);
        }

        return [
            'id' => $lead->id,
            'number' => $lead->number,
            'fullName' => $lead->fullName,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'address' => $lead->address,
            'latitude' => $lead->latitude,
            'longitude' => $lead->longitude,
            'companyName' => $lead->companyName,
            'gender' => $lead->gender,
            'IDNumber' => $lead->IDNumber,
            'IDNumberPhoto' => $lead->IDNumberPhotoUrl(),
            'generalNotes' => $lead->generalNotes,
            'branchOffice' => optional($lead->branchOffice)->only('id', 'name'),
            'status' => optional($lead->status)->only('id', 'name'),
            'probability' => optional($lead->probability)->only('id', 'name'),
            'type' => optional($lead->type)->only('id', 'name'),
            'channel' => optional($lead->channel)->only('id', 'name'),
            'media' => optional($lead->media)->only('id', 'name'),
            'source' => optional($lead->source)->only('id', 'name'),
            'createdAt' => optional($lead->created_at)->format('d/m/Y H:i'),
        ];
    }

    public function update($id, LeadRequest $request)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead not found'
            ], 404);
        }

        $IDNumberPhoto = $lead->IDNumberPhoto;
        if ($request->has('IDNumberPhoto') && $request->file('IDNumberPhoto')->isValid()) {
            $IDNumberPhoto = $request->file('IDNumberPhoto')->store('leads', 'public');
        }

        $lead->update([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'companyName' => $request->companyName,
            'gender' => $request->gender,
            'IDNumber' => $request->IDNumber,
            'IDNumberPhoto' => $IDNumberPhoto,
            'generalNotes' => $request->generalNotes,
            'branchOfficeId' => $request->branchOfficeId,
            'probabilityId' => $request->probabilityId,
            'typeId' => $request->typeId,
            'channelId' => $request->channelId,
            'mediaId' => $request->mediaId,
            'sourceId' => $request->sourceId,
        ]);
        $lead->refresh();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $lead->id,
                'number' => $lead->number,
                'fullName' => $lead->fullName,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'address' => $lead->address,
                'latitude' => $lead->latitude,
                'longitude' => $lead->longitude,
                'companyName' => $lead->companyName,
                'gender' => $lead->gender,
                'IDNumber' => $lead->IDNumber,
                'IDNumberPhoto' => $lead->IDNumberPhotoUrl(),
                'generalNotes' => $lead->generalNotes,
                'branchOffice' => optional($lead->branchOffice)->only('id', 'name'),
                'status' => optional($lead->status)->only('id', 'name'),
                'probability' => optional($lead->probability)->only('id', 'name'),
                'type' => optional($lead->type)->only('id', 'name'),
                'channel' => optional($lead->channel)->only('id', 'name'),
                'media' => optional($lead->media)->only('id', 'name'),
                'source' => optional($lead->source)->only('id', 'name'),
                'createdAt' => optional($lead->created_at)->format('d/m/Y H:i'),
            ]
        ]);
    }

    public function updateStatus($id, Request $request)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead not found'
            ], 404);
        }

        $lead->update(['statusId' => $request->statusId]);
        $lead->refresh();
        return response()->json([
            'status' => 'error',
            'message' => 'Success',
            'data' => [
                'id' => $lead->id,
                'number' => $lead->number,
                'status' => optional($lead->status)->only('id', 'name'),
            ]
        ]);
    }

    public function delete($id)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lead not found'
            ]);
        }

        $lead->delete();
        return response()->json([
            'status' => 'error',
            'message' => 'Success'
        ]);
    }

    public function dashboard(Request $request)
    {
        $fromDate = $request->fromDate ? Carbon::createFromFormat('d/m/Y', $request->fromDate) : now()->subMonth();
        $fromDate->startOfDay();

        $toDate = $request->toDate ? Carbon::createFromFormat('d/m/Y', $request->toDate) : now();
        $toDate->endOfDay();

        $leads = Lead::whereBetween('created_at', [$fromDate, $toDate])->get();

        $statuses = LeadStatus::get()->map(function ($status) use ($leads) {
            return [
                'name' => $status->name,
                'total' => $leads->where('statusId', $status->id)->count()
            ];
        })->toArray();

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'total' => count($leads),
                'statuses' => $statuses,
            ]
        ]);
    }

}
