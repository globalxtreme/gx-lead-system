<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\BranchOffice;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    public function get(Request $request)
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

    public function create(SettingRequest $request)
    {
        $branchOffice = BranchOffice::create($request->only('name'));
        if (!$branchOffice) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to save branch office'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $branchOffice->id,
                'name' => $branchOffice->name,
            ]
        ]);
    }

    public function update($id, SettingRequest $request)
    {
        $branchOffice = BranchOffice::find($id);
        if (!$branchOffice) {
            return response()->json([
                'status' => 'error',
                'message' => 'Branch office not found'
            ], 404);
        }

        $branchOffice->update($request->only('name'));
        $branchOffice->refresh();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $branchOffice->id,
                'name' => $branchOffice->name,
            ]
        ]);
    }

    public function delete($id)
    {
        $branchOffice = BranchOffice::find($id);
        if (!$branchOffice) {
            return response()->json([
                'status' => 'error',
                'message' => 'Branch office not found'
            ], 404);
        }

        $branchOffice->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
        ]);
    }
}
