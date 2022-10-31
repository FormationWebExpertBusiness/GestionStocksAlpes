<?php
use function Pest\Laravel\get;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

// use function Pest\Laravel\actingAs;
// use function Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
// use function Faker\Factory;
// use DatabaseMigrations;

uses(RefreshDatabase::class);

test('not connected users redirected to login', function () {
    get('/')->assertRedirect('/stock');
});

test('connected user redirected to stock', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->get('/')->assertRedirect('/stock');
});