<?php

use App\Http\Livewire\Tweet\Create;
use App\Models\Tweet;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('should be able to create a twitter', function ($tweet) {
    $userLoggedIn = User::factory()->create();
    actingAs($userLoggedIn);

    livewire(Create::class)->set('body', $tweet)->call('submit')->assertEmitted('tweet::created');

    $tweetSaved = Tweet::query()->first();
    expect($tweetSaved)
        ->body->toBe($tweet)
        ->created_by->toBe($userLoggedIn->getKey());
})->with(['This is my first tweet', 'This is my second tweet', 'This is my third tweet']);


it('should make sure that only authenticated users can tweet', function () {
    livewire(Create::class)->set('body', 'This is my first tweet')->call('submit')->assertForbidden();
});

it('body is required', function () {
    $userLogged = User::factory()->create();
    actingAs($userLogged);

    livewire(Create::class)->set('body', null)->call('submit')
        ->assertHasErrors(['body' => 'required']);
});

it('the tweet should have a maximum length of 500 characters', function () {
    $userLogged = User::factory()->create();
    actingAs($userLogged);

    $body = str_repeat('t', 501);
    livewire(Create::class)->set('body', $body)->call('submit')
        ->assertHasErrors(['body' => 'max']);
});

it('should set body as null after submitting a tweet', function() {
    $userLoggedIn = User::factory()->create();
    actingAs($userLoggedIn);

    livewire(Create::class)->set('body', 'This is my first tweet')->call('submit')->assertSet('body', null);
});

todo('should show the tweet on the timeline');
