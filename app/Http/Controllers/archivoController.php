<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;

use App\Models\archivo as ModelsArchivo;

class archivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archivoBD =  Archivo::all();

        return view('welcome', ['archivoBD' => $archivoBD]);
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

        // Validar la solicitud
        $request->validate([
            'file' => 'required|file|max:10240', // Ajusta las reglas de validación según tus necesidades
            'semestre' => 'required|string',
            'programa' => 'required|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $originalExtension = $file->getClientOriginalExtension();

            // Almacenar el archivo en el disco 'public' con el nombre original
            $filePath = $file->storeAs('public/files', $originalName);
            $publicPath = str_replace('public', 'storage', $filePath);

            // Crear un nuevo registro en la base de datos
            $newfile = new Archivo;
            $newfile->archivo = $publicPath;
            $newfile->nombre = $originalName;
            $newfile->extension = $originalExtension;
            $newfile->semestre = $request->input('semestre');
            $newfile->programa = $request->input('programa');
            $newfile->save();

            // Redireccionar con un mensaje de éxito
            return redirect()->back()->with('success', 'Archivo subido exitosamente');
        }

        // Redireccionar con un mensaje de error si no se ha subido ningún archivo
        return redirect()->back()->with('error', 'No se ha subido ningún archivo');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $archivo = Archivo::find($id);

        if (!$archivo) {
            return abort(404);
        }

        // Ruta completa al archivo
        $filePath = storage_path('app/public/files/' . basename($archivo->archivo));

        // Eliminar el archivo del sistema de archivos
        if (Storage::disk('public')->exists('files/' . basename($archivo->archivo))) {
            Storage::disk('public')->delete('files/' . basename($archivo->archivo));
        }

        // Eliminar el registro de la base de datos
        $archivo->delete();

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Archivo eliminado exitosamente');
    }

    public function download($id)
    {
        $archivo = Archivo::find($id);

        if (!$archivo) {
            return abort(404);
        }

        // Ruta completa al archivo
        $filePath = storage_path('app/public/files/' . basename($archivo->archivo));

        // Descargar el archivo con el nombre original
        return response()->download($filePath, $archivo->nombre);
    }
}
