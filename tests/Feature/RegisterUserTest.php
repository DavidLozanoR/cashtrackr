<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('shows the registartion screen', function(){
    $response = $this->get(route('register'));

    $response->assertStatus(200);

    $response->assertSee('Crear Cuenta');
});

test('register a new user as unverifield and dispatches the registered event', function(){
    $response = $this->post(route('register.store'),[
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',   
    ]);
    $response->assertRedirect(route('verification.notice'));
});