<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AccessFeature;
use App\Models\Divisi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AccessFeaturesController extends Controller
{

    public function isLeaderAny($idDivisi){
        /*
            Karena leader 1 divisi hanya satu maka kita wajib 
            check disatu divisi apakah sudah ada leader / belum. 
            Leader. 
        */

        try{
            $data = AccessFeature::where('idDivisi', $idDivisi)->where('isLeader',true)->first();
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        if(!$data){
            // Jika tidak ada leader
            return false;
        } else{
            // Jika ada leader
            return true;
        }
    }

    public function findDivisi($idUser){

        /*
            Data divisi diambil berdasarkan data divisi yang belum user pilih. 
        */

        try{
            $dataUserInDivisi = AccessFeature::where('idUser', $idUser)->pluck('idDivisi');
            $getDivisiWhereHaventChooseByUser = Divisi::whereNotIn('id', $dataUserInDivisi)->get();
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        return $getDivisiWhereHaventChooseByUser;
    }

    public function index($idUser){
        try{
            $data = AccessFeature::where('idUser', $idUser)->get();
            $user = User::findOrFail($idUser);
        } catch(Exception $e){
            return redirect()->back()->with('error', "User not found");
        }

        return view('admin.users-management.user-access-features.index', ['data' => $data, 'user'=>$user]);

    }

    public function create($idUser){
        try{
            $user = User::findOrFail($idUser);
        } catch(Exception $e){
            return redirect()->back()->with('error', "User not found");
        }
        $divisi = $this->findDivisi($idUser);
        return view('admin.users-management.user-access-features.create', ['divisi'=>$divisi, 'user'=>$user]);
    }

    public function store($idUser, Request $request){
        try{
            User::findOrFail($idUser);
        } catch(Exception $e){
            return redirect()->back()->with('error', "User not found");
        }

        $data = new AccessFeature();

        $data->idDivisi = $request->idDivisi;
        $data->idUser = $idUser;
        $data->isLeader = false;

        try{
            $data->save();
            $tag = 'success';
            $message = 'Data saved successfully';
        } catch(Exception $e){
            $tag = 'error';
            $message = 'Data failed to be saved';
        }

        return redirect()->route('management-features-index', ['idUser'=>$idUser])->with($tag, $message);

    }

    public function edit($idUser, $idAccessFeature){
        try{
            $user = User::findOrFail($idUser);
            $data = AccessFeature::findOrFail($idAccessFeature);
        } catch(Exception $e){
            return redirect()->back()->with('error', "Data or User not found");
        }

        $divisi = $this->findDivisi($idUser);

        return view('admin.users-management.user-access-features.edit', ['user'=>$user, 'data'=>$data, 'divisi'=>$divisi]);

    }

    public function update($idUser, $idAccessFeature, Request $request){
        try{
            User::findOrFail($idUser);
            $data = AccessFeature::findOrFail($idAccessFeature);
        } catch(Exception $e){
            return redirect()->back()->with('error', "Data or User not found");
        }

        if($request->idDivisi != $data->idDivisi){
            $data->isLeader = false;
        }

        $data->idDivisi = $request->idDivisi;

        try{
            $data->save();
            $tag = 'success';
            $message = 'Data updated successfully';
        } catch(Exception $e){
            $tag = 'error';
            $message = 'Data failed to be updated';
        }

        return redirect()->route('management-features-index', ['idUser'=>$idUser])->with($tag, $message);

    }

    public function editLeader($idAccessFeature){
        try{
            $data = AccessFeature::findOrFail($idAccessFeature);
        } catch(Exception $e){
            return redirect()->back()->with('error', "User not found");
        }

        $isAnyLeader = $this->isLeaderAny($data->idDivisi);



        if($data->isLeader){
            $data->isLeader = false;
        } else{
            if($isAnyLeader){
                return redirect()->back()->with('error', 'Divisi is already have a Leader');
            }
            $data->isLeader = true;
        }

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data saved successfully';
        } catch(Exception $e){
            $tag = 'error';
            $message = 'Data failed to be saved';
        }

        return redirect()->back()->with($tag, $message);

    }

    public function destroy($idAccessFeature){
        try{
            $data = AccessFeature::findOrFail($idAccessFeature);
        } catch(Exception $e){
            return redirect()->back()->with('error', "Data not found");
        }

        try{
            $data->delete();
            $tag = 'success';
            $message = 'Data deleted successfully';
        } catch(Exception $e){
            $tag = 'error';
            $message = 'Data failed to be delete';
        }

        return redirect()->back()->with($tag, $message);
        
    }
}
