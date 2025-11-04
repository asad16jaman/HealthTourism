<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    //
    public function index($id = null){
            $datas= Doctor::latest()->get();
            $editItem = null;
            if($id){
                $editItem = Doctor::findOrFail($id);
            }
        return view("admin.doctors",compact(['datas','editItem']));
    }
    public function store(Request $request,$id = null){
        $validationRules = [
            'img'=> "nullable|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048",
            'name' => 'required|string',
            'designation' => 'required|string',
            'detail' => 'nullable|string'
        ] ;
        $request->validate($validationRules);
        try{
            $data = $request->only(['name','designation','detail','email','status']) ;
            if($id){
                $item = Doctor::find($id);
                if ($request->hasFile('img')) {
                    //unlinked old image
                    if($item->img && Storage::exists($item->img)){
                        Storage::delete($item->img);
                    }
                    //store new image
                    $path = $request->file('img')->store('doctor');
                    $data['img'] = $path;
                }
                $item->update($data);
                return redirect()->route('admin.doctor')->with('success','Successfully Updated Doctor');
            }else{
                 if ($request->hasFile('img')) {
                        $path = $request->file('img')->store('doctor');
                        $data['img'] = $path;
                    }
                
                Doctor::create($data);
                return back()->with("success", "Successfully Doctor Created!");
            }
        }catch (\Exception $e){
            \Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }
    public function destroy(int $id){
        try{
            $data = Doctor::findOrFail($id);
            
            $data->delete();
            return redirect()->route('admin.doctor')->with('success', 'Successfully doctor Deleted!');

        }catch (\Exception $e){
            \Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }



}
