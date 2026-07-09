@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Welcome, {{ auth()->user()->name }}</h1>
        <button id="clockInBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Clock In</button>
    </div>

    <script>
        document.getElementById('clockInBtn').addEventListener('click', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    fetch('/clock-in', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        },
                        body: JSON.stringify({
                            location: {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            }
                        })
                    })
                    .then(response => response.json())
                    .then(data => alert(data.message));
                });
            } else {
                alert("Geolocation is not supported.");
            }
        });
    </script>
@endsection
