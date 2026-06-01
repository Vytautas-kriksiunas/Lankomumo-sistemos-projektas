@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                {{-- Flash pranešimai --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Antraštė --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>{{ $subject->name }} — {{ __('Attendance') }}</h4>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm">← {{ __('Back') }}</a>
                </div>

                {{-- Studento lankomumo žymėjimas --}}
                @if(Auth::user()->type === 'user')
                    <div class="card mb-4">
                        <div class="card-header">{{ __('Mark attendance') }}</div>
                        <div class="card-body">
                            <form action="{{ route('attendance.mark') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <input type="text"
                                       name="qr_code"
                                       class="form-control"
                                       placeholder="{{ __('Enter class code') }}"
                                       style="max-width: 250px;"
                                       required>
                                <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Dėstytojas: sukurti naują paskaitą --}}
                @if($isAdmin)
                    <div class="card mb-4">
                        <div class="card-header">{{ __('Create lecture') }}</div>
                        <div class="card-body">
                            <form action="{{ route('attendance.storeLecture', $subject) }}" method="POST" class="d-flex gap-2 align-items-end">
                                @csrf
                                <div>
                                    <label class="form-label mb-1">{{ __('Date') }}</label>
                                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Paskaitų sąrašas --}}
                @forelse($lectures as $lecture)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            📅 {{ $lecture->date->format('Y-m-d') }}
                            &nbsp;|&nbsp;
                            {{ __('Attended') }}: <strong>{{ $lecture->attendances->count() }}</strong>
                        </span>
                            <div class="d-flex align-items-center gap-3">
                                {{-- QR kodas matomas tik adminui/savo paskaitai --}}
                                @if($isAdmin && ($lecture->created_by === Auth::id() || Auth::user()->type === 'superAdmin'))
                                    <span class="badge bg-dark fs-6 font-monospace">{{ $lecture->qr_code }}</span>
                                    <form action="{{ route('attendance.destroyLecture', [$subject, $lecture]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('{{ __('Delete lecture?') }}')">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        {{-- Dalyvių sąrašas --}}
                        <div class="card-body p-0">
                            @if($lecture->attendances->isEmpty())
                                <p class="text-muted p-3 mb-0">{{ __('No attendances yet.') }}</p>
                            @else
                                <table class="table table-sm mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Time') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lecture->attendances as $i => $attendance)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $attendance->user->name }}</td>
                                            <td>{{ $attendance->attended_at->format('H:i') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">{{ __('No lectures yet.') }}</div>
                @endforelse

            </div>
        </div>
    </div>
@endsection
