<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<meta name="csrf-token" content="{{ csrf_token() }}">​
	
</head>
<body>
	<div class="table-responsive container">
		<table class="table table-hover">
			<a href="{{asset('')}}todos/create" class="btn btn-info">Add</a>
			<thead>
				<tr>
					<th>#</th>
					<th>Todo</th>
					<th>Created_at</th>
					<th>updated_at</th>
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($todos as $todo)
					<tr>
						<td>{{$todo->id}}</td>
						<td>{{$todo->todo}}</td>
						<td>{{$todo->created_at}}</td>
						<td>{{$todo->updated_at}}</td>
						<td>
							<a href="{{asset('')}}todos/{{$todo->id}}" class="btn btn-primary btn-sm">Show</a>
							<button type="" class="btn btn-success btn-sm">Edit</button>
							<form action="{{asset('')}}todos/{{$todo->id}}" method="post" >
								{{-- {{csrf_field()}} --}}
								{{-- {{method_field()}} --}}
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="_method" value="delete">
								<button type="submit" class="btn btn-info btn-sm">Delete</button>
							</form>
							
						</td>
					</tr>
				@endforeach
				
			</tbody>
		</table>
		
	</div>
</body>
<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script type="text/javascript" charset="utf-8">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$(document).ready(function () {
                    //code ajax ta sẽ viết ở đây
            })
	</script>
</html>