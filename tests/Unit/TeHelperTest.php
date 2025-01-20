<?php 

namespace Tests\Unit;

use Tests\TestCase;
use Carbon\Carbon;
use App\Helpers\TeHelper;

class TeHelperTest extends TestCase
{
    /**
     * Test willExpireAt function when the difference is less than or equal to 90 hours.
     *
     * @return void
     */
    public function testWillExpireAtForLessThanOrEqualTo90Hours()
    {
        $due_time = Carbon::now()->addHours(80);
        $created_at = Carbon::now();

        $expected = $due_time->format('Y-m-d H:i:s');
        $actual = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test willExpireAt function when the difference is between 91 and 24 hours.
     *
     * @return void
     */
    public function testWillExpireAtForBetween91And24Hours()
    {
        $due_time = Carbon::now()->addHours(100);
        $created_at = Carbon::now();

        $expected = $created_at->addMinutes(90)->format('Y-m-d H:i:s');
        $actual = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test willExpireAt function when the difference is between 25 and 72 hours.
     *
     * @return void
     */
    public function testWillExpireAtForBetween25And72Hours()
    {
        $due_time = Carbon::now()->addHours(60);
        $created_at = Carbon::now();

        $expected = $created_at->addHours(16)->format('Y-m-d H:i:s');
        $actual = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test willExpireAt function when the difference is greater than 72 hours.
     *
     * @return void
     */
    public function testWillExpireAtForGreaterThan72Hours()
    {
        $due_time = Carbon::now()->addHours(100);
        $created_at = Carbon::now();

        $expected = $due_time->subHours(48)->format('Y-m-d H:i:s');
        $actual = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $actual);
    }
}
