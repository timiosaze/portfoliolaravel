@include('includes.header')
	<section class="container">
		
	<section class="header">
		<div class="header-topic container-fluid">
			<p>Add New Contact</p>
		</div>
		@if (Auth::id() === $contact->user_id)
			<div class="post">
				<form class="container-fluid" method="post" action="{{route('contacts.update', $contact->id)}}">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label for="contact_name">Name</label>
					<input type="text" class="form-control" id="contact_name" name="name" placeholder="Enter name" value="{{$contact->name}}">
				</div>
				<div class="form-group">
					<label for="phonenumber">Phone Number</label>
					<input type="number" class="form-control" id="phonenumber" placeholder="Phone number" name="phonenumber" value={{$contact->phonenumber}}>
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