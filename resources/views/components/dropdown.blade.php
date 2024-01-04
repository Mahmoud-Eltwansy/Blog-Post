@props(['trigger'])

<div x-data="{show:false} " @click.away="show=false" class="relative">
    {{--Trigger--}}
    <div @click="show=!show">
        {{$trigger}}

    </div>
    {{--Dropdown Links--}}
    <div x-show="show" class="py-2 roundedn-xl absolute bg-gray-100 mt-2 w-full z-50 max-h-52 overflow-auto " style="display:none">
        {{$slot}}

    </div>


</div>
