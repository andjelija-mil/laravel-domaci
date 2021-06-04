@extends('adminlte::page')

@section('title', 'Korisnici')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Korisnici</h1>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <livewire:user-list/>
@stop
