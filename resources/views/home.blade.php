<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
@include('partials.alerts')
<div>
    <h1>First Name</h1>
    {{ $first_name }}
    <h1>Last Name</h1>
    {{ $last_name }}
    <a href="{{ route('logout') }}">Logout</a>
    <a href="{{ route('author.index') }}">Authors</a>

    <a href="{{ route('profile', $user_id) }}">Profile</a>
</div>
</body>
</html>
