

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list">
                            @foreach($errors->all() as $error)
                                <li class="list-item">{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Dalyko pridėjimas</div>

                    <div class="card-body">
                        <form action="{{ route('subjects.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Aprašas</label>
                                <textarea name="description" class="form-control" ></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Semestras</label>
                                <input type="number" class="form-control" name="semester">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dėstytojas</label>

                                <select name="lecturer_id" class="form-control">
                                    @foreach($lecturers as $lecturer)
                                        <option  value="{{ $lecturer->id }}">{{ $lecturer->name }} {{ $lecturer->surname }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <button class="btn btn-success" type="submit">Pridėti</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
