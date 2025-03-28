<form method="POST" action="{{ route('password.request') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Envoyer le lien</button>
</form>
