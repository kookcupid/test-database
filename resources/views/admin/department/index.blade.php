<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดีคุณ {{Auth::user()->name}}          
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                สวัสดีคุณอยู่ที่ Department
            </div>
        </div>

    </div>
</x-app-layout>
