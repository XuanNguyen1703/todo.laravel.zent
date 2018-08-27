<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Todo</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<style type="text/css" media="screen">
		body{
			margin-top: 30px;
		}
	</style>
</head>
<body>
	<div class="container">
		<a {{-- href="{{asset('')}}todos-ajax/store" --}} type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-success btn-add">Add</a>

		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Todo</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					{{-- biến $todos được controller trả cho view
					chứa dữ liệu tất cả các bản ghi trong bảng todos. Dùng foreach để hiển
					thị từng bản ghi ra table này. --}}
					
					@foreach ($todos as $todo)
					<tr>
						<td>{{$todo->id}}</td>
						<td>{{$todo->todo}}</td>
						<td>{{$todo->created_at}}</td>
						<td>{{$todo->updated_at}}</td>
						<td>
							<button data-url="{{asset('')}}todos-ajax/{{$todo->id}}" type="button" data-toggle="modal" data-target="#show" class="btn btn-info btn-show">Details</button>
							<button data-url="{{asset('')}}todos-ajax/{{$todo->id}}" type="button" class="btn btn-warning btn-edit">Edit</button>
							<button data-url="{{asset('')}}todos-ajax/{{$todo->id}}" type="button" class="btn btn-danger btn-delete">Delete</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
{{-- Modal show chi tiết todo --}}
	<div class="modal fade" id="show">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Detail</h4>
				</div>
				<div class="modal-body" style="text-align: center;">
					{{-- <h2>Todo:</h2>
					<h3 id="todo-show"></h3> --}}
					<h1 id="todo"></h1>
					<h1 id="created_at"></h1>
					<h1 id="updated_at"></h1>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	{{-- Modal thêm mới todo --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="" data-url="{{ route('todos-ajax.store') }}" id="form-add" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add todo</h4>
			</div>
			<div class="modal-body">
				
					<div class="form-group">
						<label for="">Todo</label>
						<input type="text" class="form-control" id="todo-add" placeholder="Todo">
					</div>
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
			</div>
			</form>
		</div>
	</div>
</div>

	{{-- Modal sửa todo --}}
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="" id="form-edit" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit todo</h4>
			</div>
			<div class="modal-body">
				
					<div class="form-group">
						<label for="">Todo</label>
						<input type="text" class="form-control" id="todo-edit" placeholder="Todo">
					</div>
				
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				
			</div>
			</form>
		</div>
	</div>
</div>

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
			//bắt sự kiện click vào nút show
			$('.btn-show').click(function () {
				//hiện modal show lên
				//$('#show').modal('show');
				//lấy dữ liệu từ attribute data-url lưu vào biến url
				var url=$(this).attr('data-url');
				$.ajax({
					//sử dụng phương thức get
					type: 'get',
					url: url,
					//nếu thực hiện thành công thì chạy vào success
					success: function (response) {
						console.log(response)
						//hiển thị dữ liệu được controller trả về vào trong modal
						$('#todo').text(response.data.todo);
						$('#created_at').text(response.data.created_at);
						$('#updated_at').text(response.data.updated_at);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
			})
			$('#form-add').submit(function (e) {
				e.preventDefault();
				//lấy attribute data-url của form lưu vào biến url
				var url=$(this).attr('data-url');
				$.ajax({
					//sử dụng phương thức post
					type: 'post',
					url: url,
					data: {
						//lấy dữ liệu từ ô input trong form thêm mới
						todo: $('#todo-add').val(),
					},
					success: function (response) {
						toastr.success('Add new todo success!')
						//ẩn modal add đi
						$('#modal-add').modal('hide');
						setTimeout(function () {
							window.location.href="{{ route('todos-ajax.index') }}";
						},800);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
			})
			$('.btn-delete').click(function () {
				//lấy attribute data-url của nút xoá lưu vào url
				var url=$(this).attr('data-url');
				if (confirm("Are you sure?")){
				$.ajax({
					//sử dụng phương thức get
					type: 'delete',
					url: url,
					//nếu thực hiện thành công thì chạy vào success
					success: function (response) {
						toastr.warning('delete todo success!')
						setTimeout(function () {
					window.location.href="{{ route('todos-ajax.index') }}";
				},800);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
				}
			})

			//bắt sự kiện click vào nút edit
			$('.btn-edit').click(function (e) {
				//mở modal edit lên
				$('#modal-edit').modal('show');
				e.preventDefault();
				//lấy data-url của nút edit
				var url=$(this).attr('data-url');
				$.ajax({
					//phương thức get
					type: 'get',
					url: url,
					success: function (response) {
						//đưa dữ liệu controller gửi về điền vào input trong form edit.
						$('#todo-edit').val(response.data.todo);
						//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
						$('#form-edit').attr('data-url','{{ asset('todos-ajax/') }}/'+response.data.id)
					},
					error: function (error) {
						
					}
				})
			})

			$('#form-edit').submit(function (e) {
				e.preventDefault();
				var url=$(this).attr('data-url');
				$.ajax({
					//phương thức put
					type: 'put',
					url: url,
					//lấy dữ liệu trong form
					data: {
						todo: $('#todo-edit').val(),
					},
					success: function (response) {
						toastr.success('edit todo success!')
						$('#modal-edit').modal('hide');
						setTimeout(function () {
							window.location.href="{{ route('todos-ajax.index') }}";
						},800);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//xử lý lỗi tại đây
					}
				})
			})
		})
	</script>
</body>

</html>