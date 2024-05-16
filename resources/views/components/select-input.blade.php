@props([
    'id',
    'name',
    'options' => []
])

<select id="{{ $id }}" name="{{ $name }}" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>

    @foreach ($options as $key => $option)
        <option value="{{ $key }}">{{ $option }}</option>
    @endforeach

</select>
