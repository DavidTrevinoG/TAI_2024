<nav class="bg-gray-800 text-white w-64 min-h-screen px-4 py-6 flex flex-col">
    <!-- Logo -->
    <div class="flex flex-col items-center mb-6">
        <a href="{{ route('dashboard') }}" class="logo-link">
            <x-application-logo class="block h-16 w-auto fill-current text-gray-200" />
        </a>
        <div class="mt-4 w-full border-t border-gray-600"></div>
    </div>


    <div class="text-center mb-6">
        <x-dropdown align="right" width="full">
            <x-slot name="trigger">
                <button class="w-full flex justify-between items-center px-4 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-gray-700 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
        <div class="mt-4 w-full border-t border-gray-600"></div>
    </div>

    <!-- Navigation Links -->
    <div class="space-y-4 flex-1">

        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Dashboard') }}
        </a>

        <a href="{{ route('ventas.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('ventas.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Ventas') }}
        </a>
        <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('products.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Productos') }}
        </a>
        <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('categories.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Categorías') }}
        </a>
        <a href="{{ route('clientes.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('clientes.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Clientes') }}
        </a>
        <a href="{{ route('inventarios.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('inventarios.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Inventario') }}
        </a>
        <a href="{{ route('proveedores.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('proveedores.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Proveedores') }}
        </a>
        <a href="{{ route('formapago.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('formapago.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Forma de Pago') }}
        </a>
        <a href="{{ route('compras.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('compras.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Compras') }}
        </a>
        <a href="{{ route('vendedores.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('vendedores.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Vendedores') }}
        </a>
        <a href="{{ route('cotizaciones.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('cotizaciones.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            {{ __('Cotizaciones') }}
        </a>

    </div>
</nav>