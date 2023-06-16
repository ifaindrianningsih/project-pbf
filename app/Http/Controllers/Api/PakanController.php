<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pakan;
use App\Http\Resources\PakanResource;
use Illuminate\Support\Facades\Validator;

class PakanController extends Controller
{
    //
    public function index(){
        $pakans = Pakan::latest()->paginate(5);

        //return collection of pakan as a resource
        return new PakanResource(true, 'List Data Pakan', $pakans);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'jenisPakan' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'total' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create pakan
        $pakan = Pakan::create([
            'jenisPakan' => $request->jenisPakan,
            'harga' => $request->harga,
            'status' => $request->status,
            'total' => $request->total,
        ]);

        //return response
        return new PakanResource(true, 'Data Pakan Berhasil ditambahkan', $pakan);
    }

    public function show(Pakan $pakan) {
        //return single pakan as a resource
        return new PakanResource(true, 'Data Pakan Ditemukan!', $pakan);
    }

    public function update(Request $request, $jenisPakan){
        $validator = Validator::make($request->all(), [
            'jenisPakan' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pakan = Pakan::where('jenisPakan', $jenisPakan)->first();

        if (!$pakan) {
            return response()->json(['message' => 'Pakan not found'], 404);
        }

        $pakan->jenisPakan = $request->jenisPakan;
        $pakan->harga = $request->harga;
        $pakan->status = $request->status;
        $pakan->total = $request->total;
        
        $pakan->save();
        
        return new PakanResource(true, 'Data Pakan BerhasiL Diubah!', $pakan);
    }

    public function destroy($jenisPakan){
        $pakan = Pakan::where('jenisPakan', $jenisPakan)->first();

        if (!$pakan) {
            return response()->json(['message' => 'Pakan not found'], 404);
        }

        //delete pakan
        $pakan->delete();

        //return response
        return new PakanResource(true, 'Data Pakan Berhasil dihapus!', null);
    }
}
