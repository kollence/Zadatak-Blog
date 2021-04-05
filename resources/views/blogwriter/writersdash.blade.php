
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Blog Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(Session::has('msg'))
                <div class="text-green-900">
                    {{Session::get('msg')}}
                </div>
                @endif
                <div class="px-6 bg-white border-b border-gray-200">
                
                    <div class="px-5">
                        <img id="imgHolder" width="500" alt="">
                        <button class="btn bg-red-500 p-3 mt-3" onclick="removeImage()" id="removeBtn" style="display: none;">Remove Image</button>
                    </div>

                    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" >
                    @csrf
                        <div class="mb-4">
                            <label class="text-xl text-gray-600">Image</label></br>
                            <input type="file" class="border-2 border-gray-300 p-2 w-full" name="img" id="img" placeholder="(Optional)" onchange="showImage(this)"></input>
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600">Title <span class="text-red-500">*</span></label></br>
                            <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" value="" required></input>
                        </div>

                        <div class="mb-8">
                            <label class="text-xl text-gray-600">Content <span class="text-red-500">*</span></label></br>
                            <textarea name="content" class="border-2 border-gray-500">
                                
                            </textarea>
                        </div>

                        <div class="flex p-1">
                            <select class="border-2 border-gray-300 border-r p-2" name="action">
                                <option>Save and Publish</option>
                                <option>Save Draft</option>
                            </select> 
                            <button role="submit" class="p-3 bg-blue-500 text-white hover:bg-blue-400" required>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'content' );

        function showImage(input) {
            const file = $("input[type=file]").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = () => {
                    $("#imgHolder").attr("src", reader.result)
                    $("#removeBtn").show();
                }
                reader.readAsDataURL(file)
            }
        }
        function removeImage() {
            // $('#img').replaceWith( img = img.clone( true ) );
            $("input[type=file]").val('');

            $("#imgHolder").attr('src', '')
            $("#removeBtn").hide();
        }
    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>