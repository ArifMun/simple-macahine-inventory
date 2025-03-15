@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Mesin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Mesin</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">

                                        <h3 class="card-title">Data Mesin</h3>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalAddMachine" data-whatever="@mdo">Tambah Data </button>
                                        <div class="modal fade" id="exampleModalAddMachine" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalAddMachineLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalAddMachineLabel">Tambah</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('machine/storeAndUpdate') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Nama
                                                                    Mesin</label>
                                                                <input type="text" class="form-control" id=""
                                                                    name="name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Lokasi
                                                                    Mesin</label>
                                                                <input type="text" class="form-control" id=""
                                                                    name="location">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Status
                                                                    Mesin</label>
                                                                <select name="status" class="form-control" id="">
                                                                    <option value="" selected disabled>-- Pilih Status
                                                                        --
                                                                    </option>
                                                                    <option value="mesin_baru">Mesin Baru</option>
                                                                    <option value="mesin_rusak">Mesin Rusak</option>
                                                                    <option value="mesin_dipakai">Mesin Dipakai</option>
                                                                    <option value="mesin_dijual">Mesin Dijual</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Merk
                                                                    Mesin</label>
                                                                <select name="brand_id" class="form-control" id="">
                                                                    <option value="" selected disabled>-- Pilih Merk
                                                                        --
                                                                    </option>
                                                                    @foreach ($brands as $brand)
                                                                        <option value="{{ $brand->id }}">
                                                                            {{ $brand->name_brand }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Jenis
                                                                    Mesin</label>
                                                                <select name="type_id" class="form-control" id="">
                                                                    <option value="" selected disabled>-- Pilih Merk
                                                                        --
                                                                    </option>
                                                                    @foreach ($types as $type)
                                                                        <option value="{{ $type->id }}">
                                                                            {{ $type->type_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Add</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Mesin</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>Merk</th>
                                            <th>Jenis</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($machines as $machine)
                                            <tr>
                                                <td>{{ $machine->barcode_id }}</td>
                                                <td>{{ $machine->name }}</td>
                                                <td>{{ @$machine->mutation->last()->location }}</td>
                                                <td>{{ $machine->status }}</td>
                                                <td>{{ @$machine->brand->name_brand }}</td>
                                                <td>{{ $machine->type->type_name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-toggle="modal"
                                                        data-target="#exampleModalEditMachine-{{ $machine->barcode_id }}"
                                                        data-whatever="@mdo">Edit
                                                        Data </button>
                                                    <div class="modal fade"
                                                        id="exampleModalEditMachine-{{ $machine->barcode_id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalEditMachineLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalEditMachineLabel">Edit</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('machine/storeAndUpdate') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Barcode ID</label>

                                                                            <input type="text" class="form-control"
                                                                                id="" name="barcode_id"
                                                                                value="{{ $machine->barcode_id }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Nama
                                                                                Mesin</label>

                                                                            <input type="text" class="form-control"
                                                                                id="" name="name"
                                                                                value="{{ $machine->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Lokasi
                                                                                Mesin (Ubah jika ingin dipindahkaan)</label>
                                                                            <input type="text" class="form-control"
                                                                                id="" name="location"
                                                                                value="{{ @$machine->mutation->last()->location }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Status
                                                                                Mesin</label>
                                                                            <select name="status" class="form-control"
                                                                                id="">
                                                                                <option value="" selected disabled>--
                                                                                    Pilih Status
                                                                                    --
                                                                                </option>
                                                                                <option value="mesin_baru"
                                                                                    {{ $machine->status == 'mesin_baru' ? 'selected' : '' }}>
                                                                                    Mesin Baru
                                                                                </option>
                                                                                <option value="mesin_rusak"
                                                                                    {{ $machine->status == 'mesin_rusak' ? 'selected' : '' }}>
                                                                                    Mesin Rusak
                                                                                </option>
                                                                                <option value="mesin_dipakai"
                                                                                    {{ $machine->status == 'mesin_dipakae' ? 'selected' : '' }}>
                                                                                    Mesin Dipakai
                                                                                </option>
                                                                                <option value="mesin_dijual"
                                                                                    {{ $machine->status == 'mesin_dijual' ? 'selected' : '' }}>
                                                                                    Mesin Dijual
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Merk
                                                                                Mesin</label>
                                                                            <select name="brand_id" class="form-control"
                                                                                id="">
                                                                                <option value="" selected disabled>--
                                                                                    Pilih Merk
                                                                                    --
                                                                                </option>
                                                                                @foreach ($brands as $brand)
                                                                                    <option value="{{ $brand->id }}"
                                                                                        {{ $machine->brand_id == $brand->id ? 'selected' : '' }}>
                                                                                        {{ $brand->name_brand }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Jenis
                                                                                Mesin</label>
                                                                            <select name="type_id" class="form-control"
                                                                                id="">
                                                                                <option value="" selected disabled>--
                                                                                    Pilih Merk
                                                                                    --
                                                                                </option>
                                                                                @foreach ($types as $type)
                                                                                    <option value="{{ $type->id }}"
                                                                                        {{ $machine->type_id == $type->id ? 'selected' : '' }}>
                                                                                        {{ $type->type_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="#exampleModalDetailMachineCenter">
                                                        Detail
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalDetailMachineCenter"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalDetailMachineCenterTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Detail Mesin</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col-md-4"><strong>Barcode
                                                                                    ID</strong></div>
                                                                            <div class="col-md-8">:
                                                                                {{ $machine->barcode_id }}</div>

                                                                            <div class="col-md-4"><strong>Nama
                                                                                    Mesin</strong></div>
                                                                            <div class="col-md-8">: {{ $machine->name }}
                                                                            </div>

                                                                            <div class="col-md-4"><strong>Lokasi</strong>
                                                                            </div>
                                                                            <div class="col-md-8">:
                                                                                {{ @$machine->mutation->last()->location }}
                                                                            </div>

                                                                            <div class="col-md-4"><strong>Status</strong>
                                                                            </div>
                                                                            <div class="col-md-8">: {{ $machine->status }}
                                                                            </div>

                                                                            <div class="col-md-4"><strong>Merk</strong>
                                                                            </div>
                                                                            <div class="col-md-8">:
                                                                                {{ @$machine->brand->name_brand }}</div>

                                                                            <div class="col-md-4"><strong>Jenis</strong>
                                                                            </div>
                                                                            <div class="col-md-8">:
                                                                                {{ $machine->type->type_name }}</div>
                                                                        </div>
                                                                    </div>

                                                                    <h5 class="mt-2">Mutasi Mesin</h5>
                                                                    <table class="mt-2">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tanggal</th>
                                                                                <th>Lokasi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($machine->mutation as $mutation)
                                                                                <tr>
                                                                                    <td>{{ $mutation->created_at }}</td>
                                                                                    <td>{{ $mutation->location }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role == 'superadmin')
                                                        <a href="javascript:void(0)"
                                                            onclick="deleteAction('{{ $machine->barcode_id }}')"
                                                            class="btn btn-sm btn-danger">Delete</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $machines->links() }}
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteAction(barcode_id) {
            console.log(barcode_id);

            Swal.fire({
                title: "Kamu Serius?",
                text: `Data terkait akan ikut terhapus!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus ini!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('machine/delete') }}/" + barcode_id,
                        type: "POST",
                        data: {
                            barcode_id: barcode_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endsection
