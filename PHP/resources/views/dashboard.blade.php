<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #ff6b6b, #f8f9fa);
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            font-size: 3rem;
            margin: 0;
            color: #ff6b6b;
            animation: shake 0.8s ease-in-out infinite;
        }

        p {
            font-size: 1.2rem;
            color: #6c757d;
            margin: 1rem 0 2rem;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            font-size: 1rem;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            background: #ff6b6b;
            color: #fff;
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            background: #ff4d4d;
            box-shadow: 0 4px 8px rgba(255, 75, 75, 0.4);
        }

        .icon {
            font-size: 4rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="icon">🚫</div>
    <h1>¡Acceso Restringido!</h1>
    <p>No tienes acceso a esta página. Si crees que esto es un error, contacta al administrador.</p>
    @if (auth()->user()->employee->tipo === 'admin')
        <a href="{{ route('home') }}" class="btn">Volver al Inicio</a>
    @else
        <a href="{{ route('homeEmployee') }}" class="btn">Volver al Inicio</a>
    @endif
</div>

</body>
</html>
