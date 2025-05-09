<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#070E2A] flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] p-1 rounded-3xl shadow-xl">
        <div class="bg-[#070E2A] rounded-3xl p-8 text-white space-y-6">

            <h2 class="text-3xl font-bold text-center">Inscription</h2>

            <form wire:submit.prevent="register" class="space-y-5">
                <div>
                    <label class="block mb-1 text-sm font-semibold">Nom</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#AC72A1] text-white" placeholder="Votre nom">
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold">Adresse email</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#AC72A1] text-white" placeholder="email@example.com">
                    @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                <label class="block mb-1 text-sm font-semibold">Rôle</label>
<select wire:model="role" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white">
    <option value="">Sélectionnez un rôle</option>
    <option value="admin" class="text-black">Admin</option>
    <option value="rh" class="text-black">RH</option>
    <option value="comptable" class="text-black">Comptable</option>
    <option value="employe" class="text-black">Employé</option>
    <option value="auditeur" class="text-black">Auditeur de Sécurité</option>
</select>

                    @error('role') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold">Mot de passe</label>
                    <input type="password" wire:model="password" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white">
                    @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold">Confirmer le mot de passe</label>
                    <input type="password" wire:model="password_confirmation" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white">
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] font-semibold rounded-xl hover:brightness-110 transition-all">
                    S'inscrire
                </button>
            </form>
        </div>
    </div>

</body>
</html>
