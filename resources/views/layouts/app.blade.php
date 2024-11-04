
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Admin Project</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   </head>
   <body>
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
           <div class="container-fluid">
               <a class="navbar-brand" href="#">Admin Project</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                   <ul class="navbar-nav me-auto">
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('home') }}">Home</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('service') }}">Service</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('work') }}">Our Work</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('about') }}">About Us</a>
                       </li>
                   </ul>
                   <ul class="navbar-nav">
                       @guest
                           <li class="nav-item">
                               <a class="nav-link" href="{{ route('login') }}">Login</a>
                           </li>
                       @else
                           @if(auth()->user()->is_admin)
                               <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.panel') }}">Admin</a>
                               </li>
                           @endif
                           <li class="nav-item">
                               <form action="{{ route('logout') }}" method="POST">
                                   @csrf
                                   <button type="submit" class="btn btn-link nav-link">Logout</button>
                               </form>
                           </li>
                       @endguest
                   </ul>
               </div>
           </div>
       </nav>
       <div class="container mt-4">
           @yield('content')
       </div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
   </html>