<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Pelanggaran extends Model
{
use HasFactory;
protected $guarded =['id'];
protected $table = 'pelanggaran';
public $timestamps =false;
protected $casts =[
'tgl_pelanggaran' =>'date',
];
public function siswa():BelongsTo
{
return $this->belongsTo(Siswa::class,'nis','nis');
}
public function tanggapan():HasMany
{
return $this->hasMany(Tanggapan::class,'id_pelanggaran','id_pelanggaran');
}
}