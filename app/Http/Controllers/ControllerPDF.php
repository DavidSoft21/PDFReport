<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PDF;
use App\Models\Files;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ControllerPDF extends Controller
{
    public function store(Request $request)
    {
    
        $max_code = PDF::select(
            DB::raw(' (IFNULL(MAX(RIGHT(pdf_code,7)),0)) AS number_max')
        )->first();

        $year = date('Y');
        $code = 'DOC' . $year . '-' . str_pad($max_code->number_max + 1, 7, "0", STR_PAD_LEFT);

        $pdf = PDF::create([
            'pdf_code' => $code,
            'title' => $request->input('title'),
            'state' => ($request->input('state') ? $request->input('state') : 0)
        ]);

        $file = $request->file('file');

        if ($file !== null) {

            $ext = $file->getClientOriginalExtension();

            if ($ext  == 'pdf') {

                $fileName = $file->getClientOriginalName();
                $route_file = $code . DIRECTORY_SEPARATOR . date('Ymdhmi') . '.' . $ext;
                $file->storeAs('public', $route_file);
                $path = storage_path("app/public/" . $route_file);
                $stored_file = fopen($path, "r");

                Files::create([
                    'pdf_id' => $pdf->id,
                    'url' => $route_file,
                    'name' => $fileName
                ]);
                return response()->json([
                    'response' => [
                        'msg' => 'Registro Completado',
                    ]
                ], 201);
            } else {
                return response()->json([
                    'response' => [
                        'msg' => 'Solo Archivos PDF',
                    ]
                ], 201);
            }
        }
    }
    public function urlfile($pdf_id)
    {
        
        $file = Files::where('pdf_id', $pdf_id)->where('state', 1)->first();
        return response()->json([
            'response' => [
                'url' => $file->url,
                'name' => $file->name,
            ]
        ], 201);
    }

    public function update(Request $request)
    {
        $id = $request->input('pdf_id');
        $code = $request->input('pdf_code');
        PDF::where('id', $id)->update([
            'title' => $request->input('title'),
            'state' => ($request->input('state') ? $request->input('state') : 0)
        ]);

        Files::where('pdf_id', $id)->update(['state' => 0]);

        $file = $request->file('file');
        if ($file !== NULL) {

            $ext = $file->getClientOriginalExtension();
            if ($ext == 'pdf') {

                $fileName = $file->getClientOriginalName();
                $route_file = $code . DIRECTORY_SEPARATOR . date('Ymdhmi') . '.' . $ext;
                $file->storeAs('public', $route_file);
                $path = storage_path("app/public/" . $route_file);
                $stored_file = fopen($path, "r");

                Files::create([
                    'pdf_id' => $id,
                    'url' => $route_file,
                    'name' => $fileName
                ]);
                return response()->json([
                    'response' => [
                        'msg' => 'Se actualizo Correctamente',
                    ]
                ], 201);
            } else {
                return response()->json([
                    'response' => [
                        'msg' => 'Solo Archivos PDF',
                    ]
                ], 201);
            }
        }
    }

    public function destroy($id)
    {
        PDF::where('id', $id)->delete();
        return response()->json([
            'response' => [
                'msg' => 'Eliminado correctamente!',
            ]
        ], 201);
    }
}
