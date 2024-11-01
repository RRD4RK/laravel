@extends('site.layout')
@section('title', 'Essa é a página home')
@section('conteudo')


{{-- Isso é um comentario--}}

{{isset($nome)? 'existe': 'não existe'}}

@endsection
