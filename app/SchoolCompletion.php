<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolCompletion extends Model
{
    protected $table = 'college_completions';

    protected $fillable = ['id', 'UnitID', 'Agriculture_Operations_and_Related_Sciences','Natural_Resources_and_Conservation','Architecture_and_Related_Services','Area_Ethnic_Cultural_Gender_Group_Studies',
        'Communication_Journalism_and_Related_Programs','Communications_Technologies_and_Support_Services','Computer_and_Information_Sciences_and_Support_Services',
        'Personal_and_Culinary_Services','Education','Engineering','Engineering_Technologies_and_Engineering_related_Fields','Foreign_Languages_Literature_and_Linguistics',
        'Family_and_Consumer_Sciences_Sciences','Legal_Professions_and_Studies','English_Language_and_Literature','Liberal_Arts_and_Sciences_General_Studies_and_Humanities','Library_Science',
        'Biological_and_Biomedical_Sciences','Mathematics_and_Statistics','Military_Technologies_and_Applied_Sciences','Multi_Interdisciplinary_Studies','Parks_Recreation_Leisure_and_Fitness_Studies',
        'Philosophy_and_Religious_Studies','Theology_and_Religious_Vocations','Physical_Sciences','Science_Technologies','Psychology','Homeland_Security_Law_Enforcement_Firefight_Protective_Service',
        'Public_Administration_and_Social_Service_Professions','Social_Sciences','Construction_Trades','Mechanic_and_Repair_Technologies','Precision_Production','Transportation_and_Materials_Moving',
        'Visual_and_Performing_Arts','Health_Professions_and_Related_Programs','Business_Management_Marketing_Related_Support_Services','History','created_at', 'updated_at'];
    
    
}
