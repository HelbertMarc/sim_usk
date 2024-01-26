@extends('layouts.user') @section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Pelanggaran &nbsp;
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#inppelanggaran">Tambah</button>
    </div>
    <div class="card-body">
        <form role="search" method="get" action="/guru/pelanggaran">
            @csrf Cari data &nbsp;
            <input
                type="text"
                name="search"
                class="form-control d- inline"
                id="search"
                placeholder="Masukkan NIS"
                maxlength="10"
                style="
                    width: 150px;

                    height: 32px;
                    border-radius: 4px;
                    -moz-border-radius: 4px;
                "
            />

            <button type="submit" class="btn btn-success btn-sm">Cari</button>
        </form>
        <br />
        @if ($data->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="datatablesSimple">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>NIS</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>ID Pelanggaran</th>
                        <th>Tanggal Pelanggaran</th>
                        <th>Isi Pelanggaran</th>
                        <th>Proses Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            @if($dt->foto && file_exists(public_path('foto/' .$dt->foto)))
                            <img src="{{asset('foto/'.$dt->foto)}}" class="rounded" style="width: 100px;" />
                            @else <img src="{{asset('no.image.png')}}" class="rounded" style="width: 100px;" /> @endif
                        </td>
                        <td>{{ $dt->nis }}</td>
                        <td>{{ $dt->siswa->nama }}</td>
                        <td>{{ $dt->siswa->kelas }}</td>
                        <td>{{ $dt->id_pelanggaran }}</td>
                        <td>{{ $dt->tgl_pelanggaran }}</td>
                        <td>{{ $dt->isi_pelanggaran }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah{{$dt->id}}">
                                Ubah
                            </button>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
data-bs-target="#hapus{{$dt->id}}">HApus</button>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Tidak ada Data</p>
        @endif
    </div>
</div>
<!-- Modal input Pelanggaran -->

<!-- Modal input Pelanggaran -->

<div class="modal fade" id="inppelanggaran" tabindex="-1" data-bs- backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            Created by Siswanto @2023 44

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggaran</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria- label="Close"></button>
            </div>
            <form id="create-depot-form" action="/guru/pelanggaran" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md">
                            Foto Preview:<br />
                            <img id="prevFoto" src="{{ asset('no-image.png')}}" class="rounded" style="width: 150px;" />

                            <input type="file" class="form-control" name="foto" id="image" />
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <div class="row g-1">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="idpel" placeholder="id pelanggaran" />

                                            <label for="floatingInputGrid">Id Pelanggaran:</label>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row g-2">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <select class="form-control" name="nis">
                                                <option> -- pilih nis --</option>
                                                @foreach ($dataSiswa as $nis)
                                                <option value="{{ $nis->nis }}" name="id"> {{ $nis->nis }} => {{$nis->nama}} {{$nis->kelas}}</option>

                                                @endforeach
                                            </select>
                                            <label for="floatingInputGrid">Nis:</label>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row g-1">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input min="2021-01-01" type="date" class="form-control" name="tgl" placeholder="tanggal pelanggaran" />
                                            <label for="floatingInputGrid">Tanggal Pelanggaran:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md">
                                <label>Isi Pelanggaran:</label>

                                Created by Siswanto @2023 45
                                <textarea class="form-control scrollable" rows="5" name="isi"></textarea>
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs- dismiss="modal">Tutup</button>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data as $dt) 
<!-- Modal Hapus -->

<div class="modal fade" id="hapus{{$dt->id}}" role="dialog" tabindex="-1" aria- labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pelanggaran</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria- label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">
                    Apakah anda yakin menghapus pelanggaran
                    <span><font color="blue">{{$dt->siswa->nama}} : {{$dt->isi_pelanggaran}}</font></span>
                </h4>
            </div>
            <div class="modal-footer">
                <form action="/guru/pelanggaran/{{$dt->id}}" method="POST">
                    @csrf @method('delete')

                    <button type="button" class="btn btn-secondary" data-bs- dismiss="modal">Tidak Jadi</button>

                    <button type="submit" class="btn btn-danger">Hapus!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah -->

<div class="modal fade" id="ubah{{$dt->id}}" role="dialog" tabindex="-1" aria- labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Pelanggaran</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria- label="Close"></button>
            </div>
            <form id="create-depot-form" action="/guru/pelanggaran/{{$dt->id}}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md">
                            Foto Preview:<br />
                            <img id="prevImg" src="{{asset('foto/'.$dt->foto)}}" class="rounded" style="width: 150px;" />

                            <input type="file" class="form-control" name="foto" id="ubahImg" />
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <div class="row g-1">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="idpel" value="{{$dt->id_pelanggaran}}" />

                                            <label for="floatingInputGrid">Id Pelanggaran:</label>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row g-2">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <select class="form-control" name="nis">
                                                <option value="{{ $dt->nis }}"> {{ $dt->nis }} {{$dt->siswa->nama}} {{$dt->siswa->kelas}}</option>
                                                @foreach ($dataSiswa as $nis)
                                                <option value="{{ $nis->nis }}" name="id"> {{ $nis->nis }} => {{$nis->nama}} {{$nis->kelas}}</option>

                                                @endforeach
                                            </select>
                                            <label for="floatingInputGrid">Nis:</label>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row g-1">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" name="tgl" value="{{$dt->tgl_pelanggaran->format('Y-m-d')}}" />

                                            <label for="floatingInputGrid">Tanggal Pelanggaran:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md">
                                <label>Isi Pelanggaran:</label>
                                @isset($dt)
                                <textarea class="form-control scrollable" name="isi" rows="5" required>{{$dt->isi_pelanggaran}}</textarea>

                                @else
                                <textarea class="form-control scrollable" name="isi" rows="5" required></textarea>
                                @endIf
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs- dismiss="modal">Tutup</button>

                    <button type="submit" class="btn btn-success">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
