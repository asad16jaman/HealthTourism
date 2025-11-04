<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Servicemessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    //

    public function index(int $id=null){
        $editItem = null;
        if($id){
            $editItem = Service::findOrFail($id);
        }
        $datas = Service::latest()->get();
        return view('admin.service',compact('editItem','datas'));
    }


    public function store(Request $request, ?int $id = null)
    {
        $validationRules = [
            'name' => 'required',
        ];
        if ($id == null || $request->hasFile('img')) {
            $validationRules['img'] = 'required|image|mimes:jpeg,jpg,png,gif,webp,svg';
        }

        $request->validate($validationRules);
        $data = $request->only(['name','description']);
        if (!is_null($id)) {
            $currentEditUser = Service::findOrFail($id);
            try {
                if ($request->hasFile('img')) {
                    //delete if user already have profile picture...
                    if ($currentEditUser->img != null) {
                        Storage::delete($currentEditUser->img);
                    }
                    $path = $request->file('img')->store('pservice');
                    $data['img'] = $path;
                }
                Service::where('id', $id)->update($data);
                return redirect()->route('admin.service', ['page' => request()->query('page'), 'search' => request()->query('search')])->with('success', 'Successfully Service Updated!');
            } catch (\Exception $e) {
                Log::error("this message is from : " . __CLASS__ . "Line is : " . __LINE__ . " messages is " . $e->getMessage());
                return redirect()->route('error');
            }
        }

        try {
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('pservice');
                $data['img'] = $path;
            }
            //creating product
            $product = Service::create($data);

            return redirect()->back()->with('success', 'Successfully Service Created!');
        } catch (\Exception $e) {
            Log::error("this message is from : " . __CLASS__ . "Line is : " . __LINE__ . " messages is " . $e->getMessage());
            return redirect()->route('error');
        }
    }

    public function destroy(int $id)
    {
        try {

            $deleteBook = Service::findOrFail($id);
            // Delete main product picture
            if ($deleteBook->img) {
                Storage::delete($deleteBook->img);
            }
            $deleteBook->delete();
            return redirect()->route('admin.service')->with('success', 'Successfully Service Deleted!');
        } catch (\Exception $e) {
            Log::error("this message is from: " . __CLASS__ . " Line: " . __LINE__ . " message: " . $e->getMessage());
            return redirect()->route('error');
        }
    }

    public function getServiceMessage(int $id=null){

        if($id == null){
            $datas = Servicemessage::latest()->get();
        }else{
            $datas = Servicemessage::where('service_id',$id)->latest()->get();
        }
        return view('admin.service-message',compact('datas'));

    }

    public function deleteServiceMessage(int $id){
        $data = Servicemessage::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.service.message')->with('success',"Successfully Deleted Message");
    }

}
