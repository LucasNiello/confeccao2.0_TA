<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition']) }}>
    {{ $slot }}
</button>
