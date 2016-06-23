<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function admin_updates_employee_time()
    {
        $user = factory(App\Models\User::class)->create(['admin' => 1]);
        $time = factory(App\Models\Time::class)->create(['user_id' => $user->id, 'workDate' => '2016-05-05']);
        Auth::loginUsingId($user->id);
        $this->visit('/admin')
             ->type($time->workDate, 'workDate')
             ->type(10, 'regularHours')
             ->type(5, 'overtimeHours')
             ->press('Update');
        $this->seeInDatabase('appTime', [
            'user_id' => $user->id,
            'workDate' => $time->workDate,
        ]);
    }

    /**
     * @test
     */
    public function admin_adds_new_employee()
    {
        $user = factory(App\Models\User::class)->create(['admin' => 1]);
        Auth::loginUsingId($user->id);
        $this->visit('/admin')
             ->type('johndoe', 'username')
             ->type('password', 'password')
             ->type(127.5, 'regularRate')
             ->type(155, 'overtimeRate')
             ->press('Create');
        $this->seeInDatabase('appUser', [
            'username' => 'johndoe',
            'regularRate' => 127.5,
            'overtimeRate' => 155,
        ]);
    }

    /**
     * @test
     */
    public function admin_updates_employee_rates()
    {
        $admin = factory(App\Models\User::class)->create(['admin' => 1]);
        $user = factory(App\Models\User::class)->create();
        Auth::loginUsingId($admin->id);
        $this->visit('/admin')
             ->select($user->id, 'employee')
             ->type(159.75, 'regularRate')
             ->type(202.1, 'overtimeRate')
             ->press('Save');
        $this->seeInDatabase('appUser', [
            'id' => $user->id,
            'regularRate' => 159.75,
            'overtimeRate' => 202.1,
        ]);
    }
}
