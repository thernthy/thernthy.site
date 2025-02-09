<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteMeta extends Model
{
    protected $table = 'site_metas';
    protected $fillable = ['meta_key', 'meta_value', 'locale'];
}
