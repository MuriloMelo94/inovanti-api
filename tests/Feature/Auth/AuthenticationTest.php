<?php

test('Admin user should be able to login', function () {
    $credentials = [
        'username' => 'admin',
        'password' => '112233',
    ];

    $response = $this->post('/login', $credentials);

    $response->assertStatus(200);
});

test('Wrong credentials should not be able to login', function () {
    $credentials = [
        'username' => 'admin',
        'password' => 'wrong-password',
    ];

    $response = $this->post('/login', $credentials);

    $response->assertStatus(401);
});
