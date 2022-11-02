<?php
use function Pest\Laravel\get;
use Illuminate\Support\Facades\Hash;
use function Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

uses(RefreshDatabase::class);

test('not connected users redirected to login', function () {
    get('/')->assertRedirect('/stock');
});

test('connected user redirected to stock', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->get('/')->assertRedirect('/stock');
});