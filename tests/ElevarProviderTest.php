<?php

use Astrogoat\Utm\Utm;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->provider = app(Utm::class)->driver('elevar');
    $this->provider->clear();
});


// See Elevar documentation for the implementation requirements:
// https://www.notion.so/elevar/Collecting-and-Storing-UTM-Parameters-and-Click-IDs-on-Headless-Sites-92575d2632d643a08d1b5bde3900faee

test('Scenario 1', function () {
    // 1. First visit `gclid=xxxx`
    $this->provider->put(['gclid' => 'xxxx']);

    // 2. Second visit `utm_source=klaviyo&utm_medium=email`
    $this->provider->put([
        'utm_source' => 'klaviyo',
        'utm_medium' => 'email'
    ]);

    // 3. Final result in local storage `utm_source=klaviyo&utm_medium=email` note that the `gclid` was removed.
    expect($this->provider->toArray())->toBe([
        'utm_source' => 'klaviyo',
        'utm_medium' => 'email'
    ]);
});

test('Scenario 2', function () {
    // 1. First visit `gclid=xxxx&utm_source=google&utm_medium=cpc`
    $this->provider->put([
        'gclid' => 'xxxx',
        'utm_source' => 'google',
        'utm_medium' => 'cpc'
    ]);

    // 2. Second visit `gclid=yyyy`
    $this->provider->put([
        'gclid' => 'yyyy',
    ]);

    // 3. Final result in local storage `gclid=yyyy` note that the utms were removed
    expect($this->provider->toArray())->toBe([
        'gclid' => 'yyyy',
    ]);
});

test('Scenario 3', function () {
    // 1. First visit `gclid=xxxx&utm_source=google&utm_medium=cpc&utm_term=button`
    $this->provider->put([
        'gclid' => 'xxxx',
        'utm_source' => 'google',
        'utm_medium' => 'cpc',
        'utm_term' => 'button',
    ]);

    // 2. Second visit `fbclid=xxxx&utm_source=facebook&utm_medium=cpc`
    $this->provider->put([
        'fbclid' => 'xxxx',
        'utm_source' => 'facebook',
        'utm_medium' => 'cpc',
    ]);

    // 3. Final result in local storage `fbclid=xxxx&utm_source=facebook&utm_medium=cpc` note that `utm_term` was removed
    expect($this->provider->toArray())->toBe([
        'fbclid' => 'xxxx',
        'utm_source' => 'facebook',
        'utm_medium' => 'cpc',
    ]);
});

test('Scenario 4', function () {

    // 1. First visit `gclid=xxxx&utm_source=google&utm_medium=cpc&utm_term=button`
    $this->provider->put([
        'gclid' => 'xxxx',
        'utm_source' => 'google',
        'utm_medium' => 'cpc',
        'utm_term' => 'button',
    ]);

    // 2. Second visit `fbclid=xxxx`
    $this->provider->put([
        'fbclid' => 'xxxx',
    ]);

    // 3. Final result in local storage `gclid=xxxx&utm_source=google&utm_medium=cpc&utm_term=button&fbclid=xxxx` note that both `gclid` and `fbclid` are present.
    expect($this->provider->toArray())->toBe([
        'gclid' => 'xxxx',
        'utm_source' => 'google',
        'utm_medium' => 'cpc',
        'utm_term' => 'button',
        'fbclid' => 'xxxx',
    ]);
});
