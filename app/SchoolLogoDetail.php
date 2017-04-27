<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\School;
use DB;
use Config;

class SchoolLogoDetail extends Model {

    protected $table = 'collage_logo';
    protected $fillable = [
        'id',
        'UnitID',
        'image_path',
        'created_at',
        'updated_at',
        'deleted'
    ];

    /**
     * Get the school data that owns the logo.
     */
    public function school() {
        return $this->belongsTo('App\School', 'UnitID', 'UnitID')->where('deleted', '<>', Config::get('constant.DELETED_FLAG'));
    }

    public function get_logo_detail() {
        $school_logo = DB::table('collage_logo')
                ->leftJoin('collage_quick_facts', 'collage_quick_facts.UnitID', '=', 'collage_logo.UnitID')
                ->where('collage_quick_facts.deleted', '<>', Config::get('constant.DELETED_FLAG'))
                ->where('collage_logo.deleted', '<>', Config::get('constant.DELETED_FLAG'))
                ->get([
            'collage_logo.UnitID',
            'collage_logo.image_path',
            'collage_logo.deleted',
            'collage_quick_facts.Institution_Name'
        ]);
        return $school_logo;
    }

    public function delete_logo($unit_id) {
        $delete_logo = DB::table('collage_logo')->where('UnitID', $unit_id)->update(['deleted' => 3]);

        return $delete_logo;
    }

}
