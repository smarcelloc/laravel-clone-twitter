<ul>
    @foreach ($tweets as $tweet)
        <li class="text-white">{{ $tweet->body }}</li>
    @endforeach
</ul>
