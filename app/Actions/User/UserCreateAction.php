<?php

namespace App\Actions\User;

use App\Models\Account;
use App\Models\Role;
use App\Models\User;

class UserCreateAction
{

    /**
     * Create User Action
     *
     * @param array $request
     * @return User
     */
    public function handle($input): User
    {
        /** Stripe API Initiate */
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = User::create(
            [
                'name' => $input['name'],
                'email' => $input['email'],
                'social_id' => $input['social_id'],
                'auth_type' => $input['auth_type'],
                'password' => encrypt($input['password'])
            ]
        );
        $user->assignRole([Role::where('name', 'User')->first()]);
        /** Create User Stipe Account */
        $userData = [
            'name' => $input['name'],
            'email' => $input['email']
        ];
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
        return $user;
    }
}
