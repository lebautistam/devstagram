@extends('layouts.app')


@section('titulo')
    Página Principal
@endsection

@section('contenido')
    <x-lista-post :posts="$posts"/>

    {{-- </x-listar-post> --}}
@endsection