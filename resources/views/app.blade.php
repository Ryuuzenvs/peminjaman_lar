<link href={{ asset('bootstrap.min.css') }}>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">

<div class="container">
<a class="navbar-brand" href="#">PinjamAlat</a>
<div class="navbar-nav">
<a class="nav-link" href="{{ route('category.index') }}">category</a>
<a class="nav-link" href="{{ route('tool.index') }}">tool</a>
<form action="{{route('logout')}}}" method="post">
    <button class="btn btn-link nav-link">logout</button>
</form>
</div>
</div>

</nav>

<div class="container">
@yield('content')
</div>

</body>


