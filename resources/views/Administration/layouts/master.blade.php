<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Wuras | Administration</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

     <!-- Vendor css (Require in all Page) -->
     <link href="{{ asset('assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
     <!-- DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('assets/js/config.js') }}"></script>

     <style>
           /* Plein écran pour le loader */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out;
            z-index: 9999;
        }

        /* Loader animé */
        .loader {
            width: 60px;
            height: 60px;
            border: 6px solid rgba(255, 0, 0, 0.3);
            border-top-color: red;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animation de rotation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Cache le loader une fois la page chargée */
        .hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
     </style>
</head>

<body>
     <div class="loader-container" id="loader">
          <div class="loader"></div>
      </div>
     <div class="wrapper">

          @include('Administration.layouts.header')

          @include('Administration.layouts.sidebar')

          <div class="page-content">

            @yield('content')

            @include('Administration.layouts.footer')

          </div>
       

     </div>

     <script>
          // Lorsque la page est complètement chargée, cache le loader
          window.addEventListener("load", function() {
              document.getElementById("loader").classList.add("hidden");
          });
      </script>
  <!-- jQuery (necessary for DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  
     <!-- Vendor Javascript (Require in all Page) -->
     <script src="{{ asset('assets/js/vendor.js') }}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('assets/js/app.js')}}"></script>

   
     <!-- Dashboard Js -->
     <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

   


     @stack('scripts')

</body>

</html>