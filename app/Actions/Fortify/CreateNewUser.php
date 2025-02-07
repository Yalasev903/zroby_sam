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
        'name'               => ['required', 'string', 'max:255'],
        'email'              => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password'           => $this->passwordRules(),
        'role'               => ['required', 'string', 'in:customer,executor'],
        'city'               => ['required', 'string', 'max:255'],
        'profile_photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        'company_name'       => ['nullable', 'string'],
        'skills'             => ['nullable', 'string'],
        'services_category'  => ['required', 'exists:services_category,id'],
        'services'           => ['required', 'array', 'min:1'],
        'services.*'         => ['exists:services,id'],
        'terms'              => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    // Обработка загрузки аватара (код оставляем без изменений)
    $avatarPath = null;
    if (isset($input['profile_photo_path'])) {
        try {
            $avatar = $input['profile_photo_path'];
            $resizedImage = Image::make($avatar)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('webp', 90);
            $avatarPath = 'avatars/' . uniqid() . '.webp';
            Storage::disk('public')->put($avatarPath, $resizedImage);
        } catch (\Exception $e) {
            throw new \RuntimeException('Ошибка при загрузке изображения: ' . $e->getMessage());
        }
    }

    // Создание пользователя
    return User::create([
        'name'               => $input['name'],
        'email'              => $input['email'],
        'password'           => Hash::make($input['password']),
        'role'               => $input['role'],
        'city'               => $input['city'],
        'profile_photo_path' => $avatarPath,
        'company_name'       => $input['role'] === 'customer' ? $input['company_name'] : null,
        'skills'             => $input['role'] === 'executor' ? $input['skills'] : null,
        // Сохраняем ID выбранной категории (следует обновить тип поля в таблице users на unsignedBigInteger)
        'services_category'  => $input['services_category'],
        // Сохраняем выбранные услуги в формате JSON (либо реализуйте связь через pivot‑таблицу)
        'services'           => json_encode($input['services']),
        'rating'             => 0,
    ]);
}

}
