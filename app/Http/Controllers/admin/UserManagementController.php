<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
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
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function edit($level, $id){
        $user = User::find($id);
        return view('admin.users-management.edit', ['level'=>$level, 'user'=>$user]);
    }

    public function checkKepus(Request $request){
        if($request->level == "Kepala Puskesmas"){
            $findKepus = User::where('level', 'Kepala Puskesmas')->where('status', 'active')->get();
            if($findKepus != null){
                User::where('level', 'Kepala Puskesmas')->where('status', 'active')->update([
                    'status'=>'inactive',
                ]);
            }
        }
    }

    public function validationUpdateImage(Request $request, User $user){
        if($request->imageUrl != null){
            // Validasi request
            $request->validate([
                'nama' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'imageUrl' => 'required|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
                'nip' => 'required|string|max:18'
            ]);

            if($request->hasFile('imageUrl')){
                $file = $request->file('imageUrl');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('public/picture_profile', $fileName);
                $user->imageUrl = $fileName;
            }
        } else {
            $request->validate([
                'nama' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                // 'imageUrl' => 'required|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
                'nip' => 'required|string|max:18'
            ]);
        }
    }

    public function update($id, Request $request){

        // Input Data
        $user = User::find($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->level = $request->level;
        $user->nip = $request->nip;
        $user->status = "active";

        $this->checkKepus($request);
        $this->validationUpdateImage($request, $user);

        // Update Data 
        try{
            $user->update();
            return redirect(route('admin-management-users', ['level'=>$user->level]))->with('success', 'Data berhasil diperbarui');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function updatePassword($id){
        $user = User::find($id);
        $user->password = bcrypt($user->nip);
        $user->update();
        return redirect(route('admin-management-users', ['level'=>$user->level]))->with('success', 'Kata Sandi berhasil diperbarui'); 
    }

    public function delete($id){
        try{
            User::find($id)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }   
    }

}
