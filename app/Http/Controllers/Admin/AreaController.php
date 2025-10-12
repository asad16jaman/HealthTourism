<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    //

    public function index(){

        $datas = Area::all();
        return view("admin.area",compact(["datas"]));
    }


    public function store(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->only(['name']);

        try{
            Area::create($data);
            return redirect()->back()->with('success','Successfully Area created!');
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }


    public function destroy($id){
        $area = Area::findOrFail($id);
        try{
            if($area->hasdealers()){
                return redirect()->back()->with('success', "This Area Has Dealers.You Need To Delete All Dealers");
            }else{
                $area->delete();
                return redirect()->back()->with('success', "Successfully Area Deleted!");
            }
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
        
    }
}
