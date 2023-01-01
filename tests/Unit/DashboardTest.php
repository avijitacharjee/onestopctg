<?php

namespace Tests\Unit;

use App\Http\Controllers\DashboardController;
use App\Models\Customer;
use Tests\TestCase;

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
        // dump(array_column($dc->lastNMonths(7), 'number'));
        // dump($dc->lastNMonths(5));
        $this->assertTrue(true);
    }
    public function test_monthly_sales()
    {
        $dc = new DashboardController();
        // dump($dc->monthlySales());
        $this->assertTrue(true);
    }
    public function test_get_zones()
    {
        $dc = new DashboardController();
        $customers = Customer::select('zone')->distinct('zone')->get();
        $zones = array();
        foreach($customers as $customer){
            array_push($zones, $customer->zone);
        }
        dd($zones);
        $this->assertTrue(true);
    }
}
