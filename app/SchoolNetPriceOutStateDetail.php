<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolNetPriceOutStateDetail extends Model {

    protected $table = 'college_net_price_outstate';
    protected $fillable = [
        'id',
        'UnitID',
        'ANP_ST_AWR_grant_or_scholarship_aid_2014_15',
        'ANP_ST_AWR_grant_or_scholarship_aid_2013_14',
        'ANP_ST_AWR_grant_or_scholarship_aid_2012_13',
        'ANP(0-30000)_ST_AWR_TIV_FFA2014_15',
        'ANP(30001-48000)_ST_AWR_TIV_FFA_2014_15',
        'ANP(48001-75000)_ST_AWR_TIV_FFA_2014_15',
        'ANP(75001-110000)_ST_AWR_TIV_FFA_2014_15',
        'ANP(over_110000)_ST_AWR_TIV_FFA_2014_15',
        'ANP(0-30000)_ST_AWR_TIV_FFA_2013_14',
        'ANP(30001-48000)_ST_AWR_TIV_FFA_2013_14',
        'ANP(48001-75000)_ST_AWR_TIV_FFA_2013_14',
        'ANP(75001-110000)_ST_AWR_TIV_FFA_2013_14',
        'ANP(over_110000)_ST_AWR_TIV_FFA_2013_14',
        'ANP(0-30000)_ST_AWR_TIV_FFA_2012_13',
        'ANP(30001-48000)_ST_AWR_TIV_FFA_2012_13',
        'ANP(48001-75000)_ST_AWR_TIV_FFA_2012_13',
        'ANP(75001-110000)_ST_AWR_TIV_FFA_2012_13',
        'ANP(over_110000)_ST_AWR_TIV_FFA_2012_13',
        'created_at',
        'updated_at'
    ];

}
