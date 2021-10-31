<?php
    $menu = config('menu');
    
?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>App Todo</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1 class="text-center">App Todo</h1>
        <div class="row">
            <div class="col md-3">
                <ul style="list-style-type: none;">
                    @foreach ($menu as $m)
                        
                   
                    <li>
                        <a href="{{ route($m['route']) }}">{{ $m['label'] }}</a>
                    </li>
                    @endforeach
                    
                </ul>
            </div>
            <div class="col md-7">
                <div class="container">
                    <form action="{{ route('listtodo.update',$data->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $data->name }}" class="form-control" >
                            @error('name')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                        </div>                        
                        
                        <div class="form-group">
                            <label>Status</label><br>
                            <input type="radio"  name="status" value="0" checked>
                            <label for="css">In process</label><br>
                            <input type="radio"  name="status" value="1">
                            <label for="css">Done</label>
                            @error('status')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" >SAVE</button>
                    </form>
                </div>
              
        
        
            </div>
        </div>
        
        
        
        
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $('.btndelete').click(function(ev){
                ev.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-delete').attr('action',_href);

                if(confirm('Bạn có chắc chắn muốn xoá không?')){
                    $('form#form-delete').submit();
                }
            })
        </script>
    </body>

</html>
