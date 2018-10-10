<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	use RecordsActivity;

	protected $guarded = [];

	protected $with = ['creator', 'channel'];

	/**
	 * For all the queries for Thread, we need to make sure
	 * that we fetch the replies count
	 */
	protected static function boot()
	{
		parent::boot();

		static::addGLobalScope('replyCount', function ($builder) {
			$builder->withCount('replies');
		});

		static::deleting(function ($thread) {
			$thread->replies->each->delete();
		});
	}

	public function path()
    {
    	return "/threads/{$this->channel->slug}/{$this->id}";
    }

	public function replies()
    {
	    return $this->hasMany( Reply::class );
    }

	public function creator()
    {
	    return $this->belongsTo( User::class, 'user_id' );
    }

	public function channel()
	{
		return $this->belongsTo( Channel::class );
	}

	public function addReply( $reply )
	{
		return $this->replies()->create($reply);
	}

	public function scopeFilter( $query, $filters )
	{
		return $filters->apply($query);
	}
}