<x-layouts.profile title="Profile - Edit" description="Edit the user profile" >
    <div class="row" >
        <div class="col-12" >
            <x-profile.profile-tabs />
        </div>
        <div class="col-12 mt-3 text-danger" >
            <h2>Edit Profile</h2>
        </div>
        <div class="col-12" >
            <x-profile.profile-edit-form :user="$user" />
        </div>
    </div>
</x-layouts.profile>
