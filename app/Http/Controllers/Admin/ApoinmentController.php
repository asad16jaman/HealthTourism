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
        $datas = Booking::with(['bookfiles','relations'])->latest()->get();
        return view('admin.book', compact('datas'));
    }

    public function downloadFile($id)
    {
        $file = Bookfile::findOrFail($id);
        $filePath = $file->document;
        // check if file exists
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, "File not found");
        }
        return Storage::disk('public')->download($filePath);
    }


    public function changeStatus(Request $request,int $id){

        $data = Booking::findOrFail($id);

        $status = $request->input('status');

        $data->status= $status;
        $data->save();
        return redirect()->back()->with("success",'Successfully Status Updated');

    }

    public function deleteApoint($id){

        $apoint = Booking::with(['relations','files'])->findOrFail($id);
        foreach($apoint->files as $file){
            if($file->document && Storage::exists($file->document)){
                 Storage::disk('public')->delete($file->document);
            }
            Bookfile::find($file->id)->delete();
        }

        Relation::where('booking_id','=',$apoint->id)->delete();

        $apoint->delete();

        return redirect()->back()->with('success','Successfully Deleted Apoint Data');

    }




}
