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
                <div class="container" >
                    <table class="table table-hover" style="margin-top: 10%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class= "text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $task)
                                
                            
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td>
                                <td>
                                    @if($task->status == 0)
                                        <span class="label label-default">In process</span>
                                    @else 
                                        <span class="label label-success">Done</span>
                                    @endif
                                </td>
                                <td class= "text-right">
                                    
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$task->id}}">View</button>
                                    <a href="{{ route('listtodo.edit',$task->id) }}" class="btn btn-sm btn-success">Edit</a>
                                    <button class="btn btn-sm btn-danger btndelete" >
                                        Delete
                                    </button>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>

            
            <form action="{{ route('listtodo.destroy',$task->id) }}" method="POST" id="form-delete">
                @csrf @method('DELETE')
            </form>
            
            <form action="{{ route('listtodo.show',$task->id) }}" method="GET" id="form-show">
               
            </form>
                
                        <!-- Modal -->
            
                
           
            @foreach ($data as $t)    
            <div class="modal fade" id="myModal{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title " style="text-align: center" id="myModalLabel">Task</h4>
                  </div>
                  <div class="modal-body">
                    <h4>Name : {{$t->name}}</h4><br>
                    <h4>Status : {{$t->status == 0? 'In process' : 'Done'}}</h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                  </div>
                </div>
              </div>
            </div>
            @endforeach


        </div>
        

        @if (Session::has('error'))
            
        <div class="alert alert-danger" style="margin:0 20%  0 ">
            <strong>{{ Session::get('error') }}</strong>
        </div>
        @endif
        @if (Session::has('success'))
            
        <div class="alert alert-success" style="margin:0 20%  0 ">
            <strong>{{ Session::get('success') }}</strong>
        </div>
        @endif
        
        
        
        
        
        
  

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $('.btndelete').click(function(ev){
                ev.preventDefault();               
                if(confirm('Bạn có chắc chắn muốn xoá không?')){
                    $('form#form-delete').submit();
                }
            });

           
            
        </script>
    </body>

</html>
