<?php

namespace Tests\Unit;

use App\Http\Controllers\DashboardController;
use PHPUnit\Framework\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_last_n_months()
    {
        $dc = new DashboardController();
        dd($dc->lastNMonths(7));
        $this->assertTrue(true);
    }
}
