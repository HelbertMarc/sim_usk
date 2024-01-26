<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pelanggaran::paginate(10);
        $dataSiswa = Siswa::all(); //tambahkan data crud untuk guru
        $user = Auth::user();
        if ($user->level == 'admin') {
            return view('admin.pelanggaran', compact(['data','dataSiswa']));
        } elseif ($user->level == 'gurubk') {
            return view('guru.pelanggaran', compact(['data','dataSiswa']));
        }
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
        $this->validate($request, [
            'idpel' => 'required',
            'nis' => 'required',
            'tgl' => 'required',
            'isi' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        if (Pelanggaran::where('id_pelanggaran', '=', $request->idpel)->count() > 0) {
            toastr()->error('Id Pelanggaran sudah ada');
            return redirect('/guru/pelanggaran');
        } else {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->move(public_path('foto'), $image->getClientOriginalName());
                $simpan = Pelanggaran::create([
                    'id_pelanggaran' => $request->idpel,
                    'nis' => $request->nis,
                    'tgl_pelanggaran' => $request->tgl,
                    'isi_pelanggaran' => $request->isi,
                    'foto' => $image->getClientOriginalName(),
                ]);
            } elseif ($request->file('foto') == "") {
                toastr()->error('Foto pelanggaran wajib dilampirkan');
                return redirect('/guru/pelanggaran');
            }
        }
        if ($simpan) {
            //redirect dengan pesan sukses
            toastr()->success('data pelanggaran sukses di simpan');
            return redirect('/guru/pelanggaran');
        } else {
            //redirect dengan pesan error
            toastr()->error('data pelanggaran gagal di simpan');
            return redirect('/guru/pelanggaran');
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
    public function edit(string $id)
    {
        //
        $data = Pelanggaran::find($id);
        //ubah adalah pengambilan data dari variabel $ubah, namanya harus sama
        return view('guru.pelanggaran', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'idpel' => 'required',
            'nis' => 'required',
            'tgl' => 'required',
            'isi' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $upd = Pelanggaran::find($id);
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image->move(public_path('foto'), $image->getClientOriginalName());
            $upd->update([
                'id_pelanggaran' => $request->idpel,
                'nis' => $request->nis,
                'tgl_pelanggaran' => $request->tgl,
                'isi_pelanggaran' => $request->isi,
                'foto' => $image->getClientOriginalName(),
            ]);
        } elseif ($request->file('foto') == "") {
            $upd->update([
                'id_pelanggaran' => $request->idpel,
                'nis' => $request->nis,
                'tgl_pelanggaran' => $request->tgl,
                'isi_pelanggaran' => $request->isi,
            ]);
        }
        if ($upd) {
            //redirect dengan pesan sukses
            toastr()->success('data pelanggaran sukses diubah');
            return redirect('/guru/pelanggaran');
        } else {
            //redirect dengan pesan error
            toastr()->error('data pelanggaran gagal di simpan');
            return redirect('/guru/pelanggaran');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy( $id)
    {
        $del = Pelanggaran::find($id);
        $del->delete(); //perintah untuk hapus
        if ($del) {
            toastr()->success('data pelanggaran sukses dihapus');
            return redirect('/guru/pelanggaran');
        } else {
            toastr()->error('data pelanggaran gagal di simpan');
            return redirect('/guru/pelanggaran');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $data = Pelanggaran::where('nis', 'like', "%" . $keyword . "%")->paginate(5);
        $dataSiswa = Siswa::all(); //tambahkan data untuk modal
        $user = Auth::user();
        return view('guru.pelanggaran', compact(['data','dataSiswa']))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    function view_pdf()
    {
        $data = Pelanggaran::limit(10)->get();
        $pdf = PDF::loadview('guru.pelanggaran-pdf', compact(['data']));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('pelanggaran.pdf'); //stream untuk lihat dahulu
    }
}
