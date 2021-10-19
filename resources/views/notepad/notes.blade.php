@extends('layout')
@section('content')
    <div class="container my-5">
        <div class="card text-left">
          <div class="card-body">
            <div class="d-flex justify-content-between">
                @if ($content)
                    <input type="hidden" id="notes-id" value="{{$content ? $content->id : 0}}">                    
                @endif
                <h4 class="card-title my-2"> Your Notes Here !</h4> 
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Notepad Pro</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{route('notes.index')}}"><i class="fa fa-plus"></i> New Note</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn" id="clear-button"><i class="fa fa-trash"></i> Clear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn"><i class="fa fa-lock"></i> Set Password</a>
                            </li>
                        </ul>
                    </div>
              </nav> 
            </div>
            <textarea id="main-content">
                {{$content ? $content->notes : ""}}
            </textarea>
          </div>
        </div>
        @if ($content)
            <div class="text-center p-4">
                <button type="button" name="" id="update-btn" class="btn btn-primary">Update</button> 
            </div>
        @else
            <div class="text-center p-4">
                <button type="button" name="" id="save-btn" class="btn btn-primary">Create & Save</button> 
            </div>
        @endif
    </div>
@stop
@section('scripts')
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>

        var editor = CKEDITOR.replace('main-content');

        setInterval(function() {
            setData();
        }, 5000);

        $(document).ready(function(){

            editor.on('change', function() { 
                if ($("#notes-id").val()) {
                    var notes_id = $("#notes-id").val();
                    updateData(notes_id);
                }
            });

            $("#clear-button").click(function () {
                clearData();
            });

            $("#save-btn").click(function () {
                storeData();
            });

        });
        

        function storeData() {
            var data = editor.getData();
            $.ajax({
                data : {
                    'data' : data
                },
                url: "{{route('notes.saveData')}}",
                type: "GET",
                success: function(data) {
                    window.location.href = "/notes/"+data.id;
                }
            });
        }

        function setData(){
            var notes_id = $("#notes-id").val();
            $.ajax({
                data : {
                    'id' : notes_id
                },
                url: "{{route('notes.getData')}}",
                type: "GET",
                success: function(data) {
                    editor.setData(data.notes);
                }
            });
        }

        function clearData() {
            editor.setData("");
        }

        function updateData(notes_id) {
            var data = editor.getData();
            $.ajax({
                data : {
                    'id' : notes_id,
                    'data' : data
                },
                url: "{{route('notes.updateData')}}",
                type: "GET",
            });
        }
    
    </script>
@stop