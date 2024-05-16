<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload() {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request) {
        // dump($request->berkas);
        // dump($request->file('file'));
        // return "Pemrosesan file upload di sini";
        // if($request->hasFile('berkas')) {
        //     echo "path(): " . $request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): " . $request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): " . $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): " . $request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): " . $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): " . $request->berkas->getSize();
        // } else {
        //     echo "Tidak ada berkas yang diupload";
        // }
        $request->validate([
            'berkas' => 'required|file|image|max:500',
        ]);
        // $path = $request->berkas->store('uploads');
        // $path = $request->berkas->storeAs('uploads', 'berkas');
        // $namaFile = $request->berkas->getClientOriginalName();
        // $path = $request->berkas->storeAs('uploads', $namaFile);
        // echo $request->berkas->getClientOriginalName() . " lolos validasi";
        // echo "Proses Upload Berhasil, File berada di: $path";

        $extFile = $request->berkas->getClientOriginalName();
        $namaFile = 'web-' . time() . "." . $extFile;
        // $path = $request->berkas->storeAs('uploads', $namaFile);
        $path = $request->berkas->storeAs('public', $namaFile);
        
        $pathBaru = asset('storage/' . $namaFile);
        echo "Proses Upload Berhasil, data disimpan pada: $path";
        echo "<br>";
        echo "Tampilkan link :<a href='$pathBaru'>$pathBaru</a>";
    }
}
