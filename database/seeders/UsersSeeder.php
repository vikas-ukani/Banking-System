<?php

namespace Database\Seeders;

use App\Models\Account;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Stripe API Initiate */
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'user list',
            'user create',
            'user edit',
            'user view',
            'user delete',
            'deposits',
            'withdrawals',
        ];

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin']);

        /** Creating Default Permissions and Assign Admin All Permissions */
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $role1->givePermissionTo($permission);
        }

        $role2 = Role::create(['name' => 'Support']);
        $role2->givePermissionTo('user list');
        $role2->givePermissionTo('user view');

        $role3 = Role::create(['name' => 'User']);
        $role3->givePermissionTo('user list');
        $role3->givePermissionTo('user create');
        $role3->givePermissionTo('user edit');
        $role3->givePermissionTo('user view');
        $role3->givePermissionTo('user delete');
        $role3->givePermissionTo('deposits');
        $role3->givePermissionTo('withdrawals');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create users
        $userData = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ];
        $user = \App\Models\User::factory()->create($userData);
        $user->assignRole($role1);
        /** Create User Stipe Account */
        $user->createAsStripeCustomer();
        $customer = \Stripe\Customer::create($userData);
        Account::create([
            'user_id' => $user->id,
            'balance' => 0,
            'customer_id' => $customer->id,
            'address1' => "Demo Address1",
            'address2' => "Demo Address2",
            'city' => "Surat",
            'state' => "Gujarat",
            'zip' => 395006,
        ]);

        /** Suppprt User */
        $userData = [
            'name' => 'Support User',
            'email' => 'support@gmail.com',
        ];
        $user = \App\Models\User::factory()->create($userData);
        $user->assignRole($role2);
        /** Create User Stipe Account */
        $user->createAsStripeCustomer();
        $customer = \Stripe\Customer::create($userData);
        Account::create([
            'user_id' => $user->id,
            'balance' => 0,
            'customer_id' => $customer->id,
            'address1' => "Demo Address1",
            'address2' => "Demo Address2",
            'city' => "Surat",
            'state' => "Gujarat",
            'zip' => 395006,
        ]);

        /** User */
        $userData = [
            'name' => 'User',
            'email' => 'user@gmail.com',
        ];
        $user = \App\Models\User::factory()->create($userData);
        $user->assignRole($role3);
        /** Create User Stipe Account */
        $user->createAsStripeCustomer();
        $customer = \Stripe\Customer::create($userData);
        Account::create([
            'user_id' => $user->id,
            'balance' => 0,
            'customer_id' => $customer->id,
            'address1' => "Demo Address1",
            'address2' => "Demo Address2",
            'city' => "Surat",
            'state' => "Gujarat",
            'zip' => 395006,
        ]);
    }
}
