<?php
use function Pest\Laravel\get;
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