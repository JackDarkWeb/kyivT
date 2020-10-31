@component('mail::message')
    # {{__('Reset Password')}}

    {{__('Click in the button for change your password')}}

    @component('mail::button', ['url' => route('reset.password', ['lang' => app()->getLocale(), 'token' => $token])])
        {{__('Reset Your Password') }}
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent


