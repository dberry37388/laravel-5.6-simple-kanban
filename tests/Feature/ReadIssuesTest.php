<?php

namespace Tests\Feature;

use App\Issue;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadIssuesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Issue
     */
    protected $issue;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->issue = create(Issue::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGuestsMayNotBrowseIssues()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('issuesIndex'));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGuestsMayNotViewSingleIssues()
    {
        $this->expectException(AuthenticationException::class);

        $issue = create(Issue::class);

        $this->get(route('showIssue', $issue));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUsersCanBrowseIssues()
    {
        $this->signIn();

        $this->get(route('issuesIndex'))
            ->assertSee($this->issue->title);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUsersCanViewIssues()
    {
        $this->signIn();

        $this->get(route('showIssue', $this->issue))
            ->assertSee($this->issue->title)
            ->assertSee($this->issue->description);

    }
}
