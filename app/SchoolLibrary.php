<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolLibrary extends Model
{
    protected $table = 'collage_library';

    protected $fillable = ['id', 'UnitID', 'Branches_independent_libraries','Physical_books','Physical_media','Digital_electronic_databases','Digital_electronic_media','Total_library_collections','Has_an_academic_library','created_at', 'updated_at'];
    
    
}
