<!-- Sidebar -->
<div class="bg-gray-800 text-white w-64 min-h-screen p-4 lg:relative lg:translate-x-0 fixed inset-y-0 left-0 z-50 transform -translate-x-full transition-transform duration-200 ease-in-out" id="sidebar">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-gray-900 rounded-lg mb-8">
        <h2 class="text-xl font-bold text-white">120 Customs</h2>
    </div>

    <!-- Navigation -->
    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') ?? '#' }}" class="flex items-center space-x-3 text-gray-300 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6h-8V5z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Users -->
        <div class="space-y-1">
            <button class="flex items-center justify-between w-full text-gray-300 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200" onclick="toggleSubmenu('users-submenu')">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span>Users</span>
                </div>
                <svg class="w-4 h-4 transform transition-transform duration-200" id="users-submenu-arrow" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden pl-8 space-y-1" id="users-submenu">
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 text-gray-400 p-2 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white' : '' }}">
                    <span>All Users</span>
                </a>
                <a href="{{ route('admin.users.create') }}" class="flex items-center space-x-3 text-gray-400 p-2 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <span>Add User</span>
                </a>
            </div>
        </div>

        <!-- Vehicles -->
        <div class="space-y-1">
            <button class="flex items-center justify-between w-full text-gray-300 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200" onclick="toggleSubmenu('vehicles-submenu')">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2m-7 4h8a2 2 0 002-2V7a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2zM3 10h18M7 15h10"></path>
                    </svg>
                    <span>Vehicles</span>
                </div>
                <svg class="w-4 h-4 transform transition-transform duration-200" id="vehicles-submenu-arrow" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden pl-8 space-y-1" id="vehicles-submenu">
                <a href="{{ route('admin.vehicles.index') }}" class="flex items-center space-x-3 text-gray-400 p-2 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.vehicles.*') ? 'bg-gray-700 text-white' : '' }}">
                    <span>All Vehicles</span>
                </a>
                <a href="{{ route('admin.vehicles.create') }}" class="flex items-center space-x-3 text-gray-400 p-2 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <span>Add Vehicle</span>
                </a>
            </div>
        </div>

        <!-- Gallery -->
        <div class="space-y-1">
            <button class="flex items-center justify-between w-full text-gray-300 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200" onclick="toggleSubmenu('gallery-submenu')">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Gallery</span>
                </div>
                <svg class="w-4 h-4 transform transition-transform duration-200" id="gallery-submenu-arrow" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden pl-8 space-y-1" id="gallery-submenu">
                <a href="{{ route('admin.galleries.index') }}" class="flex items-center space-x-3 text-gray-400 p-2 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.galleries.*') ? 'bg-gray-700 text-white' : '' }}">
                    <span>All Images</span>
                </a>
                <a href="{{ route('admin.galleries.create') }}" class="flex items-center space-x-3 text-gray-400 p-2 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <span>Add Image</span>
                </a>
            </div>
        </div>
    </nav>
</div>
