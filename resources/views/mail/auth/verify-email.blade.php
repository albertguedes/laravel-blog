<x-layouts.mail-layout-component>
    <div class="content" >
        <p>Hello {{ ucwords($name) }}</p>

        <br>

        <p>
            Your are receiving this email because we received a register
            request.
        </p>

        <p>
            If you did not request a register, no further action is
            required.
        </p>

        <p>
            If you request a register, you may confirm your email by clicking
            the link below:
        </p>

        <br>

        <p class="text-center" >
            <a href="{{ $url }}" >
                Confirm Email
            </a>
        </p>
    </div>
</x-layouts.mail-layout-component>
