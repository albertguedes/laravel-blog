<x-layouts.profile title="Profile" description="User profile" >
    <div class="row" >
        <div class="col-12" >
            <x-profile.profile-tabs />
        </div>
        <div class="col-12" >
            <x-profile.user-profile :user="$user" />
        </div>
    </div>
</x-layouts.profile>
