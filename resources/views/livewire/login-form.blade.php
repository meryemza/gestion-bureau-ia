<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#070E2A] flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] p-1 rounded-3xl shadow-xl">
        <div class="bg-[#070E2A] rounded-3xl p-8 text-white space-y-6">

            <h2 class="text-3xl font-bold text-center">Connexion</h2>

            <form wire:submit.prevent="login" class="space-y-5">
                <div>
                    <label class="block mb-1 text-sm font-semibold">Adresse email</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#AC72A1] text-white placeholder-white" placeholder="Ex: user@example.com" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold">Mot de passe</label>
                    <input type="password" wire:model="password" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#AC72A1] text-white placeholder-white" placeholder="****" required>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="remember" class="form-checkbox text-[#AC72A1]">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="#" class="text-[#FBD9FA] hover:underline">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] font-semibold rounded-xl hover:brightness-110 transition-all">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

</body>
</html>