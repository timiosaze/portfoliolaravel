@include('includes.header_index')
	<section class="profile">
		<div class="img">
			<img src="{{asset('app-assets/images/timipic.jpeg')}}" class="pic">
		</div>
		<div class="social-icons">
			<a href="#"><i class="fab fa-github fa-2x"></i></a>
			<a href="#"><i class="fab fa-linkedin fa-2x"></i></a>
		</div>
		<div class="profile-details">
			<p><span id="name">ADEGBULUGBE TIMILEHIN OSAZE</span><br>
			<span id="field">WEB DEVELOPER</span><br>
			<span id="skill">PHP | LARAVEL | BASIC FRONTEND</span></p>
		</div>
	</section>
	<section class="portfolio">
		<div class="container">
			<p id="header">Portfolio</p>
			<div class="row justify-content-around">
				<div class="red col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<a href="{{ url('/notes') }}">
					<div class="project ">
						<p>A <br> Simple Note App</p>
					</div>	
					</a>
				</div>
				<div class="red col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<a href="{{ url('/contacts') }}">
					<div class="project ">
						<p>A <br> Simple Contact App</p>
					</div>
					</a>
				</div>
				<div class="red col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<a href="{{ url('/meetings') }}">
						<div class="project ">
							<p>A <br> Day2Day Meeting App</p>
						</div>	
					</a>
				</div>
			</div>
		</div>
	</section>
</body>
@include('includes.footer')