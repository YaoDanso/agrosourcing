@if($errors->all())
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
	</div>
@endif
@if (session('success'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{ session('success') }}
	</div>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="successToast"
         style="position: absolute; top: 5%; right: 5%;">
        <div class="toast-header">
            <strong class="mr-auto">Success message</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{ session('error') }}
	</div>
@endif
