@extends('templates.master')

@section('conteudo-view')
{!! Form::open(['route' => ['institution.plant.store', $institution->id], 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.input', ['label' => 'Nome da Hortaliça', 'input' => 'name'])
    @include('templates.formulario.input', ['label' => 'Descrição', 'input' => 'description'])
    @include('templates.formulario.submit', ['input' => 'Cadastrar'])
{!! Form::close() !!}
<table class="default-table">
  <thead>
    <th>#</th>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Opções</th>
  </thead>
  <tbody>
    @forelse($institution->plants as $plant)
    <tr>
      <td>{{ $plant->id }}</td>
      <td>{{ $plant->name }}</td>
      <td>{{ $plant->description }}</td>
      <td>
        {!! Form::open(['route' => ['institution.plant.destroy', $institution->id, $plant->id], 'method' => 'DELETE']) !!}
        {!! Form::submit('Remover') !!}
        {!! Form::close() !!}
        <a href="">Editar</a>
      </td>
    </tr>
    @empty
    <tr>
      <td>Nenhuma Hortaliça Cadastrada.</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
