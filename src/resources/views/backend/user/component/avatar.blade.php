<div class="card">
    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

        <img src="{{ asset(isset($user->image) ? $user->image : 'backend/img/default_avatar.jpg') }}" alt="Profile"
            class="rounded-circle">
        <h2>{{ $user->name }}</h2>
        <h3>{{ $user_catalogue->name }}</h3>
    </div>
</div>
