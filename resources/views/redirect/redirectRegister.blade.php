<!DOCTYPE html>
<html>
<head>
    <title>Redirigiendo a PayPal...</title>
</head>
<body>
    <form id="registerForm" action="{{ route('registroStore') }}" method="POST">
        @csrf
        @foreach($params as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>
    <script type="text/javascript">
        document.getElementById('registerForm').submit();
    </script>
</body>
</html>
