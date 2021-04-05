<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Single Blog Post
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="grid grid-cols-3 gap-4">
                <div class="..."> <img src="{{ asset('storage/'.$blog->img) }}" width="300" alt=""></div>
                <div class="col-span-2 ...">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ $blog->title }}</h2>
                    <div class="py-4">
                    {{strip_tags($blog->content)}}
                    </div>
                    <p class="items-end ">Created by: <i class="text-purple-700">{{$blog->user->name}}</i></p>
                </div>
                @if(Session::has('msg'))
                <div class="text-2xl text-green-900" id="alert" style="display: block;">
                    {{Session::get('msg')}}
                </div>
                   <script>
                       if($('#alert').css('display') == 'block') { 
                        setInterval(()=>{
                            $('#alert').hide('slow'); 
                        },3000)
                        }
                   </script>
                @endif

            </div>
            </div>
        </div>
    </div>
</x-app-layout>