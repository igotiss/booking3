<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function  test_login_form()
    {
       $response = $this->get('/login');
       $response->assertStatus(200);
    }

    public function test_register_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'Ivan Tarasov',
            'email' => 'ivantarasov@gmail.com'
        ]);
        $user2 = User::make([
            'name' => 'Vlad',
            'email' => 'vlad@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_store_new_users()
    {

        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->store();
        }

        $this->assertTrue(true);
    }

    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_databese()
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'Vasyl'
        ]);
    }

}
