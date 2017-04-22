<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolDiversity extends Model
{
    protected $table = 'college_diversity';

    protected $fillable = ['id', 'UnitID','Grand_total'
,'Grand_total_men'
,'Grand_total_women'
,'American_Indian_or_Alaska_Native_total'
,'American_Indian_or_Alaska_Native_men'
,'American_Indian_or_Alaska_Native_women'
,'Asian_total'
,'Asian_men'
,'Asian_women'
,'Black_or_African_American_total'
,'Black_or_African_American_men'
,'Black_or_African_American_women'
,'Hispanic_total'
,'Hispanic_men'
,'Hispanic_women'
,'Native_Hawaiian_or_Other_Pacific_Islander_total'
,'Native_Hawaiian_or_Other_Pacific_Islander_men'
,'Native_Hawaiian_or_Other_Pacific_Islander_women'
,'White_total'
,'White_men'
,'White_women'
,'Two_or_more_races_total'
,'Two_or_more_races_men'
,'Two_or_more_races_women'
,'Race_ethnicity_unknown_total'
,'Race_ethnicity_unknown_men'
,'Race_ethnicity_unknown_women'
,'Nonresident_alien_total'
,'Nonresident_alien_men'
,'Nonresident_alien_women'
,'created_at', 'updated_at'];
    
    
}
