<div class="list-group-item">
  <img class="mr-3" src="{{ $user->gravatar() }}" alt="{{ $user->nickName }}" width=32>
  <a href="{{ route('users.show', $user) }}">
    {{ $user->nickName }}
  </a>
</div>
