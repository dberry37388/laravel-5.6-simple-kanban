<?php

namespace Tests\Unit;

use App\Issue;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IssueTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAnIssueHasACreator()
    {
        $issue = create(Issue::class);

        $this->assertInstanceOf(User::class, $issue->creator);
    }
}
