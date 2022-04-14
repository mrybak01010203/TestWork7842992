<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'lang'
    ];
    
    public function members()
    {
        return $this->belongsToMany(Member::class,'members_projects')
                ->withPivot('role', 'datestart');
    }
}
