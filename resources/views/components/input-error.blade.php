@props(['field']) 
{{-- field es el nombre del campo que se va a mostrar el error --}}

 @error($field)
             <p class="text-red-600">{{ $message }}</p>
 @enderror
