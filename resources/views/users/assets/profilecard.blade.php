<div class="card shadow">
	<div class="card-body">
		<img class="rounded-circle shadow-sm w-100 img-fluid mb-3" src="{{ $user->avatar }}">
		<h2 class="card-title text-center mb-0">{{ $user->name }}</h2>
		<p class="text-muted text-center mb-0">
			{{ $user->username }}
		</p>
		@if (Auth::check() and (Auth::user() != $user))
			@if (Auth::user()->isFollowing($user))
				@if (Gate::allows('pm', $user))
				<div class="d-flex mt-2">
					<form class="d-flex flex-grow-1" action="/profile/{{ $user->username }}/unfollow" method="post">
						{{ csrf_field() }}
						<button class="btn btn-outline-primary btn-block mr-1">Unfollow</button>
					</form>
					<a href="/profile/{{ $user->username }}/messages" class="btn btn-primary">
						<i class="material-icons" style="vertical-align: middle;">mail_outline</i>
					</a>
				</div>
				@else
				<form action="/profile/{{ $user->username }}/unfollow" method="post">
					{{ csrf_field() }}
					<button class="btn btn-outline-primary btn-block mt-2">Unfollow</button>
				</form>
				@endif
			@else
				<form action="/profile/{{ $user->username }}/follow" method="post">
					{{ csrf_field() }}
					<button class="btn btn-primary btn-block mt-2">Follow</button>
				</form>
				@if (session('success'))
				<div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
					{{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
			@endif
		@endif
	</div>
	<ul class="list-group list-group-flush">
		<a href="/profile/{{ $user->username }}/" class="list-group-item list-group-item-action d-flex align-items-center">
			Photos <span class="badge badge-pill badge-primary ml-auto">{{ count($user->photos) }}</span>
		</a>
		<a href="/profile/{{ $user->username }}/followers" class="list-group-item list-group-item-action d-flex align-items-center">
			Followers <span class="badge badge-pill badge-primary ml-auto">{{ count($user->followers) }}</span>
		</a>
		<a href="/profile/{{ $user->username }}/following" class="list-group-item list-group-item-action d-flex align-items-center">
			Following <span class="badge badge-pill badge-primary ml-auto">{{ count($user->following) }}</span>
		</a>
	</ul>
</div>
