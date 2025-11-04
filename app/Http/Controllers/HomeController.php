<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Faq;
use App\Models\About;
use App\Models\Slider;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Service;
use App\Models\Bookfile;
use App\Models\Feedback;
use App\Models\Hospital;
use App\Models\Relation;
use App\Models\WelcomeNode;
use App\Models\PatentReport;
use Illuminate\Http\Request;
use App\Models\Servicemessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index()
    {
        $sliders = Slider::all();
        $wellcome = WelcomeNode::first();
        $all_service = Service::latest()->take(6)->get();
        $hospitals = Hospital::latest()->take(10)->get();
        $feedbacks = Feedback::latest()->get();
        return view('user.home', compact('all_service', 'sliders', 'wellcome', 'hospitals', 'feedbacks'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => "required"
        ]);
        $data = $request->only(['name', 'email', 'subject', 'message']);
        try {
            Contact::create($data);
            return redirect()->back()->with('success', "Message Sent...");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "There is a Problem");
        }
    }

    public function companyAbout()
    {
        $aboutdetail = About::first();
        return view('user.about', compact('aboutdetail'));
    }
    public function service()
    {
        $all_service = Service::latest()->get();
        return view('user.service', compact('all_service'));
    }
    public function servicesDetail($uid)
    {
        $s_detail = Service::where('uid', '=', $uid)->first();
        $faqs = Faq::latest()->get();
        return view('user.service_detail', compact('s_detail', 'faqs'));
    }
    public function servicesMessageStore(Request $request, string $uid)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required|min:10'
        ]);
        $data = $request->only(['name', 'phone', 'message', 'service_id']);
        try {
            Servicemessage::create($data);
            return redirect()->back()->with('success', 'Your Message Sent. We Will Contact You.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "There is a problem. Try Again.");
        }
    }

    public function allfaq()
    {
        $allFaqs = Faq::latest()->get();
        return view('user.faqs', compact('allFaqs'));
    }

    public function hospitals()
    {

        $countries = Country::with('hospitals')->get();
        // return response()->json($country);
        return view('user.hospital', compact('countries'));
    }

    public function hospitalsDetail($uid){
        $hospital = Hospital::where('uid','=',$uid)->first();

        return view('user.hospitaldetail',compact('hospital'));

    }

    public function pationReportPage()
    {
        return view('user.patintreport');
    }

    public function savePataintReport(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string|min:3',
            'city' => 'required|string',
            'files' => 'required|mimes:pdf,doc,docx|max:5120',
            'email' => 'required|email',
            'message' => 'nullable|string'
        ]);
        $data = $request->only(['name', 'address', 'city', 'email', 'message']);
        try {
            if ($request->hasFile('files')) {
                $path = $request->file('files')->store('report');
                $data['files'] = $path;
            }
            PatentReport::create($data);
            return redirect()->back()->with('success', 'Your Report Sent. We Will Contact You.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "There is a problem. Try Again.");
        }
    }


    public function apointment()
    {
        $allCountry = Country::where('id', '!=', 9)->get();
        $services = Service::all();
        return view('user.apoinment', compact('allCountry', 'services'));
    }

public function storeApointment222(Request $request)
    {
        // nullable|image|mimes:pdf,doc,docx
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'country_id' => ['required', 'integer'],
            'message' => ['nullable', 'string'],
            'files' => ['nullable', 'array','max:4'],
            'files.*' => ['file', 'mimes:jpeg,jpg,png,webp', 'max:2024'],
            'service_id' => ['required','array'],
            'service_id.*' => 'string'
        ];

        if ($request->country_id != 9) {
            $rules['passport'] = ['required', 'string', 'max:50'];
            $rules['exp_date'] = ['required', 'date'];
            $rules['companions'] = ['required', 'array', 'min:1'];
            $rules['companions.*.name'] = ['required', 'string', 'max:255'];
            $rules['companions.*.relation'] = ['required', 'string', 'max:100'];
            $rules['companions.*.passport'] = ['required', 'string', 'max:50'];
            $rules['companions.*.exp_date'] = ['required', 'date'];
        }

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 200);
        }

        
        $service = $request->input('service_id');
        $datas = Service::select('name')->whereIn("id",$service)->get();
        $str = '';
        foreach ($datas as $data) {
            $str .= $data->name . ', ';
        }
        $str = rtrim($str, ', ');

        try {
           
        } catch (\Exception $e) {
           
        }
    }

    public function storeApointment(Request $request)
    {
        // nullable|image|mimes:pdf,doc,docx
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'country_id' => ['required', 'integer'],
            'message' => ['nullable', 'string'],
            'service_id' => ['required','array'],
            'service_id.*' => 'string',
            'passport_img' => ['nullable','file', 'mimes:jpeg,jpg,png,webp', 'max:2024'],
            'prescription' => ['nullable','file', 'mimes:jpeg,jpg,png,webp', 'max:2024'],
            'report' => ['nullable','file', 'mimes:jpeg,jpg,png,webp', 'max:2024']
        ];

        if ($request->country_id != 9) {
            $rules['passport'] = ['required', 'string', 'max:50'];
            $rules['exp_date'] = ['required', 'date'];
            $rules['companions'] = ['required', 'array', 'min:1'];
            $rules['companions.*.name'] = ['required', 'string', 'max:255'];
            $rules['companions.*.relation'] = ['required', 'string', 'max:100'];
            $rules['companions.*.passport'] = ['required', 'string', 'max:50'];
            $rules['companions.*.exp_date'] = ['required', 'date'];
        }

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 200);
        }

        $service = $request->input('service_id');
        $datas = Service::select('name')->whereIn("id",$service)->get();
        $str = '';
        foreach ($datas as $data) {
            $str .= $data->name . ', ';
        }
        $str = rtrim($str, ', ');

        $bookdata = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'service_name' => $str,
            'passport' => $request->passport,
            'exp_date' => $request->exp_date,
            'message' => $request->message,
        ];
        try {
            DB::beginTransaction();
            // Booking save

            // Bookfiles save
            // if ($request->hasFile('files')) {
            //     foreach ($request->file('files') as $file) {
            //         $path = $file->store('bookfile', 'public'); // public disk
            //         Bookfile::create([
            //             'booking_id' => $booking->id,
            //             'document' => $path,
            //         ]);
            //     }
            // }

            if($request->hasFile('passport_img')){
                $pass = $request->file('passport_img')->store('book_img');
                $bookdata['passport_img'] = $pass;
            }
            if($request->hasFile('prescription')){
                $pass = $request->file('prescription')->store('book_img');
                $bookdata['prescription'] = $pass;
            }
            if($request->hasFile('report')){
                $pass = $request->file('report')->store('book_img');
                $bookdata['report'] = $pass;
            }

            $booking = Booking::create($bookdata);


            // Companions save
            if ($request->country_id != 9) {
                if ($request->companions) {
                    foreach ($request->companions as $comp) {
                        Relation::create([
                            'booking_id' => $booking->id,
                            'name' => $comp['name'],
                            'type' => $comp['relation'],
                            'passport' => $comp['passport'] ?? null,
                            'exp_date' => $comp['exp_date'] ?? null,
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Successfully Stored Appointment Data"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Something Went Wrong.."
            ]);
        }
    }

    public function getAllService(){

        $services = Service::latest()->get(); 

        return response()->json([
            'status' => true,
            'services' => $services
        ]);
    }


    public function allDoctors() {
        
        $datas = Doctor::latest()->get();
        return view('user.allDoctors',compact(['datas']));
        
    }

    public function doctorDetail($uid){
        $doctor = Doctor::where('uid','=',$uid)->first();
        return view('user.doctordetail',compact('doctor'));
    }




}
