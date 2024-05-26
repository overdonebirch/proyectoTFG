<!DOCTYPE html>
<html>
<head>
    <title>Procesando reserva...</title>
</head>
<body>
    <form id="guardarReservaForm" action="{{$route}}" method="POST">
        @csrf

    </form>
    <script type="text/javascript">
        document.getElementById('guardarReservaForm').submit();
    </script>
</body>
</html>
