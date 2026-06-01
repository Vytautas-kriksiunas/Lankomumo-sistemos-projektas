

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
                    <div class="card-header">Dėstytojų sąrašas</div>

                    <div class="card-body">
                        <form action="{{ route('lecturer.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Vardas</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pavardė</label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">
                                <div class="invalid-feedback">@error('surname') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">El. paštas</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gimimo data</label>
                                <input type="text" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}">
                                <div class="invalid-feedback">@error('birthdate') {{ $message }} @enderror</div>
                            </div>
                            <button class="btn btn-success" type="submit">Pridėti</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
