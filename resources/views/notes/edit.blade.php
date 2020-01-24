@include('includes.header')
	<section class="container">
	<section class="header">
		<div class="header-topic container-fluid">
			<p>Add New Note</p>
		</div>
		@if (Auth::id() === $notes->user_id)
		<div class="post">
            <form class="container-fluid" method="post" action="{{ route('notes.update', $notes->id) }}">
				@csrf
				@method('PUT')
				{{-- @if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif --}}
				<div class="form-group">
				    <!-- <label for="exampleFormControlTextarea1">Example textarea</label> -->
				    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="New Note" rows="3" name="note">{{$notes->note}}</textarea>
				</div>
				<button type="submit" class="btn btn-dark">Submit</button>
			</form>
		</div> 
		@else
			<h5>You are not the owner of this contact</h5>
		@endif
	</section>
	
	</section>
</body>
@include('includes.footer')