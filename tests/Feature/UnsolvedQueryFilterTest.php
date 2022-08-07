<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Discussion;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\QueryFilters\UnsolvedQueryFilter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UnsolvedQueryFilterTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $disussions = Discussion::factory()
                    ->times(2)
                    ->state(new Sequence(['solved_at' => null], ['solved_at' => now()]))
                    ->create();

        $filter = new UnsolvedQueryFilter();

        $filtered = $filter->handle(Discussion::query(), fn ($builder) => $builder, 'true');

        $this->assertEquals(1, $filtered->count());
    }
}
