<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Machine;
use App\Models\Mutation;
use App\Models\Type;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('type', 'brand', 'mutation')->paginate(5);
        $brands = Brand::get();
        $types = Type::get();
        $url = 'machine';
        // dd($machines);
        return view('machine.index', compact('url', 'machines', 'brands', 'types'));
    }

    public function storeAndUpdate(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'type_id' => 'required',
            'brand_id' => 'required'
        ]);


        if ($request->barcode_id) {
            $machines = Machine::where('barcode_id', $request->barcode_id)->first();
            // dd($machines);
            $machines->update([
                'name' => $request->name,
                'status' => $request->status,
                'brand_id' => $request->brand_id,
                'type_id' => $request->type_id
            ]);

            if ($request->location != $machines->mutation->last()->location) {

                $mutation = Mutation::create([
                    'barcode_id' => $machines->barcode_id,
                    'location' => $request->location,
                    'created_at' => date('Y-m-d H:i'),
                    'updated_at' => date('Y-m-d H:i'),
                ]);
            }
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }

        $barcode_id = 'MSN-' . rand(1000, 9999);
        while (Machine::where('barcode_id', $barcode_id)->exists()) {
            $barcode_id = 'MSN-' . rand(1000, 9999);
        }
        $machines = Machine::create([
            'barcode_id' => $barcode_id,
            'name' => $request->name,
            'status' => $request->status,
            'brand_id' => $request->brand_id,
            'type_id' => $request->type_id
        ]);

        $type = Type::where('id', $request->type_id)->first();
        if ($type) {
            $type->update([
                'total' => $type->total + 1
            ]);
        }

        $mutation = Mutation::create([
            'barcode_id' => $machines->barcode_id,
            'location' => $request->location,
            'created_at' => date('Y-m-d H:i'),
            'updated_at' => date('Y-m-d H:i'),
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($barcode_id)
    {
        $machine = Machine::where('barcode_id', $barcode_id)->first();
        $type = Type::where('id', $machine->type->id)->first();
        $type->update([
            'total' => $type->total - 1
        ]);
        Mutation::where('barcode_id', $barcode_id)->delete();
        Machine::where('barcode_id', $barcode_id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
