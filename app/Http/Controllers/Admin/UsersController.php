<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    //


    public function index(Request $request,?int $id = null ){
        $editUser = null;
        if( $id != null ){
            $editUser = User::find($id);
        }
        $searchValue = request()->query("search",null);
        if( $searchValue != null ){
            $allUsers = User::where("username","like","%".$searchValue."%")->orderBy('id','desc')->simplePaginate(3);
        }else{
            $allUsers = User::orderBy('id','desc')->simplePaginate(3);
        };
        return view("admin.users",compact(['allUsers','editUser']));
    }
    public function storeUser(Request $request,? int $id = null){
        $valRule = [
            'email' => ['nullable', 'email'],
            'type' => ['required', 'in:user,admin'], 
        ] ;
        if( $id == null ){
            $valRule['password'] = 'required';
            $valRule['username'] = ['required', 'string', 'unique:users,username'];
        }
        $request->validate($valRule);
        $data = $request->only(['email','type','fullname']);
        if( $id != null ){
            if(trim($request->password) != ''){
                $data['password'] = Hash::make($request->password);
            }
            try{
                $currentEditUser = User::find($id);
                if($request->hasFile('picture')){

                    //delete if user already have profile picture...
                    if( $currentEditUser->picture != null ){
                        Storage::delete($currentEditUser->picture);
                    }
                    $path = $request->file('picture')->store('profile');
                    $data['picture'] = $path;
                }
                User::where('id','=',$id)->update($data);
                return redirect()->route('admin.users',['page'=>request()->query('page'),'search'=>request()->query('search')])->with("success","User Successfully Updated!");
            }catch(Exception $e){
                Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
                return redirect()->route('error');
            }
        }
        $data['password'] = $request->password;
        $data['username'] = $request->username;

        try{
            if($request->hasFile('picture')){
                $path = $request->file('picture')->store('profile');
                $data['picture'] = $path;
            }
            User::create($data);
            return back()->with("success","User Successfully created!");
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
    }

    public function deleteUser($id){
        try{
            $user = User::find($id);
            if($user){
                if( $user->picture != null ){
                        Storage::delete($user->picture);
                    }
                $user->delete();
                return back()->with("success","User Successfully Deleted!");
            }
            return back()->with("warning","No User Detected");
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }
       
    }

    public function editUser($id){
        $editUser = User::find($id);
        return view("admin.userprofile",compact(['editUser']));
    }



    public function editUserStore(Request $request,int $id){
             $data = [
                'email' => $request->email,
                'type' => $request->type,
                'fullname' => $request->fullname
            ];
            if(trim($request->password) != ''){
                $data['password'] = Hash::make($request->password);
            }
            try{
                $currentEditUser = User::findOrFail($id);
                if($request->hasFile('picture')){
                    //delete if user already have profile picture...
                    if( $currentEditUser->picture != null ){
                        Storage::delete($currentEditUser->picture);
                    }
                    $path = $request->file('picture')->store('profile');
                    $data['picture'] = $path;
                }
                User::where('id','=',$id)->update($data);
                return redirect()->route('admin.user.edit',['id' => $id])->with("success","User Successfully Updated!");
            }catch(Exception $e){
                Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
                return redirect()->route('error');
            }
    }

}
