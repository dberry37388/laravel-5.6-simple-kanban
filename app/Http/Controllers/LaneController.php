<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lanes\CreateLaneRequest;
use App\Http\Requests\Lanes\UpdateLaneRequest;
use App\Issue;
use App\Lane;
use Illuminate\Http\Request;

class LaneController extends Controller
{
    /**
     * IssueController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lanes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Lanes\CreateLaneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLaneRequest $request)
    {
        $lane = Lane::create([
            'user_id' => auth()->id(),
            'title' => $request->title
        ]);

        flash("Lane ({$lane->title}} was created");

        return redirect(route('showLane', $lane));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lane  $lane
     * @return \Illuminate\Http\Response
     */
    public function show(Lane $lane)
    {
        $lane->with('issues');

        return view('lanes.show', compact('lane'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lane  $lane
     * @return \Illuminate\Http\Response
     */
    public function edit(Lane $lane)
    {
        return view('lanes.edit', compact('lane'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Lanes\UpdateLaneRequest $request
     * @param  \App\Lane $lane
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateLaneRequest $request, Lane $lane)
    {
        $this->authorize('update', $lane);

        $lane->update($request->validated());

        flash("Issue #{$lane->id} was updated.");

        return redirect(route('showLane', $lane));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lane $lane
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Lane $lane)
    {
        $this->authorize('delete', $lane);

        try {
            $lane->delete();
        } catch (\Exception $e) {
        }

        flash('Lane was deleted.');

        return redirect(route('laneIndex'));
    }
}
