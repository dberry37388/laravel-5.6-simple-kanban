<?php

namespace Tests\Unit;

use App\Issue;
use App\Lane;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaneTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAnLaneHasACreator()
    {
        $lane = create(Lane::class);

        $this->assertInstanceOf(User::class, $lane->creator);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAnLaneHasIssues()
    {
        $lane = create(Lane::class);

        $this->assertContainsOnlyInstancesOf(Issue::class, $lane->issues);
    }
}
