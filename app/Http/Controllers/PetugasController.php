<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Petugas::paginate(10);
        return view('admin.petugas', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pet' => 'required',
            'nm' => 'required',
            'usernm' => 'required',
            'passwd' => 'required',
            'lvl' => 'required',
            'tlp' => 'required',
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create post
        $simpan = Petugas::create([
            'id_petugas' => $request->id_pet,
            'nama' => $request->nm,
            'username' => $request->usernm,
            'password' => bcrypt($request->passwd),
            'level' => $request->lvl,
            'telp' => $request->tlp,
        ]);
        if ($simpan) {
            Alert::success('Simpan data Petugas', 'Data Petugas berhasil di simpan');
            return redirect('/admin/petugas');
        } else {
            Alert::error('Simpan data Petugas', 'Data Petugas gagal di simpan');
            return redirect('/admin/petugas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
$data=Petugas::find($id);
return view('admin.petugas',compact(['data']));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
$upd = Petugas::find($id);
if($request->password==""){
$upd->update([
'id' => $request->id,
'id_petugas' => $request->id_petugas,
'nama' => $request->nama,



'username' => $request->username,
'level' => $request->level,
'telp' => $request->telp,
]);
}else{
$upd->update([
'id' => $request->id,
'id_petugas' => $request->id_petugas,
'nama' => $request->nama,
'username' => $request->username,
'password' => bcrypt($request->password),
'level' => $request->level,
'telp' => $request->telp,
]);
}
if($upd){
Alert::success('Ubah data Petugas', 'Data Petugas berhasil di ubah');
return redirect('/admin/petugas');
}else{
Alert::error('Ubah data Petugas', 'Data Petugas gagal di ubah');
return redirect('/admin/petugas');
}
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $del=Petugas::find($id);
    $del->delete(); //perintah untuk hapus
    if($del){
    toastr()->success('Data Petugas berhasil dihapus');
    return redirect('/admin/petugas');
    }else{
    toastr()->error('Data Petugas berhasil dihapus');
    return redirect('/admin/petugas');
    }

    }

}