<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class d_hcustommer extends Model
{
    protected $table = 'd_customerremovable';
    protected $fillable = ['cr_id','cr_serial','cr_plate','cr_typecar','cr_jobdesc','cr_dateservice','cr_serviceadvisor','cr_direct','cr_code','status_data'];
    public $timestamps = false;

}
