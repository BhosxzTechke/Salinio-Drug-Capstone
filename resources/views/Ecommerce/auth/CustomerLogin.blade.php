@extends('Ecommerce.Layout.ecommerce')

@section('content')


  <style>

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
      -webkit-text-fill-color: #111827; /* gray-900 */
      box-shadow: 0 0 0px 1000px white inset;
      transition: background-color 9999s ease-in-out 0s;
    }


  </style>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="min-h-screen relative bg-gradient-to-r from-green-200 via-blue-100 to-white flex items-center justify-center overflow-hidden">
  
  <!-- Full-screen decorative shapes -->
  <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
  <div class="absolute top-1/3 right-0 w-[500px] h-[500px] bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
  <div class="absolute bottom-0 left-1/4 w-[700px] h-[700px] bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

  <!-- Optional faint pill pattern -->
  <div class="absolute inset-0 bg-[url('/images/pill-pattern.svg')] bg-repeat opacity-10"></div>

  <!-- Login Card -->
  <div class="z-10 max-w-md w-full space-y-8">
    <div class="text-center">
      <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Sign in</h2>
      <p class="mt-2 text-sm text-gray-600">
        Order your medications and health products
      </p>
    </div>

    <form id="MyForm" class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-2xl" action="{{ route('customer.login.store') }}" method="POST">
        @csrf


        <div class="bg-white rounded-md shadow-sm -space-y-px">

          <div class="form-group mb-4">
            <label for="email" class="sr-only">Email / Name / Phone</label>
            <input id="login" name="login" type="login" autocomplete="login" required
            class="block w-full px-3 py-2 border border-gray-300  text-gray-900 bg-white rounded-md focus:ring-green-500 focus:border-green-500 sm:text-sm"
            placeholder="Enter your email, name or phone" value="{{ old('login') }}">
            <span id="login-error" class="text-red-500 text-xs mt-1 block"></span>

          </div>


          <div class="form-group mb-4">
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
            class="block w-full px-3 py-2 border border-gray-300  text-gray-900 bg-white rounded-md focus:ring-green-500 focus:border-green-500 sm:text-sm"
            placeholder="Password">
            
            <span id="password-error" class="text-red-500 text-xs mt-1 block"></span>

          </div>
        </div>



        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox"
            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
          </div>
              <div class="text-sm">
            <a href="{{ route('password.request') }}" class="font-medium text-green-600 hover:text-green-500">Forgot your password?</a>
                </div> 
        </div>
        <div>

        <button type="submit"
          class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
          Sign In
        </button>

        <a href="{{ route('customer.google.login') }}"
          class="w-full text-center bg-white text-gray-700 py-2 px-4 rounded-md border border-gray-300 hover:bg-gray-50 transition-colors font-medium flex items-center justify-center gap-3 mt-4">
          <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          Continue with Google
        </a>

        </div>


      <p class="text-sm text-gray-600 text-center">
        Don't have an account? <a href="{{ route('customer.register.form') }}" class="font-medium text-green-600 hover:text-green-500">Register</a>
      </p>
    </form>


  </div>
</div>

@if ($errors->has('login'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('login-error').textContent = @json($errors->first('login'));
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function () {
        $('#MyForm').validate({
            rules: {
                login: {
                    required: true,
                },
                password: {
                    required: true,
                }
            },
            messages: {
                login: "Please enter your email, name or phone.",
                password: "Please enter your password."
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-red-500 text-xs mt-1 block');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>



@endsection