@props(['disabled' => false])

<input style="background: transparent;
              border-color: #007eff;" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
