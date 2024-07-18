<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Service;
use App\Models\TravelAgency;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{

    public function viewCustomers()
    {
        return view('admin.customers');
    }
    public function viewTravelAgencies()
    {
        return view('admin.agencies');

    }

    public function getCustomers()
    {
        $customers = User::where('role_id', 3)->withTrashed()->get();
        return response()->json(['data' => $customers]);
    }




    public function getTravelAgencies()
    {
        $agencies = User::where('role_id', 2)->with('travelAgency')->withTrashed()->get();
        return response()->json(['data' => $agencies]);
    }
    public function viewServices()
    {
        return view('admin.services');
    }
    public function getServices()
    {
        $services = Service::all();

        return DataTables::of($services)
            ->addColumn('action', function ($service) {
                return '<button class="btn btn-danger delete-button">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function postService(Request $request)
    {
        $request->validate([
            'service' => 'required|string|unique:services,service'
        ]);

        $service = new Service();
        $service->service = $request->input('service');
        $service->save();

        return response()->json(['message' => 'Service added successfully']);
    }


    public function deleteService($serviceId)
    {
        try {
            $service = Service::findOrFail($serviceId);
            $service->delete();

            return response()->json(['message' => 'Service deleted successfully']);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error deleting service: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to delete service. Please try again.'], 500);
        }
    }


    public function viewDestinations()
    {
        return view('admin.destinations');
    }

    public function getDestinations()
    {
        $destinations = Destination::all();

        return response()->json(['destination' => $destinations]);
    }


    public function postDestination(Request $request)
    {
        $validatedData = $request->validate([
            'destination' => 'required|string|unique:destinations,destination'
        ]);

        $destination = Destination::create($validatedData);

        return response()->json(['message' => 'Destination added successfully', 'destination' => $destination]);
    }

    public function deleteDestination($id)
    {
        try {
            $destination = Destination::findOrFail($id);
            $destination->delete();

            return response()->json(['message' => 'Destination deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete destination. Please try again.'], 500);
        }
    }



    public function blockUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User blocked successfully']);
    }

    public function unblockUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return response()->json(['message' => 'User unblocked successfully']);
    }

}

