<x-layouts.profile title="Password" description="Change your password" >
    <div class="row" >
        <div class="col-12" >
            <x-profile.profile-tabs />
        </div>

        <div class="col-12" >
            <h2 class="alert-heading text-danger my-5 text-center">
                <i class="fas fa-exclamation-triangle"></i> Careful! You are about to change your password.
            </h2>

            <div class="w-50 mx-auto" >
                <x-profile.password-form />
            </div>
        </div>
    </div>
</x-layouts.profile>
