<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'string', 'in:customer,executor'], // Убедитесь, что роль выбрана
            'company_name' => ['nullable', 'string'], // Убедитесь, что название компании задано только для customer
            'skills' => ['nullable', 'string'], // Навыки для исполнителей
            'services_category' => ['nullable', 'string'], // Категория услуг
            'services' => ['nullable', 'array'], // Список услуг для выбора
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'], // Сохраняем роль
            'company_name' => $input['role'] == 'customer' ? $input['company_name'] : null, // Сохраняем название компании, если роль customer
            'skills' => $input['role'] == 'executor' ? $input['skills'] : null, // Сохраняем навыки, если роль executor
            'services_category' => $input['services_category'], // Сохраняем категорию услуг
            'services' => json_encode($input['services'] ?? []), // Сохраняем выбранные услуги
        ]);
    }

}
