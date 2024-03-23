<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }

    public function create(): View {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request): RedirectResponse {
        // $validated = $request->validate([
        //     'kategori_kode' => 'bail|required|unique:posts|max:10',
        //     'kategori_nama' => 'required',
        // ]);

        // // The post is valid..

        // return redirect('/kategori');
        // The incoming request is valid...

        // Retrieve the validated input data...
        $validate = $request->validated();

        // Retrieve a portion of the validated input data...
        $validate = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validate = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        // Store the post...
        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }

    public function edit($id) {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }

    public function edit_simpan($id, Request $request) {
        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;

        $kategori->save();

        return redirect('/kategori');
    }
    
    public function delete($id) {
        $kategori = KategoriModel::find($id);
        $kategori->delete();

        return redirect('/kategori');
    }
}
