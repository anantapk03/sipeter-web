<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AccessFeature;
use App\Models\Divisi;
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
        if($user->level == "Kepala Puskesmas"){
            $user->status = $this->isKepusAxis();
        } else{
            $user->status = 'active';
        }

        if($request->hasFile('imageUrl')){
            $file = $request->file('imageUrl');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $user->imageUrl = $fileName;
        }

        // Save Data 
        try{
            $user->save();
            $this->addFeaturesForAdminOrKepus($user);
            return redirect(route('admin-management-users', ['level'=>$level]))->with('success', 'Data berhasil ditambahkan');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function isKepusAxis(){
        $data = User::where('level', "Kepala Puskesmas")->where('status', 'active')->get();
        // dd($data);
        $status = $data->isEmpty()? "active" : "inactive";
        return $status;
    }

    public function addFeaturesForAdminOrKepus(User $user){
        if($user->level == "Admin" || $user->level == "Kepala Puskesmas"){
            try{
                $adminAccess = $this->getAdminFeatures();
                $data = new AccessFeature();
                $data->idDivisi = $adminAccess->id;
                $data->idUser = $user->id;
                $data->isLeader = false;

                $data->save();
            } catch(Exception $e){
                return redirect()->route('admin-management-users', ['level'=>$user->level])->with('error', "Gagal menyimpan akses fitur");
            }
        }
    }

    public function getAdminFeatures(){
        $adminAccessId = Divisi::where('namaDivisi', 'admin')->first();
        return $adminAccessId;
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

    public function updateStatus($id){
        try{
            $user = User::findOrFail($id);

            if($user->level == "Kepala Puskesmas"){
                if($user->status == "active"){
                    $user->status = "inactive";
                } else {
                    $isKepusAxis = $this->isKepusAxis();
                    if($isKepusAxis == "inactive"){
                        // Its mean, there are one kepus active in system, so this block will execute
                        return redirect()->back()->with('error', 'There just only 1 Kepala Puskesmas for 1 system');
                    } else{
                        $user->status = 'active';   
                    }
                }

            } else{
                if($user->status == 'active'){
                    $user->status = 'inactive';
                } else{
                    $user->status = 'active';
                }
            }

            $user->update();

            return redirect()->back()->with('success','Update status successfully');
        } catch(Exception $e){
            return redirect()->back()->with('error', 'Data status failed to be updated');
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
