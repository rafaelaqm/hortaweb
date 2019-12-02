<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <met charset="utf-8">
    <title>Horta Web</title>
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    @yield('css-view')
</head>
  <body>
      @include('templates.menu-lateral')

      <section id="view-conteudo">
          @yield('conteudo-view')
      </section>

    @yield('js-view')
  </body>
</html>