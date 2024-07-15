<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\Vp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $query = Vp::query();

        if ($request->has('sortPrice')) {
            $sortPrice = $request->input('sortPrice');
            if (in_array($sortPrice, ['asc', 'desc'])) {
                $query->orderBy('price', $sortPrice);
            }
        }

        if ($request->filled('startDate')) {
            $startDate = $request->input('startDate');
            $query->where('start_date', '>=', $startDate);
        }

        if ($request->filled('endDate')) {
            $endDate = $request->input('endDate');
            $query->where('end_date', '<=', $endDate);
        }

        if ($request->filled('searchTitle')) {
            $searchTitle = $request->input('searchTitle');
            $query->where('title', 'like', '%' . $searchTitle . '%');
        }

        $vp = $query->latest()->paginate(3);

        $services = Service::all();
        $destinations = Destination::all();

        return view('customer.home', compact('vp', 'services', 'destinations'));
    }
    public function show($vp_id)
    {
        $user = Auth::user();
        $package = Vp::find($vp_id);
        $services = $package->services;
        $destinations = Destination::all();
        $travel_agency = $package->travelAgency;
        $customer_id = $user->customer->customer_id;
        $booking = Booking::where('customer_id', $customer_id)
            ->where('vp_id', $vp_id)
            ->exists();

        return view('customer.package', compact('package', 'services', 'destinations', 'travel_agency', 'booking'));
    }
    public function book($vp_id)
    {
        $user = Auth::user();

        $booking = new Booking();
        $booking->customer_id = $user->customer->customer_id;
        $booking->vp_id = $vp_id;
        $booking->save();

        return redirect()->back()->with('success', 'Booking successful!');
    }
    public function inquiry(Request $request, $vp_id)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::user();
        $inquiry = new Inquiry();
        $inquiry->vp_id = $vp_id;
        $inquiry->customer_id = $user->customer->customer_id;
        $inquiry->subject = $validated['subject'];
        $inquiry->message = $validated['message'];
        $inquiry->save();

        return redirect()->back()->with('success', 'Inquiry sent successfully!');
    }
    public function bookings()
    {
        $user = Auth::user();
        $customer_id = $user->customer->customer_id;
        $bookings = Booking::where('customer_id', $customer_id)
            ->join('vp', 'bookings.vp_id', '=', 'vp.vp_id')
            ->select('bookings.*', 'vp.title as vacation_title', 'vp.start_date', 'vp.end_date', 'vp.price')
            ->get();
        // dd($bookings);

        return view('customer.bookings', compact('bookings'));
    }
    public function inquiries()
    {
        $user = Auth::user();
        $customer_id = $user->customer->customer_id;
        $inquiries = Inquiry::where('customer_id', $customer_id)->get();

        return view('customer.inquiry', compact('inquiries'));
    }
    public function deleteInquiry($id)
    {
        $user = Auth::user();
        $customer_id = $user->customer->customer_id;

        $inquiry = Inquiry::where('inquiry_id', $id)
            ->where('customer_id', $customer_id);

        $inquiry->delete();
        return redirect()->back();
    }
    public function deleteBooking($id)
    {
        $user = Auth::user();
        $customer_id = $user->customer->customer_id;

        $inquiry = Booking::where('booking_id', $id)
            ->where('customer_id', $customer_id);

        $inquiry->delete();
        return redirect()->back();
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The provided password does not match our records.']);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('user.profile.update')->with('success', 'Profile updated successfully');
    }
}