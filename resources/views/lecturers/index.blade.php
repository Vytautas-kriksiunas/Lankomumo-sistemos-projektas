@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('lecturers.lecturers_list') }}</div>

                <div class="card-body">
                    @if (Auth::user()->type=='admin')
                        <a href="{{ route('lecturer.create') }}" class="btn btn-success float-end">{{ __("lecturers.add_new") }}</a>
                    @endif
                    <hr class="mt-5">
                    <form method="post" action=" {{ route('lecturer.filterBy') }}" >
                            @csrf


                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:300px;"></th>
                                    <th>
                                        <a href="{{ route('lecturer.orderBy', ['name',  ($orderField!='name' || $order=='DESC') ?'ASC':'DESC']) }}" class="{{ $orderField=='name'?'fst-italic':'' }}"> {{ __('lecturers.name') }}</a>
                                    </th>
                                    <th><a href="{{ route('lecturer.orderBy', ['surname', ($orderField!='surname' || $order=='DESC') ?'ASC':'DESC']) }}" class="{{ $orderField=='surname'?'fst-italic':'' }}"> {{ __('lecturers.surname') }}</a></th>
                                    <th><a href="{{ route('lecturer.orderBy', ['email', ($orderField!='email' || $order=='DESC') ?'ASC':'DESC'])}}" class="{{ $orderField=='email'?'fst-italic':'' }}"> {{ __('lecturers.email') }}</a></th>
                                    <th><a href="{{ route('lecturer.orderBy', ['birthdate', ($orderField!='birthdate' || $order=='DESC') ?'ASC':'DESC']) }}" class="{{ $orderField=='birthdate'?'fst-italic':'' }}"> {{ __('lecturers.birthdate') }}</a></th>


                                    <th>{{ __('lecturers.subjects_taught') }}</th>
                                    @if (Auth::user()->type=='admin')
                                        <th style="width: 200px;">{{ __('lecturers.actions') }}</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>
                                        <input  type="text" class="form-control" name="filterName" value="{{ $filterName }}">
                                    </th>
                                    <th>
                                        <input  type="text" class="form-control" name="filterSurname" value="{{ $filterSurname }}">
                                    </th>
                                    <th>
                                        <input  type="text" class="form-control" name="filterEmail" value="{{ $filterEmail }}">
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <button name="filter" value="1" type="submit" class="btn btn-info">Filtruoti</button>
                                        <button name="clearFilter" value="1" type="submit" class="btn btn-info">Valyti filtrą</button>
                                    </th>

                                </tr>

                            </thead>
                            <tbody>
                                @foreach($lecturers as $lecturer)
                                    <tr>
                                        <td>
                                            @if ($lecturer->photo !=null )
                                                <img src="/storage/{{ $lecturer->photo }}" alt="" width="100%">
                                            @endif
                                        </td>
                                        <td>{{ $lecturer->name }}</td>
                                        <td>{{ $lecturer->surname }}</td>
                                        <td>{{ $lecturer->email }}</td>
                                        <td>{{ $lecturer->birthdate }}</td>
                                        <td>
                                            @foreach($lecturer->subjects as $subject)
                                                <div>{{ $subject->name }}</div>
                                            @endforeach
                                        </td>

                                        <td>
                                            <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-info">Edit</a>
                                            @can('deleteLecturer', $lecturer)
                                                <a href="{{ route('lecturer.destroy', $lecturer->id) }}" class="btn btn-danger">Delete</a>
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
