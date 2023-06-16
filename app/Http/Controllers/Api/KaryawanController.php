<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Http\Resources\KaryawanResource;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    //
    public function index(){
        $karyawans = Karyawan::latest()->paginate(5);

        //return collection of karyawans as a resource
        return new KaryawanResource(true, 'List Data Karyawans', $karyawans);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nomorKaryawan' => 'required',
            'nama' => 'required',
            'jenisKelamin' => 'required',
            'status' => 'required',
            'jamKerja' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create karyawan
        $karyawan = Karyawan::create([
            'nomorKaryawan' => $request->nomorKaryawan,
            'nama' => $request->nama,
            'jenisKelamin' => $request->jenisKelamin,
            'status' => $request->status,
            'jamKerja' => $request->jamKerja,
        ]);

        //return response
        return new KaryawanResource(true, 'Data Karyawan Berhasil ditambahkan', $karyawan);
    }

    public function show(Karyawan $karyawan) {
        //return single karyawan as a resource
        return new KaryawanResource(true, 'Data Karyawan Ditemukan!', $karyawan);
    }

    public function update(Request $request, $nomorKaryawan){
        $validator = Validator::make($request->all(), [
            'nomorKaryawan' => 'required',
            'nama' => 'required',
            'jenisKelamin' => 'required',
            'status' => 'required',
            'jamKerja' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $karyawan = Karyawan::where('nomorKaryawan', $nomorKaryawan)->first();

        if (!$karyawan) {
            return response()->json(['message' => 'Karyawan not found'], 404);
        }

        $karyawan->nomorKaryawan = $request->nomorKaryawan;
        $karyawan->nama = $request->nama;
        $karyawan->jenisKelamin = $request->jenisKelamin;
        $karyawan->status = $request->status;
        $karyawan->jamKerja = $request->jamKerja;
        
        $karyawan->save();
        
        return new KaryawanResource(true, 'Data Karyawan BerhasiL Diubah!', $karyawan);
    }

    public function destroy($nomorKaryawan){
        $karyawan = Karyawan::where('nomorKaryawan', $nomorKaryawan)->first();

        if (!$karyawan) {
            return response()->json(['message' => 'Karyawan not found'], 404);
        }

        //delete karyawan
        $karyawan->delete();

        //return response
        return new KaryawanResource(true, 'Data Karyawan Berhasil dihapus!', null);
    }
}
