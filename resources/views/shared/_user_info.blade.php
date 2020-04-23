<a href="{{ route('users.show', $user->id) }}">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->nickName }}" class="gravatar"/>
</a>
<h1>{{ $user->nickName }}</h1>
