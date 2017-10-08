<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class LogAdminActivity extends Model
{
//    use SoftDeletes;
	
    protected $table = 'log_admin_activities';

    protected $guarded = ['id'];

    /**
     * Get the user responsible for the given activity.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject of the activity.
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get the latest activities on the site
     * @return mixed
     */
    static public function getLatest($limit = '100')
    {
		// SUPPRESSION AUTOMATIQUE
		$count = self::count();
		if($count >= $limit) { self::truncate($limit); }
		
        return self::with('user')
            ->with('subject')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();
    }
	
}