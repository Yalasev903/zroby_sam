<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; // Очищает БД перед тестами

    /**
     * Тест успешной регистрации пользователя
     */
    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Тестовый Пользователь',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect('/dashboard'); // После регистрации перенаправляет на dashboard
    }

    /**
     * Тест доступности страницы профиля
     */
    public function test_user_can_access_profile_page()
    {
        $user = User::factory()->create(); // Создаём тестового пользователя

        $response = $this->actingAs($user)->get('/user/profile');

        $response->assertStatus(200); // Страница профиля должна быть доступна
        $response->assertSee('Profile'); // Проверяем, что заголовок "Profile" есть
    }

    /**
     * Тест отображения рейтинга в профиле
     */
    public function test_user_profile_displays_rating()
    {
        $user = User::factory()->create([
            'rating' => 4.5, // Устанавливаем рейтинг
        ]);

        $response = $this->actingAs($user)->get('/user/profile');

        $response->assertStatus(200);
        $response->assertSee('⭐ 4.5 / 5'); // Проверяем, что рейтинг отображается
    }

    /**
     * Тест обновления профиля пользователя
     */
    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/user/profile', [
            'name' => 'Новое Имя',
            'email' => 'new-email@example.com',
            'photo' => null, // Если нужно, можно передать фото
        ]);

        // Проверка, что имя и email обновились в базе
        $this->assertDatabaseHas('users', [
            'name' => 'Новое Имя',
            'email' => 'new-email@example.com',
        ]);

        // Проверка, что редирект на страницу профиля происходит
        $response->assertRedirect('/user/profile');
    }

    /**
     * Тест неудачного обновления профиля с некорректным email
     */
    public function test_user_profile_update_fails_with_invalid_email()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/user/profile', [
            'name' => 'Новое Имя',
            'email' => 'invalid-email', // Некорректный email
            'photo' => null,
        ]);

        // Проверка, что ошибка валидации произошла
        $response->assertSessionHasErrors('email');
    }
}
