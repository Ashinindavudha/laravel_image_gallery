@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@if (session()->has('error'))
	<p class="alert alert-success">{{ session('error') }}</p>
@endif
		<form action="{{route('avatar.store')}}" method="post" enctype="multipart/form-data">
			@csrf

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
				</div>
				<div class="custom-file">
					<input type="file" class="custom-file-input" name="avatar" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
					<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
				</div>
				<input type="submit" class="btn btn-outline-secondary" name="" value="Upload">
			</div>
			
		</form>
	</div>
	


<div class="card-columns">
	@foreach ($avatars as $avatar)
	<div class="card">
		<img src="{{ $avatar->getUrl('card') }}" class="card-img-top" alt="Card image cap">
		<div class="card-body">
			<div class="float-left">
				<a href="" onclick="event.preventDefault();document.getElementById('selectForm{{$avatar->id}}').submit()"><i class="fa fa-check fa-2x text-success"></i></a>
				<form action="{{route('avatar.update',auth()->id())}}" style="display: none;" id="selectForm{{$avatar->id}}" method="post">
					@csrf
					@method('put')
					<input type="hidden" name="selectedAvatar" type="submit" value="{{$avatar->id}}">
				</form>
				
				<a href=""><i class="fa fa-minus fa-2x text-danger" aria-hidden="true"></i></a></div>
			<div class="float-right">
				<a href=""><i class="fa fa-eye fa-2x text-info" aria-hidden="true"></i></a>
					<a href=""><i class="fa fa-download fa-2x text-primary" aria-hidden="true"></i></a></div>
		</div>
	</div>
@endforeach
</div>
</div>
@endsection