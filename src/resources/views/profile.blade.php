<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>Profile</title>

    <!-- Meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/css-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/profile.js') }}"></script>

</head>

<body>
    <!-- Header imported from ./comps/main/header.blade.php -->
    @include('comps.main.header')

    <!-- Main -->
    <main class="Profile-card">
        <h1 class="page-header">PROFILE</h1>
        <ul>
            <li>
                <label>Name:</label>
                <p>{{$page_owner->name}}</p>
            </li>
            <li>
                <label>Username:</label>
                <p>{{$page_owner->username}}</p>
            </li>
            <li>
                <label>Email:</label>
                <p>{{$page_owner->email}}</p>
            </li>
            <li>
                <label>Registration Date:</label>
                <p>{{$page_owner->created_at}}</p>
            </li>
            <li>
                <label>Rights:</label>
                <p class="rights" style="color: {{ $page_owner->is_banned ? 'red' : 'green' }}">
                    {{ $page_owner->is_banned ? 'Cannot comment' : 'Can comment' }}
                </p>
                <br>
                @if ($page_visitor->is_admin)
                    <button class="ban-button" onclick="toggleBan({{ $page_owner->id }})" style="color: {{ $page_owner->is_banned ? 'green' : 'red' }}">
                        {{ $page_owner->is_banned ? 'Unban' : 'Ban' }}</button>
                @endif
            </li>
        </ul>
    </main>

    <!-- Footer -->
    @include('comps.main.footer')

</body>

</html>