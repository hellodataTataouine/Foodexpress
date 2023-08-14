@foreach ($options as $option)
    <option value="{{ $option->id }}">{{ $option->nom_option }}</option>
@endforeach