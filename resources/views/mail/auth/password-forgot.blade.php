<x-layouts.mail-layout-component>
    <div class="content" >
        <p>
            Hello {{ ucwords($name) }}
        </p>

        <p>
            Your are receiving this email because we received a password reset
            request for your account.
        </p>

        <p>
            If you did not request a password reset, no further action is
            required.
        </p>

        <p>
            If you suspects that your account is compromised, contact us immediately.
        </p>

        <p>
            If you request a password reset, you may reset your password by clicking
            the button below:
        </p>

        <br>

        <p class="text-center" >
            <a href="{{ $url }}" >
                Reset Password
            </a>
        </p>
    </div>
</x-layouts.mail-layout-component>
