<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Bookfile;
use App\Models\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApoinmentController extends Controller
{
    //

    public function index()
    {
        // $datas = Booking::with(['bookfiles','relations'])->latest()->get();
        $datas = Booking::with(['relations'])->latest()->get();
        return view('admin.book', compact('datas'));
    }

    public function downloadFile($id,string $name)
    {
        $file = Booking::findOrFail($id);
        if($name=='passport_image'){
            $filePath = $file->passport_img;
            $ext = explode('.',$filePath);
            $exten = $ext[count($ext) - 1];
            $filName = $file->name."_passport.".$exten;

        }

        if($name=='prescription'){
            $filePath = $file->prescription;
            $ext = explode('.',$filePath);
            $exten = $ext[count($ext) - 1];
            $filName = $file->name."_prescription.".$exten;
        }

        if($name=='report'){
            $filePath = $file->report;
            $ext = explode('.',$filePath);
            $exten = $ext[count($ext) - 1];
            $filName = $file->name."_report.".$exten;
        }

        // check if file exists
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, "File not found");
        }
        return Storage::disk('public')->download($filePath,$filName);
    }


    public function changeStatus(Request $request,int $id){

        $data = Booking::findOrFail($id);

        $status = $request->input('status');

        $data->status= $status;
        $data->save();
        return redirect()->back()->with("success",'Successfully Status Updated');

    }

    public function deleteApoint($id){

        $apoint = Booking::with(['relations'])->findOrFail($id);
        
        // foreach($apoint->files as $file){
        //     if($file->document && Storage::exists($file->document)){
        //          Storage::disk('public')->delete($file->document);
        //     }
        //     Bookfile::find($file->id)->delete();
        // }

        if($apoint->passport_img && Storage::exists($apoint->passport_img)){
            Storage::disk('public')->delete($apoint->passport_img);
        }

        if($apoint->prescription && Storage::exists($apoint->prescription)){
            Storage::disk('public')->delete($apoint->prescription);
        }

        if($apoint->report && Storage::exists($apoint->report)){
            Storage::disk('public')->delete($apoint->report);
        }

        Relation::where('booking_id','=',$apoint->id)->delete();

        $apoint->delete();

        return redirect()->back()->with('success','Successfully Deleted Apoint Data');

    }




}
