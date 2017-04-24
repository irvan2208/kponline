<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Parkir UIB') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="{{ url('/') }}/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ url('/') }}/dist/css/AdminLTE.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ url('/') }}/plugins/iCheck/square/blue.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition login-page" style="height: 0;">
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery 2.2.3 -->
    <script src="{{ url('/') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ url('/') }}/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{ url('/') }}/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    <!-- InputMask -->
  <script src="{{ url('/') }}/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="{{ url('/') }}/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="{{ url('/') }}/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script type="text/javascript">
      $("[data-mask]").inputmask();
    </script>
    <script type="text/javascript">
          $(document.body).on("change",".select2",function(){
           //$('#npm').val(this.value);
           $("[data-mask]").val('00'+this.value).inputmask().toString();
           $("[data-mask]").val().replace(new RegExp('-', 'g'),"");
          });
    </script>
    <script type="text/javascript">
          $('.btn-clr').click(function( event ) {
            $("[data-mask]").val().replace(new RegExp('-', 'g'),"");
          });
    </script>
    <script type="text/javascript">
       $('#npm').on('input',function(e){
         $('#npmhide').val($('#npm').val().replace(/-/g, ""));
        });
    </script>
</body>
</html>
