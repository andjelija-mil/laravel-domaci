@extends('adminlte::page')

@section('title')
    @if($productForEdit)
        Izmena proizvoda
    @else
        Dodavanje proizvoda
    @endif
@endsection

@section('content_header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
                <div class="card">
                    <div class="card-header bg-gray py-3 text-lg">
                        @if($productForEdit)
                            Izmena proizvoda
                        @else
                            Dodavanje proizvoda
                        @endif
                    </div>
                    <form @if($productForEdit) action="{{route('productsUpdate',$productForEdit->id)}}" @else action="{{route('productsStore')}}" @endif method="POST">
                        @csrf
                        @if($productForEdit)
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Naziv*</label>
                                    <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="Naziv" value="{{$productForEdit->name ?? ""}}">
                                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category_id">Kategorija*</label>
                                    <select id="category_id" name="category_id" class="form-control" required>
                                        <option value="" selected disabled>Izaberi kategoriju</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($productForEdit && $productForEdit->category_id===$category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="price">Cena*</label>
                                    <input type="text" class="form-control @error('price') border-danger @enderror" id="price" name="price" value="{{$productForEdit->price ?? ""}}" placeholder="Cena">
                                    @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea class="form-control @error('description') border-danger @enderror" id="description" name="description" placeholder="Opis">
                                    {{$productForEdit->description ?? ""}}
                            </textarea>
                                @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success">@if($productForEdit) Sacuvaj izmene @else Dodaj proizvod @endif</button>
                            @if($productForEdit)
                                <a href="{{route('productsCreate')}}" class="btn btn-info">Dodaj novi proizvod</a>
                            @endif
                            <a href="{{route('productsList')}}" class="btn btn-warning">Nazad na listu</a>
                        </div>
                    </form>
                </div>
    </section>
@stop
