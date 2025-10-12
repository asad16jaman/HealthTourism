<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class SliderController extends Controller
{
    //

    public function index(Request $request, ?int $id = null)
    {
        $editSlider = null;
        if ($id != null) {
            $editSlider = Slider::find($id);
        }
        $search = $request->input('search');
        if ($search) {
            $allSlider = Slider::where('title', 'like', '%' . $search . '%')->simplePaginate(10);
        } else {
            $allSlider = Slider::simplePaginate(10);
        }
        return view("admin.slider", compact("editSlider", "allSlider"));
    }

    public function store(Request $request, ?int $id = null)
    {

        if($id){
            $validationRules = [
                'img' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp,svg',
            ];
        }else{
            $validationRules = [
                'img' => 'required|image|mimes:jpeg,jpg,png,gif,webp,svg',
            ];
        }
        
        $request->validate($validationRules);

        $data = $request->only(['description']);

        // return response()->json($data);

        if ($id != null) {
            $currentEditUser = Slider::findOrFail($id);
            try{
                 if ($request->hasFile('img')) {
                //delete if user already have profile picture...
                if ($currentEditUser->img != null && Storage::exists($currentEditUser->img)) {
                    Storage::delete($currentEditUser->img);
                }
                $path = $request->file('img')->store('slider');
                $data['img'] = $path;
                }
                Slider::where('id', '=', $id)->update($data);
                return redirect()->route('admin.slider', ['page' => $request->query('page'), 'search' => $request->query('search')])->with('success', "Successfully Slider updated!");
            }catch(Exception $e){
                Log::error("Error is commin from SlideController Storage method");
                return redirect()->route('error');

            }
           
        }

        try{
            
            if ($request->hasFile('img')) {
            $path = $request->file('img')->store('slider');
            $data['img'] = $path;
            }
            Slider::create($data);
            return back()->with("success", "Successfully Slider Created!");

        }catch (Exception $e){
            Log::error("Error is commin from SlideController Storage method");
            return redirect()->route('error');

        }


        
    }

    public function destroy(int $id)
    {
        
        try{

             $slider = Slider::find($id);
            if ($slider) {
                //unlink image from directory....
                Storage::delete($slider->img);
                $slider->delete();
            }

            return redirect()->route('admin.slider')->with('success', 'Successfully Slider Deleted!');

        }catch (Exception $e){
            Log::error("Error is commin from SlideController destroy  method");
            return redirect()->route('error');
        }
       

    }




}
