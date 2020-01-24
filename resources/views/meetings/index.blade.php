@include('includes.header')
	<section class="container">
		
	<section class="header">
		<div class="header-topic container-fluid">
			<p>New Appointment</p>
		</div>
		<div class="post">
            <form class="container-fluid" method="post" action={{ route('meetings.store') }}>
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
				    <label for="exampleFormControlTextarea1">Meeting</label>
				    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="New Meeting" rows="3" name="meeting"></textarea>
				</div>
				<div class="form-group clockpicker">
				    <label for="exampleFormControlTextarea1">Meeting Date</label>
					<input type="text" class="form-control clockpicker" name="meeting_date">
				    <span class="input-group-addon">
				        <span class="glyphicon glyphicon-time"></span>
				    </span>
				</div>
				<button type="submit" class="btn btn-dark">Submit</button>
			</form>
		</div> 
	</section>
	<section class="header">
		<div class="header-topic container-fluid">
			<p>APPOINTMENTS(click to edit or delete)</p>
        </div>
        @if ($meetings->count() == 0)
            <h5>No Meeting Has Been Created</h5>
        @else
        
        @foreach ($meetings as $the_meeting)
        
		<div class="element-group">
			<div class="element">
				<div class="container">
					<div class="row">
						<div class="col-10 appoint_title">
							<p> {{$the_meeting->meeting}}</p>
						</div>
						<div class="col-2 time_date">
							<div class="col appoint_time">
								<p>{{ date('g:ia',strtotime($the_meeting->meeting_date)) }}</p>
							</div>
							<div class="col appoint_date">
								<p>{{ date('M j, Y',strtotime($the_meeting->meeting_date)) }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container actions">
				<div class="row inside-container">
					<div class="col">
						<form id="editForm" class="edit-form">
							<!-- <span class="time">11:34pm</span> -->
                            <a href="{{ route('meetings.edit', $the_meeting->id) }}">EDIT</a>
							<!-- <button type="button" class="btn btn-secondary btn-sm">Edit</button>	 -->
						</form>
					</div>
					<div class="col">
						<form id="deleteForm-{{$the_meeting->id}}" class="delete-form" method="post" action="{{route('meetings.destroy', $the_meeting->id)}}">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:{}" onclick="document.getElementById('deleteForm-{{$the_meeting->id}}').submit();">DELETE</a>
							<!-- <button type="button" class="btn btn-secondary btn-sm">Edit</button>	 -->
						</form>
					</div>
				</div>
			</div>

        </div>
            
        @endforeach
            
        @endif
		{{ $meetings->links() }}
	</section>
    
	</section>
</body>
@include('includes.footer')