<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Store;
use Auth;

class AdminTest extends DuskTestCase
{
    /**
     * Tests the visibility of Admin navbar.
     *
     * @return void
     */
    public function testAdminNavbarVisible()
    {
       $this->browse(function ($browser){
           $browser->visit('/login')
                   ->type("email", 'kzabuk@gmail.com')
                   ->type("password", 'Chemistryforgood1')
                   ->press('Login')
                   ->assertPathIs('/')
                   ->visit('/')
                   ->waitFor('nav.navbar-admin')
                   ->assertPresent('.navbar-admin')
                   ->assertVisible('.navbar-admin');
       });
    }

    /**
    * Tests the admin navbar is not visible for regular users.
    *
    * @return void
    */
    public function testAdminNavbarNotVisible()
    {
      $user = factory(User::class)->create([
           'name' => 'Customer',
           'email' => 'customer@gmail.com',
           'password' => Hash::make('password'),
           'role_id' => null
       ]);



      $this->browse(function ($browser) use($user){
        $browser->loginAs(User::find($user->id))
                ->visit('/')
                ->assertMissing('.navbar-admin');
      });

      User::find($user->id)->delete();
    }

    /**
    * Tests if the store WOMEN is created.
    *
    * @return void
    */
    public function testStoreCreated()
    {
      $this->browse(function ($browser){
        $browser->loginAs(User::find(1))
                ->visit('/')
                ->waitFor('nav.navbar-admin')
                ->assertPresent('.navbar-admin')
                ->clickLink('Add store')
                ->assertPathIs('/store/create')
                ->waitFor('nav.navbar-admin')
                ->type('name', 'WOMEN')
                ->press('Submit');
      });
      $store = Store::where('name', 'WOMEN')->first();
      $this->assertNotNull($store);
      $store->delete();
    }
}
