<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    protected $table = 'pages';
    protected $primaryKey = 'page_id';
    protected $fillable = ['page_slug', 'page_url', 'page_body', 'locale', 'status'];
    public static function getPageContent($slug, $locale) {
        return self::where('page_slug', $slug)
                   ->where('locale', $locale)
                   ->first();
    }
}

