<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
<div>
    @include('partials.alerts')
    <!-- Login form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <h5 class="mb-0">Login to your account</h5>
        </div>
        <div>
            <label>Email</label>
            <div>
                <input type="text" class="form-control" placeholder="john@doe.com" name="email" value="{{ old('email') }}" required>
            </div>
        </div>
        <div>
            <label>Password</label>
            <div>
                <input type="password" class="" placeholder="•••••••••••" name="password" value="">
            </div>
        </div>
        <div class="mb-3">
            <button type="submit">Sign in</button>
        </div>
    </form>
    <!-- /login form -->
</div>
</body>
</html>
