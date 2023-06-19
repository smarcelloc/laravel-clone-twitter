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


todo('should make sure that only authenticated users can tweet');
todo('body is required');
todo('the tweet should have a maximum length of 500 characters');
todo('should show the tweet on the timeline');
todo('should set body as null after submitting a tweet');
