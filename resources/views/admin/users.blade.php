<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
                        <p class="text-gray-600">Kelola semua pengguna Eventify</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Filter & Search -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col md:flex-row gap-4">
                    <!-- Role Filter -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="organizer" {{ request('role') === 'organizer' ? 'selected' : '' }}>Organizer</option>
                            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <!-- Search -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Nama atau email..."
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Submit -->
                    <div class="flex items-end">
                        <button type="submit" 
                            class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Role Summary -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <a href="{{ route('admin.users', ['role' => 'admin']) }}" 
                    class="bg-purple-50 border-2 {{ request('role') === 'admin' ? 'border-purple-400' : 'border-transparent' }} rounded-xl p-4 hover:border-purple-400 transition">
                    <p class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'admin')->count() }}</p>
                    <p class="text-purple-700">Admin</p>
                </a>
                <a href="{{ route('admin.users', ['role' => 'organizer']) }}" 
                    class="bg-indigo-50 border-2 {{ request('role') === 'organizer' ? 'border-indigo-400' : 'border-transparent' }} rounded-xl p-4 hover:border-indigo-400 transition">
                    <p class="text-2xl font-bold text-indigo-600">{{ $users->where('role', 'organizer')->count() }}</p>
                    <p class="text-indigo-700">Organizer</p>
                </a>
                <a href="{{ route('admin.users', ['role' => 'user']) }}" 
                    class="bg-blue-50 border-2 {{ request('role') === 'user' ? 'border-blue-400' : 'border-transparent' }} rounded-xl p-4 hover:border-blue-400 transition">
                    <p class="text-2xl font-bold text-blue-600">{{ $users->where('role', 'user')->count() }}</p>
                    <p class="text-blue-700">User</p>
                </a>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                @if($users->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Login Via</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bergabung</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-white font-semibold">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $user->nama }}</p>
                                                    <p class="text-sm text-gray-500">ID: {{ $user->user_id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-800">{{ $user->email }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($user->role === 'admin')
                                                <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    Admin
                                                </span>
                                            @elseif($user->role === 'organizer')
                                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-semibold rounded-full">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    Organizer
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                    User
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($user->google_id)
                                                <span class="inline-flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24">
                                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                                    </svg>
                                                    Google
                                                </span>
                                            @else
                                                <span class="inline-flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    Email
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-800">{{ $user->created_at->format('d M Y') }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($user->user_id !== auth()->user()->user_id)
                                                    <!-- Change Role -->
                                                    <button type="button" 
                                                        class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" 
                                                        title="Ubah Role"
                                                        onclick="openRoleModal('{{ $user->user_id }}', '{{ addslashes($user->nama) }}', '{{ $user->role }}')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </button>

                                                    <!-- Delete -->
                                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" 
                                                            title="Hapus User"
                                                            onclick="return confirm('Yakin ingin menghapus user ini? Semua data terkait akan ikut terhapus.')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-sm text-gray-400">Akun Anda</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $users->withQueryString()->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p class="text-gray-600 text-lg mb-2">Tidak ada user ditemukan</p>
                        <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Role Modal -->
    <div id="roleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black/50" onclick="closeRoleModal()"></div>
            
            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md relative z-10">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Ubah Role User</h3>
                    <p class="text-gray-600 mb-4" id="roleUserName">-</p>
                    
                    <form id="roleForm" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Role Baru</label>
                            <div class="space-y-2">
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="role" value="user" class="mr-3 text-indigo-600" id="roleUser">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>User - Pengguna biasa</span>
                                </label>
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="role" value="organizer" class="mr-3 text-indigo-600" id="roleOrganizer">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    <span>Organizer - Bisa membuat event</span>
                                </label>
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="role" value="admin" class="mr-3 text-indigo-600" id="roleAdmin">
                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span>Admin - Akses penuh</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex gap-3">
                            <button type="button" onclick="closeRoleModal()"
                                class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openRoleModal(userId, userName, currentRole) {
            document.getElementById('roleUserName').textContent = userName;
            document.getElementById('roleForm').action = `/admin/users/${userId}/role`;
            
            // Check current role
            document.getElementById('roleUser').checked = currentRole === 'user';
            document.getElementById('roleOrganizer').checked = currentRole === 'organizer';
            document.getElementById('roleAdmin').checked = currentRole === 'admin';
            
            document.getElementById('roleModal').classList.remove('hidden');
        }

        function closeRoleModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRoleModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
