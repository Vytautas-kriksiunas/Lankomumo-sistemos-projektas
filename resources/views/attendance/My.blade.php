@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4 class="mb-3">{{ __('My Attendance') }}</h4>

                @forelse($attendances as $attendance)
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $attendance->lecture->subject->name }}</strong>
                                <span class="text-muted ms-2">{{ $attendance->lecture->date->format('Y-m-d') }}</span>
                            </div>
                            <span class="badge bg-success">✓ {{ $attendance->attended_at->format('H:i') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">{{ __('No attendance records yet.') }}</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
