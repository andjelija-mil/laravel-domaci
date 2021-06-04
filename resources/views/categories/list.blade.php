@extends('adminlte::page')

@section('title', 'Kategorije')

@section('content_header')
    <h1>Kategorije</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <livewire:category-list/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <livewire:category-form :categoryForEdit="$categoryForEdit"/>
                </div>
            </div>
        </div>
    </section>
@stop


