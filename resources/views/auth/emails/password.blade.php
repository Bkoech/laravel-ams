{{-- resources/views/emails/password.blade.php --}}

{{ trans('ams::message.passwordclickreset') }} <a href="{{ route('ams.password.reset', $token) }}">{{ route('ams.password.reset', $token) }}</a>