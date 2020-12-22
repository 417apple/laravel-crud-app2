@extends('app')

@section('title', $user->name)

@section('content')
    @include('nav')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                        <i class="fas fa-egg fa-3x mr-1"></i>
                    </a>
                    @if( Auth::id() !== $user->id )
                        <follow-button
                            class="ml-auto"
                            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
                        >
                        </follow-button>
                    @endif
                </div>
                <h2 class="h5 card-title m-0">
                    <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                        {{ $user->name }}
                    </a>
                </h2>
            </div>
            <div class="card-body">
                <div class="card-text">
                        {{ $user->count_followings }}  フォロー
                        {{ $user->count_followers }} フォロワー
                </div>
            </div>
        </div>
    </div>
@endsection
