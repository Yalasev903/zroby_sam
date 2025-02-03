<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Intervention\Image\Facades\Image;

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
        // Валидация данных
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'string', 'in:customer,executor'],
            'city' => ['required', 'string', 'max:255'], // Поле для города
            'profile_photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'], // Поле для аватара
            'company_name' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'services_category' => ['nullable', 'string'],
            'services' => ['nullable', 'array'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Сохранение аватара
        $avatarPath = null;
        if (isset($input['profile_photo_path'])) {
            try {
                $avatar = $input['profile_photo_path'];

                // Дополнительно можно использовать Intervention/Image для изменения размера
                $resizedImage = Image::make($avatar)
                    ->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('webp', 90); // Конвертация в WebP

                // Сохранение обработанного изображения
                $avatarPath = 'avatars/' . uniqid() . '.webp';
                Storage::disk('public')->put($avatarPath, $resizedImage);
            } catch (\Exception $e) {
                throw new \RuntimeException('Ошибка при загрузке изображения: ' . $e->getMessage());
            }
        }

        // Создание пользователя с сохранением пути к аватару
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
            'city' => $input['city'],
            'profile_photo_path' => $avatarPath, // Сохранение пути к аватару
            'company_name' => $input['role'] === 'customer' ? $input['company_name'] : null,
            'skills' => $input['role'] === 'executor' ? $input['skills'] : null,
            'services_category' => $input['services_category'],
            'services' => json_encode($input['services'] ?? []),
            'rating' => 0,
        ]);
    }
}
