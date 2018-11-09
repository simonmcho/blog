<div class="account-container">
    <div class="account-user">
        <h1 class="account-user-name">
            <a href="/posts/{{ $post->username}}" >
                {{ $post->username }}
            </a>
        </h1>
        <h3>
            {{ $post->email }}
        </h3>
        <p>
            {{ $post->created_at->toFormattedDateString() }}
        </p>
    </div>
    <div class="account-services">
        <ul>
            <li>
                <span>Chemistry</span>
                <span>$25/hour</span>
            </li>
            <li>
                <span>Math</span>
                <span>$35/hour</span>
            </li>
            <li>
                <span>Physics</span>
                <span>$30/hour</span>
            </li>
        </ul>
    </div>
    <div class="account-prices">
        <p>
            Range: $25 - $35/hour
        </p>
    </div>
</div>