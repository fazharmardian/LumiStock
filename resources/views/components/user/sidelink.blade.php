@props(['active' => false])

<a class="{{ $active ? 'bg-darkblue-200' : 'hover:bg-darkblue-200' }} flex items-center p-2 text-slate-200 rounded-lg group" {{ $attributes }}> 
    {{ $slot }}
</a>