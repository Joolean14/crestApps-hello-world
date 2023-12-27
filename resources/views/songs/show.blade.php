@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($song->title) ? $song->title : 'Song' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('songs.song.destroy', $song->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('songs.song.index') }}" class="btn btn-primary" title="Show All Song">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('songs.song.create') }}" class="btn btn-success" title="Create New Song">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('songs.song.edit', $song->id ) }}" class="btn btn-primary" title="Edit Song">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Song" onclick="return confirm(&quot;Click Ok to delete Song.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $song->title }}</dd>
            <dt>Album</dt>
            <dd>{{ $song->album }}</dd>
            <dt>Singer</dt>
            <dd>{{ optional($song->singer)->name }}</dd>
            <dt>Release Year</dt>
            <dd>{{ $song->release_year }}</dd>
            <dt>Song Category</dt>
            <dd>{{ optional($song->songCategory)->name }}</dd>
            <dt>File</dt>
            <dd>{{ asset('storage/' . $song->file) }}</dd>

        </dl>

    </div>
</div>

@endsection