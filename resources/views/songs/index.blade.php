@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Songs</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('songs.song.create') }}" class="btn btn-success" title="Create New Song">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($songs) == 0)
            <div class="panel-body text-center">
                <h4>No Songs Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Album</th>
                            <th>Singer</th>
                            <th>Release Year</th>
                            <th>Song Category</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($songs as $song)
                        <tr>
                            <td>{{ $song->title }}</td>
                            <td>{{ $song->album }}</td>
                            <td>{{ optional($song->singer)->name }}</td>
                            <td>{{ $song->release_year }}</td>
                            <td>{{ optional($song->songCategory)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('songs.song.destroy', $song->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('songs.song.show', $song->id ) }}" class="btn btn-info" title="Show Song">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('songs.song.edit', $song->id ) }}" class="btn btn-primary" title="Edit Song">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Song" onclick="return confirm(&quot;Click Ok to delete Song.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $songs->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection