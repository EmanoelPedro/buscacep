@props([
  'disabled' => false,
  'placeholder' => ''

])

<input {{ $disabled ? 'disabled' : '' }} placeholder="{{$placeholder}}" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
