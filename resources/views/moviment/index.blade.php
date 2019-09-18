@extends('templates.master')
@section('conteudo-view')

@if(session('sucess'))
  <h3>{{ session('sucess')['messages'] }}</h3>
@endif

<table class="default-table">
  <thead>
      <tr>
          <th>Planta</th>
          <th>Nome da Instituição</th>
          <th>Valor investido</th>
      </tr>
  </thead>
  <tbody>
      @foreach($plant_list as $plant)
      <tr>
        <td>{{ $plant->name }}</td>
        <td>{{ $plant->institution->name }}</td>
        <td>{{ $plant->valueFromUser(Auth::user()) }}</td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection
