<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function storeAndUpdate(Request $request)
    {
        $validateData = $request->validate([
            'type_name' => 'required',
            'total' => 'null'
        ]);

        if ($request->id) {
            $type = Type::findOrFail($request->id);
            $type->update($validateData);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }

        $type = Type::create($validateData);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Type::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
