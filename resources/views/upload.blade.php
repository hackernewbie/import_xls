<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Excel File</title>
</head>
<body>
    <h2>Upload Excel File</h2>

    <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_xls" id="file_xls">

        <br/><br/>
        <button type="submit">Upload File</button>

        <br/>
        <br/>

        <p class="data" name="datacontainer">

        </p>
    </form>
    <br/><br/>
    @if(isset($errors))
        @if(count($errors) >0 )
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{$error}}
                </div>
            @endforeach
        @endif
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{session('error')}}
        </div>
    @endif
</body>
</html>
