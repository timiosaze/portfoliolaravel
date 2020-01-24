@include('includes.header')
	<section class="container">
		
	<section class="header">
		<div class="header-topic container-fluid">
			<p>Add New Contact</p>
		</div>
		<div class="post">
            <form class="container-fluid" method="post" action="{{route('contacts.store')}}">
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
			    <label for="contact_name">Name</label>
			    <input type="text" class="form-control" id="contact_name" name="name" placeholder="Enter name">
			  </div>
			  <div class="form-group">
			    <label for="phonenumber">Phone Number</label>
			    <input type="number" class="form-control" id="phonenumber" placeholder="Phone number" name="phonenumber">
			  </div>
			  <button type="submit" class="btn btn-dark">Submit</button>
			</form>
		</div> 
	</section>
	<section class="header">
		<div class="header-topic container-fluid">
			<p>NUMBERS(click to edit | delete)</p>
        </div>
        @if ($contacts->count() == 0)
            <h5>Contacts Not yet created</h5>
        @else
        @foreach ($contacts as $contact)
		<div class="element-group">
			<div class="element">
				<div class="container">
					<div class="row">
						<div class="col contact_name">
							<p>{{$contact->name}}</p>
						</div>
						<div class="col contact_number">
							<p>{{$contact->phonenumber}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="container actions">
				<div class="row inside-container">
					<div class="col">
						<form id="editForm" class="edit-form">
							<a href="{{ route('contacts.edit', $contact->id) }}">EDIT</a>
						</form>
					</div>
					<div class="col">
					<form id="deleteForm-{{ $contact->id }}" class="delete-form" method="post" action="{{ route('contacts.destroy', $contact->id) }}">
							@csrf
							@method('DELETE')
							<a href="javascript:{}" onclick="document.getElementById('deleteForm-{{ $contact->id }}').submit();">DELETE</a>
						</form>
					</div>
				</div>
			</div>
        </div>
        @endforeach
		@endif
	</section>
	
	</section>
</body>
@include('includes.footer')