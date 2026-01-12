<link href={{ asset('bootstrap.min.css') }} rel="stylesheet">
<style>
* {
    outline: 1px solid red !important;
  }
</style>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">

<div class="container">
<a class="navbar-brand" href="{{auth()->user()->dashboardUrl()}}
">PinjamAlat</a>
<div class="navbar-nav">
<a class="nav-link" href="{{ route('category.index') }}">category</a>
<a class="nav-link" href=" {{ route('tools.index') }}">tool</a>
<form action="{{route('logout')}}" method="post">
 @csrf
    <button class="btn btn-link nav-link">logout</button>
</form>
</div>
</div>

</nav>

<div class="container">
@yield('content')
</div>

</body>


