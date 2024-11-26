<?php
namespace App\Http\Controllers;

use App\Models\SensitiveData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class SensitiveDataController extends Controller
{
    public function index()
    {
        $data = SensitiveData::all();
        return view('sensitive_data.index', compact('data'));
    }

    public function create()
    {
        return view('sensitive_data.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sensitive_data' => 'required|string|max:255',
        ]);

        SensitiveData::create([
            'name' => $request->name,
            'encrypted_data' => Crypt::encryptString($request->sensitive_data),
            'hashed_data' => Hash::make($request->sensitive_data),
        ]);

        return redirect()->route('sensitive_data.index')->with('success', 'Dado cadastrado com sucesso!');
    }

    public function show($id)
    {
        $data = SensitiveData::findOrFail($id);
        $data->decrypted = Crypt::decryptString($data->encrypted_data); // Descriptografa o dado
        return view('sensitive_data.show', compact('data'));
    }

    public function destroy($id)
    {
        SensitiveData::findOrFail($id)->delete();
        return redirect()->route('sensitive_data.index')->with('success', 'Dado excluído com sucesso!');
    }
}
