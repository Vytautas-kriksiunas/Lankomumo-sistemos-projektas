@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Subjects list')  }}</div>

                <div class="card-body">
                    @if (Auth::user()->type=='admin')
                        <a href="{{ route('subjects.create') }}" class="btn btn-success float-end">{{ __('Add new subject') }}</a>
                    @endif
                    <hr class="mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Description") }}</th>
                                <th>{{ __("Lecturer") }}</th>
                                <th>{{ __("Semester") }}</th>
                                @if (Auth::user()->type=='admin')
                                <th>{{ __("Actions") }}</th>
                                @endif
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->description }}</td>
                                    <td>{{ $subject->lecturer->name }} {{ $subject->lecturer->surname }}</td>
                                    <td>{{ $subject->semester }}</td>

                                    <td>
                                        <a href="{{ route('attendance.index', $subject->id) }}" class="btn btn-outline-primary btn-sm">{{ __('Attendance') }}</a>
                                        @if (Auth::user()->type=='admin')
                                        @can('update', $subject)
                                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-info">{{ __("Edit") }}</a>
                                        @endcan

                                            @can('delete', $subject)
                                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">
                                                        {{ __("Delete") }}
                                                    </button>
                                                </form>
                                            @endcan
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
