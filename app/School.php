<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model {

    protected $table = 'collage_quick_facts';
    protected $fillable = ['id', 'UnitID', 'Institution_Name', 'Institution_alias', 'Post_office_box', 'City', 'State', 'ZIP_code', 'Name_chief_administrator',
        'Title_chief_administrator', 'General_information_number', 'Internet_web_address', 'Financial_web_address', 'Admissions_office_web_address', 'Online_application_web_address',
        'Net_price_calculator_web_address', 'Veteran_Military_web_address', 'County_name', 'Longitude', 'Latitude', 'Open_to_general_public', 'Status_of_institution',
        'Control_of_institution', 'Carnegie_Classification', 'Religious_Affiliation', 'Historically_Black_College', 'Tribal_college',
        'Degree_of_urbanization', 'Institution_size_category', 'Credit_for_life_experiences', 'Advanced_placement_AP_credits', 'created_at', 'updated_at', 'deleted'];

}
