
<style>
		.animated {
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
		}

		.animated.faster {
			-webkit-animation-duration: 500ms;
			animation-duration: 500ms;
		}

		.fadeIn {
			-webkit-animation-name: fadeIn;
			animation-name: fadeIn;
		}

		.fadeOut {
			-webkit-animation-name: fadeOut;
			animation-name: fadeOut;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}

		@keyframes fadeOut {
			from {
				opacity: 1;
			}

			to {
				opacity: 0;
			}
		}
	</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if(Session::has('msg'))
                <div class="text-2xl text-green-900 text-center" id="alert" style="display: block;">
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
                @if(count($users) > 0)
                <div class="overflow-x-auto">
                    <div class="min-w-screen min-h-screen bg-gray-100 flex justify-center bg-gray-100 font-sans overflow-hidden">
                        <div class="w-full lg:w-5/6">
                            <div class="bg-white shadow-md rounded my-6">
                                <table class="min-w-max w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                            <th class="py-3 px-6 text-left">Name</th>
                                            <th class="py-3 px-6 text-left">Role</th>
                                            <th class="py-3 px-6 text-left">Email</th>
                                            <th class="py-3 px-6 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 text-sm font-light">
                                    @foreach($users as $user)
                                    <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                            <td class="py-3 px-4 text-left">
                                                <div class="flex items-center">
                                                    
                                                    <span class="font-medium">{{$user->name}}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 text-left">
                                                <div class="flex items-center">
                                                    
                                                    <span class="font-medium"></span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                <div class="flex items-center">
                                                    
                                                    <span>{{$user->email}}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex item-center justify-center">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <a href="#ex3-{{$user->id}}" rel="modal:open">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="cursor: pointer">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        </a>
                                                    </div>
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <a href="#ex2-{{$user->id}}" rel="modal:open">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="cursor: pointer">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <h3>Create Awesome Blogs</h3>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- DELETE MODAL -->
@foreach($users as $user) 
<div id="ex2-{{$user->id}}" class="ex1 modal p-5">
<h3 class="text-red-700"><strong> Confirm elimination ! </strong></h3>
<i class="text-red-700">User - {{$user->name}}</i><hr>
<i class="text-red-700">Email - {{$user->email}}</i>
<div class="text-right">
    <a href="#" rel="modal:close" class="bg-gray-200 p-2 border-gray-800 rounded-lg border-2 mr-2">Close</a>
    <a href="{{route('user.destroy',$user->id)}}" class="bg-red-300 p-2 border-red-900 rounded-lg border-2 ml-2">Delete</a>
</div>
</div>

@endforeach
<!-- VIEW MODAL -->
@foreach($users as $user) 
<div id="ex3-{{$user->id}}" class="ex1 modal p-5">
<h3 class="text-blue-700"><strong> Meta data: {{$user->name}} </strong></h3>
<i class="text-green-700">{{$user->allPermissions()}}</i>
<div class="text-right">
    <a href="#" rel="modal:close" class="bg-gray-200 p-2 border-gray-800 rounded-lg border-2 mr-2">Close</a>
</div>
</div>

@endforeach