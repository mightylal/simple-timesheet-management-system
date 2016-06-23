<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminReportsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function admin_generates_report()
    {
        $user = factory(App\Models\User::class)->create(['admin' => 1]);
        Auth::loginUsingId($user->id);
        $this->visit('admin/reports')
             ->select(0, 'employee')
             ->type('2016-05-05', 'startDate')
             ->type('2016-05-06', 'endDate')
             ->press('Generate');
        $this->see('Employee Wages');
    }
}
