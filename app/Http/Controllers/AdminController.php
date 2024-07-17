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
        $customers = User::where('role_id', 3)->get();
        return DataTables::of($customers)
            ->addColumn('action', function ($customer) {
                return '<button class="btn btn-danger block-button">Block</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getTravelAgencies()
    {
        $agencies = User::where('role_id', 2)->with('travelAgency')->get();
        return DataTables::of($agencies)
            ->addColumn('travel_agency_name', function ($agency) {
                return $agency->travelAgency->travel_agency_name;
            })
            ->addColumn('action', function ($agency) {
                return '<button class="btn btn-danger block-button">Block</button>';
            })
            ->make(true);
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
            ->make(true);

    }
    public function postService(Request $request)
    {
        $service = $request->validate([
            'service' => 'required|string|unique:services,service'
        ]);
        $service = Service::create($service);
        return redirect()->back();
    }
    public function viewDestinations()
    {
        return view('admin.destinations');
    }
    public function getDestinations()
    {

        $destinations = Destination::all();
        return DataTables::of($destinations)
            ->addColumn('action', function ($destination) {
                return '<button class="btn btn-danger delete-button">Delete</button>';
            })
            ->make(true);

    }
    public function postDestination(Request $request)
    {
        $destination = $request->validate([
            'destination' => 'required|string|unique:destinations,destination'
        ]);
        $destination = Destination::create($destination);
        return redirect()->back();
    }
}

