<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sapi;
use App\Http\Resources\SapiResource;
use Illuminate\Support\Facades\Validator;

class SapiController extends Controller
{
    //
    public function index(){
        $sapis = Sapi::latest()->paginate(5);

        //return collection of sapi as a resource
        return new SapiResource(true, 'List Data Sapi', $sapis);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'jenisSapi' => 'required',
            'jenisKelamin' => 'required',
            'kondisi' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create sapi
        $sapi = Sapi::create([
            'nis' => $request->nis,
            'jenisSapi' => $request->jenisSapi,
            'jenisKelamin' => $request->jenisKelamin,
            'kondisi' => $request->kondisi,
        ]);

        //return response
        return new SapiResource(true, 'Data Sapi Berhasil ditambahkan', $sapi);
    }

    public function show(Sapi $sapi) {
        //return single sapi as a resource
        return new SapiResource(true, 'Data Sapi Ditemukan!', $sapi);
    }

    public function update(Request $request, $nis){
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'jenisSapi' => 'required',
            'jenisKelamin' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $sapi = Sapi::where('nis', $nis)->first();

        if (!$sapi) {
            return response()->json(['message' => 'Sapi not found'], 404);
        }

        $sapi->nis = $request->nis;
        $sapi->jenisSapi = $request->jenisSapi;
        $sapi->jenisKelamin = $request->jenisKelamin;
        $sapi->kondisi = $request->kondisi;
        
        $sapi->save();
        
        return new SapiResource(true, 'Data Sapi BerhasiL Diubah!', $sapi);
    }

    public function destroy($nis){
        $sapi = Sapi::where('nis', $nis)->first();

        if (!$sapi) {
            return response()->json(['message' => 'Sapi not found'], 404);
        }

        //delete sapi
        $sapi->delete();

        //return response
        return new SapiResource(true, 'Data Sapi Berhasil dihapus!', null);
    }
}
