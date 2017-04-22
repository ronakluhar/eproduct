<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolEndowment extends Model
{
    protected $table = 'college_endowment';

    protected $fillable = ['id', 'UnitID','Value_endowment_assets_at_beginning_of_fiscal_year_F2'
,'Value_endowment_assets_at_end_of_fiscal_year_F2'
,'Value_endowment_assets_at_beginning_of_fiscal_year_F1A'
,'Value_endowment_assets_at_end_of_fiscal_year_F1A','created_at', 'updated_at'];
    
    
}
