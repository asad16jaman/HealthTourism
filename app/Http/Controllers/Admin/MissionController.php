<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MissionController extends Controller
{
    //

    public function index(){
        $ch= Mision::first();

        // return response()->json("hellow wolr");
        return view("admin.mission", compact(['ch']));
    }

    public function store(Request $request){

        $request->validate([
            'title'=> 'required',
            
        ]);
        
         $data = $request->only(['title','description']);
         $ch = Mision::first();
        if ($ch) {
            //user edit section is hare
            try{
                if ($request->hasFile('img')) {
                    //delete if user already have profile picture...
                    if ($ch->img != null) {
                        Storage::delete($ch->img);
                    }
                    $path = $request->file('img')->store('mision');
                    $data['img'] = $path;
                }
                Mision::where('id', '=', $ch->id)->update($data);
                // 
                return redirect()->route('admin.mision')->with("success", "Successfully Updated Company Mission");
            }catch(\Exception $e){
                Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
                return redirect()->route('error');
            }
        }


      
        try{
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('mision');
                $data['img'] = $path;
            }
            Mision::create($data);
            return back()->with("success", "Successfully added Company Mission & Vision");
        }catch(\Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }

    }
}
