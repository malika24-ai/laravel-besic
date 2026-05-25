<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;

#[Fillable(['name', 'department_id'])]
class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department_id'];

    protected $with = ['department'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    #[Scope]
    protected function filter(builder $query, array $filters): void 
    {
    
        $query->when($filters['keyword'] ?? false, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->when($filters['department_id'] ?? false, function ($query, $department) {
            return $query->where('department_id', $department);
        });

    
    }
}