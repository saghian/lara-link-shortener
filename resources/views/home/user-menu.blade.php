<div class="flex items-center space-x-4">
    <span class="text-white text-sm bg-white/20 px-3 py-1 rounded-full">
        {{ Auth::user()->name }}
    </span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 shadow-lg transform hover:scale-105">
            Logout
        </button>
    </form>
</div>
