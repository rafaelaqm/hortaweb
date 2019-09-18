@extends('templates.master')

@section('conteudo-view')
@if(session('sucess'))
    <h3>{{ session('sucess')['messages'] }}</h3>
@endif
{!! Form::open(['route' => 'moviment.application.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.select', ['label' => 'Grupo', 'select' => 'group_id', 'data' => $group_list ?? [], 'attributes' => ['placeholder' => 'Grupo']])
    @include('templates.formulario.select', ['label' => 'Hortaliça', 'select' => 'plant_id', 'data' => $plant_list ?? [], 'attributes' => ['placeholder' => 'Hortaliça']])
    @include('templates.formulario.input', ['label' => 'Valor', 'input' => 'value', 'attributes' => ['placeholder' => 'Valor']])
    @include('templates.formulario.submit', ['input' => 'Cadastrar'])
{!! Form::close() !!}
@endsection
