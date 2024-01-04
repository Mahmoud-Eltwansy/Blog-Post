@props(['name','placeholder'=>''])

<x-form.field>
    <x-form.label name="{{$name}}"/>
    <textarea
        name="{{$name}}"
        id="{{$name}}"
        rows="5"
        class="w-full text-sm border border-gray-200 rounded "
        placeholder="{{$placeholder}}"
        required
    >{{$slot?? old($name)}}</textarea>

    <x-form.error name="{{$name}}"/>
</x-form.field>
