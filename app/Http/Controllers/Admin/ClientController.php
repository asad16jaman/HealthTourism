<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Country;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    //
    public function index($id = null){
            $allclient= Hospital::with('country')->orderBy('id','desc')->get();
            $countries = Country::all();
            $editItem = null;
            if($id){
                $editItem = Hospital::findOrFail($id);
            }
        return view("admin.hospital",compact(['allclient','countries','editItem']));
    }
    public function store(Request $request,$id = null){
        $validationRules = [
            'img'=> "nullable|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048",
            'picture'=> "nullable|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048",
            'description' => 'required|string',
            'title' => 'required|string'
        ] ;
        $request->validate($validationRules);
        try{
            $data = $request->only(['country_id','title','description']) ;
            if($id){

                $item = Hospital::find($id);

                if ($request->hasFile('img')) {
                    //unlinked old image
                    if($item->img && Storage::exists($item->img)){
                    Storage::delete($item->img);
                    }
                    //store new image
                    $path = $request->file('img')->store('countryLogo');
                    $data['img'] = $path;
                }

                if ($request->hasFile('picture')) {
                    //unlinked old image
                    if($item->picture && Storage::exists($item->picture)){
                    Storage::delete($item->picture);
                    }
                    //store new image
                    $path = $request->file('picture')->store('countryPicture');
                    $data['picture'] = $path;
                }
                $item->update($data);
                return redirect()->route('admin.client')->with('success','Successfully Updated Hospital');
            }else{
                 if ($request->hasFile('img')) {
                        $path = $request->file('img')->store('countryLogo');
                        $data['img'] = $path;
                    }
                if ($request->hasFile('picture')) {
                        $path = $request->file('picture')->store('countryPicture');
                        $data['picture'] = $path;
                    }
                Hospital::create($data);
                return back()->with("success", "Successfully Hospital Created!");
            }
        }catch (\Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }
    public function destroy(int $id){
        try{
            $data = Hospital::findOrFail($id);
            //unlink image from directory....
            if($data->img && Storage::exists($data->img)){
                 Storage::delete($data->img);
            }
            if($data->picture && Storage::exists($data->picture)){
                 Storage::delete($data->picture);
            }
            $data->delete();
            return redirect()->route('admin.client')->with('success', 'Successfully Client Deleted!');

        }catch (\Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }

}
