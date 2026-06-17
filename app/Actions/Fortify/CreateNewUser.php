<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
            'role' => ['required', Rule::in(['client', 'vendor'])],
            'city' => ['required', 'string', 'max:20'],
        ])->validate();

       return DB::transaction(function() use($input){
            $user = User::create([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'password' => $input['password'],
                'role' => $input['role'],
                'city' => $input['city'],
            ]);

            if ($input['role'] === 'vendor') {
                $user->vendor()->create([
                    'business_name' => $input['business_name'],
                    'description' => $input['description'],
                    'category' => $input['category'],
                    'location' => $input['city']
                ]);
            }
            return $user;
       });
    }
}
