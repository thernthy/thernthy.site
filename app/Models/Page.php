<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    protected $table = 'pages';
    protected $primaryKey = 'page_id';
    protected $fillable = ['page_name','page_url', 'root_path', 'page_slug', 'locale', 'page_body', 'status',];
    public static function getPageContent($slug, $locale) {
        return self::where('page_slug', $slug)
                   ->where('locale', $locale)
                   ->first();
    }
}

