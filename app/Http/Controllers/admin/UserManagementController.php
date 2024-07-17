<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Str;

class UserManagementController extends Controller
{
    //
    public function index($level){
        $data = User::where('level', $level)->get();
        return view('admin.users-management.index', ['users' => $data, 'level' => $level]);
    }

    public function add($level, Request $request){
        return view('admin.users-management.add', ['level'=>$level]);
    }

    public function store($level, Request $request){

         // Validasi request
         $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'imageUrl' => 'required|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
            'nip' => 'required|string|max:18'
        ]);
        // Input Data
        $user = new User();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt('developers');
        $user->level = $level;
        $user->nip = $request->nip;
        $user->status = "active";

        if($request->hasFile('imageUrl')){
            $file = $request->file('imageUrl');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/picture_profile', $fileName);
            
            $user->imageUrl = $fileName;
        }

        // Save Data 
        try{
            $user->save();
            return redirect(route('admin-management-users', ['level'=>$level]))->with('success', 'Data berhasil ditambahkan');
        } catch(e){
            return redirect()->back()->with('error', "Something went wrong");
        }

    }

    public function edit($level, $id){
        $user = User::find($id);
        return view('admin.users-management.edit', ['level'=>$level, 'user'=>$user]);
    }
}
