@extends('templates.master')

@section('conteudo-view')

{!! Form::model($institution, ['route' => [institution.update, $institution->$id], 'method' => 'put', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
    @include('templates.formulario.submit', ['input' => 'Atualizar'])
{!! Form::close() !!}


@endsection
