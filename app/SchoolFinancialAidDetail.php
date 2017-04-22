<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolFinancialAidDetail extends Model
{
    protected $table = 'college_financial_aid';
    protected $fillable = [
        'id',
        'UnitID',
        'Total_FTFTU_financial_aid_cohort',
        'Percent_of_FTFTU_awarded_financial_aid',
        'Percent_awarded_loans/grants_from_fed/state/local/school',
        'Percent_FTFTU_awarded_fed/state/local/school_Aid',
        'Average_amount_fed/state/local_or_IntAid_awarded',
        'Percent_FTFTU_awarded_fed_grant_aid',
        'Average_amount_fed_grant_aid_awarded_to_FTFTU',
        'Percent_FTFTU_awarded_Pell_grants',
        'Average_amount_of_Pell_grant_aid_awarded_to_FTFTU',
        'Percent_FTFTU_awarded_other_fed_grant_aid',
        'Average_amount_of_other_fed_grant_aid_awarded_to_FTFTU',
        'Percent_of_FTFTU_awarded_state/local_grant_aid',
        'Average_amount_state/local_grant_aid_awarded_to_FTFTU',
        'Percent_of_FTFTU_awarded_Int_Aid',
        'Average_amount_of_Int_Aid_awarded_to_FTFTU',
        'Percent_of_FTFTU_awarded_student_loans',
        'Average_amount_of_student_loans_awarded_to_FTFTU',
        'Percent_of_FTFTU_awarded_fed_student_loans',
        'Average_amount_of_fed_student_loans_awarded_to_FTFTU',
        'Percent_of_FTFTU_awarded_other_student_loans',
        'Average_amount_of_other_student_loans_awarded_to_FTFTU',
        'Total_financial_aid_cohort',
        'Percent_awarded_fed/state/local/institutional_or_other_aid',
        'Average_fed/state/local/institutional_aid_awarded_to_ug_students',
        'Percent_of_undergraduate_students_awarded_Pell_grants',
        'Average_amount_Pell_grant_aid_awarded',
        'Percent_awarded_fed_student_loans',
        'Average_fed_student_loans_awarded',
        'created_at',
        'updated_at'
    ];
}
