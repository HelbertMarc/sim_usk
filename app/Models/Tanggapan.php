<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Tanggapan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tanggapan';
    public $timestamps = false;
    protected $casts = [
        'tgl_tanggapan' => 'date',
    ];
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }
    public function pelanggaran(): BelongsTo
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}
