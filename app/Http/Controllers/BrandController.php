<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::paginate(5);
        $types = Type::paginate(5);
        $url = 'brand-type';
        return view('brand-type.index', compact('brand', 'url', 'types'));
    }

    public function storeAndUpdate(Request $request)
    {

        $validateData = $request->validate([
            'name_brand' => 'required|unique:brands,name_brand',
        ]);

        if ($request->id) {
            $brand = Brand::findOrFail($request->id);
            $brand->update($validateData);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }

        $brand = Brand::create($validateData);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
