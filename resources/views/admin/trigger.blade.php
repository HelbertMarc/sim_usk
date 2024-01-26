@extends('layouts.user')
@section('content')
<div class="card mb-4">
<div class="card-header">
<i class="fas fa-table me-1"></i>
DataTable Trigger Pelanggaran
</div>
<div class="card-body">
@if ($data->isNotEmpty())
<div class="table-responsive">
<table class="table table-hover table-borderless" id="datatablesSimple">

<thead class="table-dark">
<tr>
<th>No</th>
<th>NIS</th>
<th>Tanggal</th>
<th>ID Pelanggaran</th>
</tr>
</thead>
<tbody>
<?php $no = 1; ?>
@foreach ($data as $dt)
<tr>
<td>{{ $no++ }}</td>
<td>{{ $dt->nis }}</td>
<td>{{ $dt->tanggal }}</td>
<td>{{ $dt->id_pelanggaran }}</td>
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
@endsection