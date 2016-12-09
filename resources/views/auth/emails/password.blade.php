click here to reset your password: <br>
<a href="{{ $link = route('password.reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>
