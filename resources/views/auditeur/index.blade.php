<!DOCTYPE html>
<html>
<head>
    <title>Audit de sécurité</title>
</head>
<body>
    <h1>Audit de sécurité web</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('audit.store') }}" method="POST">
        @csrf
        <label for="url">URL à auditer :</label>
        <input type="url" name="url" required placeholder="https://example.com">
        <button type="submit">Lancer l'audit</button>
    </form>
</body>
</html>
