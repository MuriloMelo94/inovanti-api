<?php

use App\Models\User;

test('Admin user should be able to login', function () {
    User::factory()->create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@email.com',
        'password' => bcrypt('112233'),
    ]);

    $credentials = [
        'username' => 'admin',
        'password' => '112233',
    ];

    $response = $this->post('api/login', $credentials);

    $response->assertStatus(200);
});

test('Wrong credentials should not be able to login', function () {
    User::factory()->create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@email.com',
        'password' => bcrypt('112233'),
    ]);

    $credentials = [
        'username' => 'admin',
        'password' => 'wrong-password',
    ];

    $response = $this->post('api/login', $credentials);

    $response->assertStatus(401);
});

test('Admin user should be able to logout', function () {
    User::factory()->create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@email.com',
        'password' => bcrypt('112233'),
    ]);

    $credentials = [
        'username' => 'admin',
        'password' => '112233',
    ];

    $response = $this->post('api/login', $credentials);

    $token = $response->json('access_token');

    $this->post('api/logout', [], ['Authorization' => 'Bearer ' . $token])->assertStatus(200);
});
