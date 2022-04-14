<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
    ];
    
    public function projects()
    {
        return $this->belongsToMany(Project::class,'members_projects')
                ->withPivot('role', 'datestart');
    }
}
