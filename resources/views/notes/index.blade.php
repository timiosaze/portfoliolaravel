@include('includes.header')
	<section class="container">
	<section class="header">
		<div class="header-topic container-fluid">
			<p>Add New Note</p>
		</div>
		<div class="post">
            <form class="container-fluid" method="post" action="{{ route('notes.store') }}">
				@csrf
				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif
				@if(session('error'))
					<div class="alert alert-danger">
						{{ session('error') }}
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
				@endif
				<div class="form-group">
				    <!-- <label for="exampleFormControlTextarea1">Example textarea</label> -->
				    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="New Note" rows="3" name="note"></textarea>
				</div>
				<button type="submit" class="btn btn-dark">Submit</button>
			</form>
		</div> 
	</section>
	<section class="header">
		<div class="header-topic container-fluid">
			<p>NOTES(click to edit or delete)</p>
		</div>
		@if ($notes->count() == 0)
				<h5>No Note yet created</h5>
		@else
		@foreach ($notes as $the_note)
			
			
			<div class="element-group">
				<div class="element">
					<p>{{$the_note->note}} <br> 
					<span class="time">{{$the_note->updated_at->format('M j Y')}} | {{$the_note->updated_at->format('g:ia')}}</span>
					</p>
				</div>
				<div class="container actions">
					<div class="row inside-container">
						<div class="col">
							<form id="editForm" class="edit-form">
								<!-- <span class="time">11:34pm</span> -->
								<a href="{{ route('notes.edit',$the_note->id) }}" >EDIT</a>
								<!-- <button type="button" class="btn btn-secondary btn-sm">Edit</button>	 -->
							</form>
						</div>
						<div class="col">
							<form id="deleteForm-{{ $the_note->id }}" class="delete-form" action="{{ route('notes.destroy', $the_note->id)}}" method="post" >
								<!-- <span class="time">11:34pm</span> -->
								@csrf
                  				@method('DELETE')
								<a href="javascript:{}" onclick="document.getElementById('deleteForm-{{ $the_note->id }}').submit();">DELETE</a>
								<!-- <button type="button" class="btn btn-secondary btn-sm">Edit</button>	 -->
							</form>
						</div>
					</div>
				</div>

			</div>
		@endforeach
		@endif
		{{ $notes->links() }}
	</section>
	
	</section>
</body>
@include('includes.footer')