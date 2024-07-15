<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Vp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TravelAgencyController extends Controller
{
    public function create()
    {
        $vp = Vp::all();
        // dd($vp);
        $services = Service::all();
        $destinations = Destination::all();

        return view('agency.packages', compact('vp', 'services', 'destinations'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // $users = User::with('travelAgency')->get();
        $travel_agency_id = $user->travelAgency->travel_agency_id;
        // dd($users);


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'services' => 'required|array',
            'destinations' => 'required|array',
            'persons' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);



        $package = Vp::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'persons' => $validated['persons'],
            'travel_agency_id' => $travel_agency_id,
        ]);

        $package->services()->attach($validated['services']);

        $package->destinations()->attach($validated['destinations']);
        return redirect()->back();
    }
    public function edit($id)
    {
        $package = Vp::findOrFail($id);
        $allServices = Service::all();
        $allDestinations = Destination::all();

        return view('agency.single_package', compact('package', 'allServices', 'allDestinations'));
    }
    public function update(Request $request, $vp_id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'services' => 'required|array',
            'destinations' => 'required|array',
            'persons' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $package = Vp::findOrFail($vp_id);
        $vp_id = $package->vp_id;
        $package->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'persons' => $validated['persons'],
            'price' => $validated['price'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);



        $package->services()->detach();

        $package->destinations()->detach();

        $package->services()->attach($validated['services']);

        $package->destinations()->attach($validated['destinations']);

        return redirect()->back();
    }
    public function destroy($vp_id)
    {
        $package = Vp::findOrFail($vp_id);

        $package->services()->detach();
        $package->destinations()->detach();

        $package->delete();

        return redirect('agency/packages');
    }
    public function getBookings()
    {
        $user = Auth::user();
        $travel_agency_id = $user->travelAgency->travel_agency_id;
        // dd($travel_agency_id);
        $bookings = Booking::where('travel_agency_id', $travel_agency_id)
            ->join('vp', 'bookings.vp_id', '=', 'vp.vp_id')
            ->select('bookings.*', 'vp.title as vacation_title', 'vp.start_date', 'vp.end_date', 'vp.price')
            ->get();
        // dd($bookings);

        return view('agency.bookings', compact('bookings'));
    }
    public function cancelBookings($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        // dd($bookings);
        return redirect()->back();
    }
    public function getInquiries()
    {
        $travel_agency_id = Auth::user()->travelAgency->travel_agency_id;

        $vp_id = Vp::where('travel_agency_id', $travel_agency_id)->pluck('vp_id');

        $inquiries = Inquiry::whereIn('vp_id', $vp_id)->get();

        return view('agency.inquiry', compact('inquiries'));

    }
    public function respondToInquiry(Request $request)
    {
        $request->validate([
            'inquiry_id' => 'required|exists:inquiries,inquiry_id',
            'response' => 'required|string'
        ]);

        $inquiry = Inquiry::find($request->inquiry_id);
        $inquiry->response = $request->response;
        $inquiry->save();
        return redirect()->back();
    }
    public function showProfileForm()
    {
        $user = Auth::user();
        $formValues = [
            'agency_name' => $user->travelAgency->travel_agency_name,
            'agency_desc' => $user->travelAgency->travel_agency_description,
        ];

        return view('agency.profile', compact('formValues'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'agency_name' => 'required|string|max:255',
            'agency_desc' => 'required|string',
        ]);

        $user = auth()->user();
        $travelAgency = $user->travelAgency;

        if ($travelAgency) {
            $travelAgency->travel_agency_name = $request->agency_name;
            $travelAgency->travel_agency_description = $request->agency_desc;
            $travelAgency->save();
        } else {
            dd('failed');
        }

        return redirect()->back();
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => 'The current password is incorrect.',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back();
    }
}







