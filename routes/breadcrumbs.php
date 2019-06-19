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



// Patients
Breadcrumbs::register('patients', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Patients', route('patients.index'));
});

// Patients -> Patient
Breadcrumbs::register('patients.show', function ($breadcrumbs, $patient) {
    $breadcrumbs->parent('patients');
    $breadcrumbs->push($patient->firstname . ' ' . $patient->lastname, route('patients.show', ['id' => $patient->id]));
});



// Patients -> Patient -> Medical history
Breadcrumbs::register('patients.medical-history.index', function ($breadcrumbs, $patient) {
    $breadcrumbs->parent('patients.show', $patient);
    $breadcrumbs->push('Medical history', route('patients.medical-history.index', $patient->id));
});

// Patients -> Patient -> Medical history -> Entry
Breadcrumbs::register('patients.medical-history.show', function ($breadcrumbs, $patient, $entry) {
    $breadcrumbs->parent('patients.medical-history.index', $patient);
    $breadcrumbs->push('Entry #' . $entry->id, route('patients.medical-history.show', [$patient->id, $entry->id]));
});

// Patients -> Patient -> Medical history -> New entry
Breadcrumbs::register('patients.medical-history.create', function ($breadcrumbs, $patient) {
    $breadcrumbs->parent('patients.medical-history.index', $patient);
    $breadcrumbs->push('New entry', route('patients.medical-history.create', $patient->id));
});



// Patients -> Patient -> Prescriptions
Breadcrumbs::register('patients.prescriptions.index', function ($breadcrumbs, $patient) {
    $breadcrumbs->parent('patients.show', $patient);
    $breadcrumbs->push('Prescriptions', route('patients.prescriptions.index', ['id' => $patient->id]));
});

// Patients -> Patient -> Prescriptions -> Entry
Breadcrumbs::register('patients.prescriptions.show', function ($breadcrumbs, $patient, $prescription) {
    $breadcrumbs->parent('patients.prescriptions.index', $patient);
    $breadcrumbs->push('Prescription #' . $prescription->id, route('patients.prescriptions.show', ['patient_id' => $patient->id, 'prescription_id' => $prescription->id]));
});

// Patients -> Patient -> Prescriptions -> New prescription
Breadcrumbs::register('patients.prescriptions.create', function ($breadcrumbs, $patient) {
    $breadcrumbs->parent('patients.prescriptions.index', $patient);
    $breadcrumbs->push('New prescription', route('patients.prescriptions.create', ['patient_id' => $patient->id]));
});