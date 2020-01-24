@include('includes.header')
	<section class="container">
		<section class="header">
			<div class="header-topic container-fluid">
				<p>New Appointment</p>
			</div>
			@if (Auth::id() === $the_meeting->user_id)
				
			<div class="post">
				<form class="container-fluid" method="post" action={{ route('meetings.update', $the_meeting->id) }}>
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Meeting</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" placeholder="New Meeting" rows="3" name="meeting">{{$the_meeting->meeting}}</textarea>
					</div>
					<div class="form-group clockpicker">
						<label for="exampleFormControlTextarea1">Meeting Date</label>
						<input type="text" class="form-control clockpicker" name="meeting_date" value="{{$the_meeting->meeting_date}}">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-time"></span>
						</span>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
				</form>
			</div> 
			@else 
				<h5>You are not the owner of this meeting</h5>
			@endif
		</section>
	</section>
</body>
@include('includes.footer')