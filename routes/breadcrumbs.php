<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
     $breadcrumbs->push('Home', route('home.index'));
});

// Login
Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
     $breadcrumbs->push('Login', route('login'));
});


// Services
Breadcrumbs::register('services', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Services', route('services.index'));
});

// Specialists
Breadcrumbs::register('specialists', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Specialists', route('specialists.index'));
});

// Contacts
Breadcrumbs::register('contacts', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contacts', route('contacts.index'));
});


// Profile
Breadcrumbs::register('profile', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profile', route('profile.index'));
});

// Profile -> Edit
Breadcrumbs::register('profile.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('profile');
    $breadcrumbs->push('Edit profile', route('profile.edit', $user->id));
});

// Profile -> Change password
Breadcrumbs::register('profile.change-password', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('profile');
    $breadcrumbs->push('Change password', route('profile.edit-password', $user->id));
});
