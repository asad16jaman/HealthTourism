<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\PatentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    //
    public function index(){
        $message = Contact::latest()->simplePaginate(10);
        return view("admin.message",compact("message"));
    }
    
    public function destroy(int $id){
        Contact::findOrFail($id)->delete();
        return redirect()->route("admin.message")->with('success','Successfully deleted Message!');
    }

    public function report(){

        $datas = PatentReport::latest()->get();
        return view("admin.report",compact("datas"));
    }

    public function reportDownload($id){
        $data = PatentReport::findOrFail($id);
        $filePath = public_path('storage/'.$data->files);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $data->name) . '.' . $extension;

        return response()->download($filePath, $fileName);

    }

    public function destroyreport($id){
        try{

             $report = PatentReport::find($id);
            if ($report && $report->files) {
                //unlink image from directory....
                Storage::delete($report->files);
                $report->delete();
            }

            return redirect()->route('admin.report')->with('success', 'Successfully Report Deleted!');

        }catch (\Exception $e){
            Log::error("Error is commin from ContactControler destroy  method");
            return redirect()->route('error');
        }

    }




}
