<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issues\CreateIssueRequest;
use App\Http\Requests\Issues\UpdateIssueRequest;
use App\Issue;

class IssueController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response(Issue::paginate(10), 201);
        }

        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Issues\CreateIssueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIssueRequest $request)
    {
        $issue = Issue::create([
            'user_id' => auth()->id(),
            'lane_id' => $request->lane_id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        flash("Issue #{$issue->id} was created.");

        return redirect(route('showIssue', $issue));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        return view('issues.edit', compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Issues\UpdateIssueRequest $request
     * @param \App\Issue $issue
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        $this->authorize('update', $issue);

        $issue->update($request->validated());

        flash("Issue #{$issue->id} was updated.");

        return redirect(route('showIssue', $issue));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Issue $issue
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Issue $issue)
    {
        $this->authorize('delete', $issue);

        try {
            $issue->delete();
        } catch (\Exception $e) {
        }

        flash('Issue was deleted.');

        return redirect(route('issuesIndex'));
    }
}
