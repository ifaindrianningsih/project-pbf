<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Http\Resources\ObatResource;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    //
    public function index(){
        $obats = Obat::latest()->paginate(5);

        //return collection of obats as a resource
        return new ObatResource(true, 'List Data Obat', $obats);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'jenisObat' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'total' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create obat
        $obat = Obat::create([
            'jenisObat' => $request->jenisObat,
            'harga' => $request->harga,
            'status' => $request->status,
            'total' => $request->total,
        ]);

        //return response
        return new ObatResource(true, 'Data Obat Berhasil ditambahkan', $obat);
    }

    public function show(Obat $obat) {
        //return single obat as a resource
        return new ObatResource(true, 'Data Obat Ditemukan!', $obat);
    }

    public function update(Request $request, $jenisObat){
        $validator = Validator::make($request->all(), [
            'jenisObat' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $obat = Obat::where('jenisObat', $jenisObat)->first();

        if (!$obat) {
            return response()->json(['message' => 'Obat not found'], 404);
        }

        $obat->jenisObat = $request->jenisObat;
        $obat->harga = $request->harga;
        $obat->status = $request->status;
        $obat->total = $request->total;
        
        $obat->save();
        
        return new ObatResource(true, 'Data Obat BerhasiL Diubah!', $obat);
    }

    public function destroy($jenisObat){
        $obat = Obat::where('jenisObat', $jenisObat)->first();

        if (!$obat) {
            return response()->json(['message' => 'Obat not found'], 404);
        }

        //delete obat
        $obat->delete();

        //return response
        return new ObatResource(true, 'Data Obat Berhasil dihapus!', null);
    }
}
