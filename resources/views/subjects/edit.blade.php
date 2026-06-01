

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dalyko redagavimas</div>

                    <div class="card-body">
                        <form action="{{ route('subjects.update', $subject->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" class="form-control" name="name" value="{{ $subject->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Aprašas</label>
                                <textarea name="description" class="form-control" >{{ $subject->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Semestras</label>
                                <input type="number" class="form-control" name="semester" value="{{ $subject->semester }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dėstytojas</label>

                                <select name="lecturer_id" class="form-control">
                                    @foreach($lecturers as $lecturer)
                                        <option  value="{{ $lecturer->id }}"  {{ $lecturer->id==$subject->lecturer_id?'selected':'' }}  >{{ $lecturer->name }} {{ $lecturer->surname }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <button class="btn btn-success" type="submit">Atnaujinti</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
