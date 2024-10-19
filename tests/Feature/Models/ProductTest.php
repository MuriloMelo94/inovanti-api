<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('Product index', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('api/products');

    $response->assertStatus(200);

});

test('Product store', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->make([
        'name' => 'Product One',
        'description' => 'Product One and its description',
        'status' => true,
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', $product->toArray());

    $response->assertStatus(201);

    assertDatabaseHas('products', $product->toArray());
});

test('Product show', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->create([
        'name' => 'Product Two',
        'description' => 'Product Two and its description',
        'status' => 1,
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('api/products/' . $product->id);

    $response->assertStatus(200);
});

test('Product Update', function (){
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->create([
        'name' => 'Product three',
        'description' => 'Product three and its description',
        'status' => true,
    ]);

    $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', $product->toArray());

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->put('api/products/' . $product->id, [
        'name' => 'Product Updated',
        'price' => 10.00,
        'quantity' => 5,
        'description' => 'Product Updated and its description',
        'status' => false,
    ]);

    $response->assertStatus(200);

    assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Product Updated',
        'description' => 'Product Updated and its description',
        'status' => false,
    ]);
});

test('Product Delete', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->create([
        'name' => 'Product four',
        'description' => 'Product four and its description',
        'status' => true,
    ]);

    $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', $product->toArray());

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->delete('api/products/' . $product->id);

    $response->assertStatus(200);

    assertDatabaseMissing('products', $product->toArray());
});

test('General validation error', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', []);

    $response->assertStatus(422);
});

test('Name product min size validation error', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->create([
        'name' => 'A',
        'description' => 'Product five and its description',
        'status' => true,
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', $product->toArray());

    $response->assertStatus(422);
});

test('Description product max size validation error', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->create([
        'name' => 'Product six',
        'description' => str_repeat('a', 256),
        'status' => true,
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', $product->toArray());

    $response->assertStatus(422);
});

test('Quantity product validation error', function () {
    User::factory()->create([
        'username' => 'admin',
        'password' => Hash::make('112233'),
    ]);

    $response = $this->post('api/login', [
        'username' => 'admin',
        'password' => '112233',
    ]);

    $token = $response->json('access_token');

    $product = Product::factory()->create([
        'name' => 'Product seven',
        'description' => 'Product seven and its description',
        'quantity' => 1.05,
        'status' => true,
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('api/products', $product->toArray());

    $response->assertStatus(422);
});
