<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolTuitionFeesDetail extends Model {

    protected $table = 'college_tuition_fees';
    protected $fillable = [
        'id',
        'UnitID',
        'Published_in-state_tuition_2015-16',
        'Published_in-state_fees_2015-16',
        'Published_in-state_tuition_2014-15',
        'Published_in-state_fees_2014-15',
        'Published_in-state_tuition_2013-14',
        'Published_in-state_fees_2013-14',
        'Published_out-of-state_tuition_2015-16',
        'Published_out-of-state_fees_2015-16',
        'Published_out-of-state_tuition_2014-15',
        'Published_out-of-state_fees_2014-15',
        'Published_out-of-state_tuition_2013-14',
        'Published_out-of-state_fees_2013-14',
        'Full-time_first-time_degree-seeking_students_live_campus',
        'Institution_provide_on-campus_housing',
        'Total_dormitory_capacity',
        'Institution_provides_board_or_meal_plan',
        'Number_of_meals_per_week_in_board_charge',
        'Undergraduate_application_fee',
        'Graduate_application_fee',
        'Books_and_supplies_2015-16',
        'On_campus_room_and_board_2015-16',
        'On_campus_other_expenses_2015-16',
        'Off_campus_(NWF)_room_and_board_2015-16',
        'Off_campus_(NWF)_other_expenses_2015-16',
        'created_at',
        'updated_at'
    ];

}
