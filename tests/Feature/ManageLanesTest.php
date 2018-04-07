<?php

namespace Tests\Feature;

use App\Lane;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageLanesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a guest (unauthenticated user) may not
     * create a new lane.
     *
     * @return void
     */
    public function testAGuestMayNotCreateLanes()
    {
        $this->expectException(AuthenticationException::class);

        $lane = make(Lane::class);

        $this->post(route('storeLane'), $lane->toArray());
    }

    /**
     * Tests that an authorized user can create lanes.
     *
     * @return void
     */
    public function testAnAuthenticateddUserCanCreateIssues()
    {
        $this->signIn();

        $lane = make(Lane::class);

        $response = $this->post(route('storeLane'), $lane->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($lane->title);
    }

    /**
     * Tests that a lane requires a title.
     *
     * @return void
     */
    public function testALaneRequiresATitle()
    {
        $this->withExceptionHandling()
            ->signIn();

        $lane = make(Lane::class, ['title' => null]);

        $this->post(route('storeLane'), $lane->toArray())
            ->assertSessionHasErrors('title');
    }

    /**
     * Tests than an unauthorized user may not delete lanes.
     * These are users who are either not logged in or do not
     * meet the authorization criterion.
     *
     * @return void
     */
    public function testUnauthorizedUsersMayNotDeleteLanes()
    {
        $this->withExceptionHandling();

        $lane = create(Lane::class);

        $this->delete(route('deleteLane', $lane))
            ->assertRedirect('login');

        $this->signIn();

        $this->delete(route('deleteLane', $lane))
            ->assertStatus(403);
    }

    /**
     * Tests that an authorized user can delete lanes.
     *
     * @return void
     */
    public function testAnAuthorizedUserCanDeleteLanes()
    {
        $this->signIn();

        $lane = create(Lane::class, ['user_id' => auth()->id()]);

        $this->delete(route('deleteLane', $lane));

        $this->assertDatabaseMissing('lanes', ['id' => $lane->id]);
    }

    /**
     * Tests than an unauthorized user may not update issues.
     * These are users who are either not logged in or do not
     * meet the authorization criterion.
     *
     * @return void
     */
    public function testUnauthorizedUsersMayNotUpdateLanes()
    {
        $this->withExceptionHandling();

        $lane = create(Lane::class);

        $newValues = ['title' => 'New Title'];

        $this->put(route('updateLane', $lane), $newValues)
            ->assertRedirect('login');

        $this->signIn();

        $this->put(route('updateLane', $lane), $newValues)
            ->assertStatus(403);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthorizesUsersCanUpdateLanes()
    {
        $this->signIn();

        $lane = create(Lane::class, ['user_id' => auth()->id()]);

        $newValues = ['title' => 'New Title'];

        $response = $this->put(route('updateLane', $lane), $newValues);

        $this->get($response->headers->get('Location'))
            ->assertSee($newValues['title']);

    }
}
