@extends('layouts.app')
@section('content')
<div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: #56b839;">
<div class="container">
<div class="row gx-lg-5 align-items-center">
<div class="col-lg-6 mb-5 mb-lg-0">
<h1 class="my-5 display-5 fw-bold ls-tight text-warning lato-bold" style="font-size: 55px">
Tentang Aplikasi <br />
<span style="color:rgb(255, 0, 0)">Pelanggaran Tata Tertib</span>
</h1>
<p class="lato-bold" style="color: hsl(231, 100%, 49%)">
Aplikasi ini dibuat untuk membantu guru BP/BK dalam mendata
serta mendokumentasikan segala bentuk pelanggaran tata tertib
yang terjadi di sekolah, sehingga memudahkan dalam penanganan
dan bisa lebih bisa meminimalisir bentuk-bentuk pelanggaran.
</p>
</div>
<div class="col-lg-6 mb-5 mb-lg-0">
<div class="card">
<div class="card-body py-5 px-md-5">
<h1 class="my-3 display-5 fw-bold ls-tight text-"color: hsl(231, 100%, 49%)" >
Login</h1>
<form action="" method="POST">
@csrf
<div class="form-outline mb-4">
<label class="form-label">Username</label>
<input type="text" name="username" value="{{old('username')}}"

class="form-control"/>
</div>
<div class="form-outline mb-4">
    <label class="form-label">Password</label>
<input type="password" name="password" class="form-control"/>
</div>
<!-- Submit button -->
<button type="submit" class="btn btn-primary btn-block mb-4">
Sign In
</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
    document.addEventListener("contextmenu", function(e){
    e.preventDefault();
    }, false);
    </script>
@endsection