<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;

class ThreadsController extends Controller
{
	public function __construct ()
	{
	    $this->middleware('auth')->except( ['index', 'show'] );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Channel $channel
	 *
	 * @param ThreadFilters $filters
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index( Channel $channel, ThreadFilters $filters)
    {
	    $threads = $this->getThreads( $channel, $filters );

	    if ( request()->wantsJson() ) {
	    	return $threads;
	    }

//	    $threads = $threads->get();

        return view( 'threads.index', compact( 'threads' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title'         => 'required',
		    'body'          => 'required',
		    'channel_id'    => 'required|exists:channels,id'
	    ]);

        $thread = Thread::create([
        	'user_id'       => auth()->id(),
        	'channel_id'    => request( 'channel_id' ),
        	'title'         => request('title' ),
        	'body'          => request('body' ),
        ]);

        return redirect( $thread->path() )
	        ->with('flash', 'Your thread has been published!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
	    return view( 'threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $channel
	 * @param  \App\Thread $thread
	 *
	 * @return void
	 * @throws \Exception
	 */
    public function destroy($channel, Thread $thread)
    {
    	$this->authorize('update', $thread);

        $thread->delete();

        if( request()->wantsJson() ) {
            return response([], 204);
        }

        return redirect('/threads');
    }

	public function addReply()
    {

    }

	/**
	 * @param Channel $channel
	 * @param ThreadFilters $filters
	 *
	 * @return mixed
	 */
	public function getThreads( Channel $channel, ThreadFilters $filters ) {
		$threads = Thread::latest()->filter( $filters );

		if ( $channel->exists ) {
			$threads->where( 'channel_id', $channel->id );
		}

		return $threads->get();
	}
}