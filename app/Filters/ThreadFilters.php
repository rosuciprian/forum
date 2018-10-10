<?php

namespace App\Filters;

use App\User;

use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
	protected $filters = ['by', 'popularity'];

	/**
	 * Filter the query by a given username
	 *
	 * @param string $username
	 * @return mixed
	 */
	protected function by( $username ) {
		$user = User::where( 'name', $username )->firstOrFail();
		return $this->builder->where( 'user_id', $user->id );
	}

	/**
	 * Filter the query according to most popular threads
	 *
	 * @return mixed
	 */
	protected function popularity()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}
}