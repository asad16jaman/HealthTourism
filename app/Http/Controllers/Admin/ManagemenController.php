<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Management;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManagemenController extends Controller
{
    //

     public function index(Request $request, ?int $id = null)
    {
        $editTeam = null;
        if ($id != null) {
            $editTeam = Management::findOrFail($id);
        }
        $searchValue = $request->query("search", null);
        if ($searchValue != null) {
            $allteam = Management::where("name", "like", "%" . $searchValue . "%")->orderBy('id', 'desc')->simplePaginate(3);
        } else {
            $allteam = Management::orderBy('id', 'desc')->simplePaginate(3);
        }
        return view('admin.management', compact('allteam', 'editTeam'));
    }


    public function store(Request $request, ?int $id = null)
    {
        $validaterules= [
            'name'=> 'required',
            'designation'=> 'required',
        ];
        if ($id == null || $request->hasFile('photo')) {
            $validaterules['photo'] = "required|image|mimes:jpeg,jpg,png,gif,webp,svg";
        };
        $request->validate($validaterules);
        $data = $request->only(['name', 'designation']);
        if ($id != null) {
            try{
                //user edit section is hare
                $currentEditUser = Management::findOrFail($id);
                if ($request->hasFile('photo')) {
                    //delete if user already have profile picture...
                    if ($currentEditUser->photo != null) {
                        Storage::delete($currentEditUser->photo);
                    }
                    $path = $request->file('photo')->store('team');
                    $data['photo'] = $path;
                }
                Management::where('id', '=', $id)->update($data);
                return redirect()->route('admin.management',['page'=>$request->query('page'),'search'=>$request->query('search')])->with("success", "Management Successfully Updated!");
            }catch (Exception $e){
                Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
                return redirect()->route('error');
            }
        }
        try{
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('team');
                $data['photo'] = $path;
            }
            Management::create($data);
            return back()->with("success", "Management Successfully Created!");
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }

    public function destroy(int $id)
    {
        try{
            $data = Management::find($id);
            if ($data) {
                //unlink image from directory....
                if($data->photo != null) {
                    Storage::delete($data->photo);
                }
                $data->delete();
            }
            return redirect()->route('admin.management')->with('success', 'Management Successfully Deleted!');
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }
}
