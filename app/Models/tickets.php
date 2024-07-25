<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tickets extends Model
{
    use HasFactory;

    const CATEGORY = ['category1', 'category2', 'category3'];
    const URGENT_LEVEL = ['level1', 'level2', 'level3'];

    protected $fillable = [
        'company',
        'contact_person',
        'product', // ubah menjadi product_id untuk konsistensi dengan relasi
        'version_program',
        'module', // ubah menjadi module_id untuk konsistensi dengan relasi
        'category',
        'urgent_level',
        'database_name',
        'date',
        'problem',
        'attachment',
        'assign_to',
        'assign_to_supervisor',
        'estimation_complation_date',
        'program_version',
        'technical_note',
        'is_done'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(clients::class, 'company');
    }

    public function producted(): BelongsTo
    {
        return $this->belongsTo(products::class, 'product'); // gunakan product_id
    }

    public function assignToSupervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assign_to_supervisor');
    }

    public function assignTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function moduled(): BelongsTo
    {
        return $this->belongsTo(modules::class, 'module'); // gunakan module_id
    }

    public $timestamps = true;
}
