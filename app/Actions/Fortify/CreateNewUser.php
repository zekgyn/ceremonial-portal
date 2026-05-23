<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
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
        ])->validate();

        return User::create([
            'firstname' => $input['firstname'],
            'middlename' => $input['middlename'] ?? null,
            'lastname' => $input['lastname'],
            'phone' => $input['phone'] ?? null,
            'email' => $input['email'],
            'password' => $input['password'],
            'role' => $input['role'],
        ]);
    }
}
