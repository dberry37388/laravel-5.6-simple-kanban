<?php

namespace Tests\Feature;

use App\Issue;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageIssuesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a guest (unauthenticated user) may not
     * create a new issue.
     *
     * @return void
     */
    public function testAGuestMayNotCreateANewIssue()
    {
        $this->expectException(AuthenticationException::class);

        $issue = make(Issue::class);

        $this->post(route('storeIssue'), $issue->toArray());
    }

    /**
     * Tests that an authorized user can create issues.
     *
     * @return void
     */
    public function testAnAuthorizedUserCanCreateIssues()
    {
        $this->signIn();

        $issue = make(Issue::class);

        $response = $this->post(route('storeIssue'), $issue->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($issue->title)
            ->assertSee($issue->description);
    }

    /**
     * Tests than an issue requires a title
     *
     * @return void
     */
    public function testAnIssueRequiresATitle()
    {
        $this->withExceptionHandling()
            ->signIn();

        $this->createIssue(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * Tests than an issue requires a title
     *
     * @return void
     */
    public function testAnIssueRequiresADescription()
    {
        $this->withExceptionHandling()
            ->signIn();

        $this->createIssue(['description' => null])
            ->assertSessionHasErrors('description');
    }

    /**
     * Tests than an unauthorized user may not delete issues.
     * These are users who are either not logged in or do not
     * meet the authorization criterion.
     *
     * @return void
     */
    public function testUnauthorizedUsersMayNotDeleteIssues()
    {
        $this->withExceptionHandling();

        $issue = create(Issue::class);

        $this->delete(route('deleteIssue', $issue))
            ->assertRedirect('login');

        $this->signIn();

        $this->delete(route('deleteIssue', $issue))
            ->assertStatus(403);
    }

    /**
     * Tests that an authorized user can delete issues.
     *
     * @return void
     */
    public function testAnAuthorizedUserCanDeleteIssues()
    {
        $this->signIn();

        $issue = create(Issue::class, ['user_id' => auth()->id()]);

        $this->delete(route('deleteIssue', $issue));

        $this->assertDatabaseMissing('issues', ['id' => $issue->id]);
    }
    
    /**
     * Tests than an unauthorized user may not update issues.
     * These are users who are either not logged in or do not
     * meet the authorization criterion.
     *
     * @return void
     */
    public function testUnauthorizedUsersMayNotUpdateIssues()
    {
        $this->withExceptionHandling();

        $issue = create(Issue::class);

        $newValues = ['title' => 'New Title', 'description' => 'New Description'];

        $this->put(route('updateIssue', $issue), $newValues)
            ->assertRedirect('login');

        $this->signIn();

        $this->put(route('updateIssue', $issue), $newValues)
            ->assertStatus(403);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthorizesUsersCanUpdateIssues()
    {
        $this->signIn();

        $issue = create(Issue::class, ['user_id' => auth()->id()]);

        $newValues = ['title' => 'New Title', 'description' => 'New Description'];

        $response = $this->put(route('updateIssue', $issue), $newValues);

        $this->get($response->headers->get('Location'))
            ->assertSee($newValues['title'])
            ->assertSee($newValues['description']);

    }

    /**
     * Creates a New Issue with overrides.
     *
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function createIssue(array $overrides)
    {
        $issue = make(Issue::class, $overrides);

        return $this->post(route('storeIssue'), $issue->toArray());
    }
}
