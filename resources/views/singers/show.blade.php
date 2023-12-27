@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($singer->name) ? $singer->name : 'Singer' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('singers.singer.destroy', $singer->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('singers.singer.index') }}" class="btn btn-primary" title="Show All Singer">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('singers.singer.create') }}" class="btn btn-success" title="Create New Singer">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('singers.singer.edit', $singer->id ) }}" class="btn btn-primary" title="Edit Singer">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Singer" onclick="return confirm(&quot;Click Ok to delete Singer.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $singer->name }}</dd>
            <dt>Gender</dt>
            <dd>{{ $singer->gender }}</dd>
            <dt>Music Type</dt>
            <dd>{{ implode('; ', $singer->music_type) }}</dd>
            <dt>Is Retired</dt>
            <dd>{{ ($singer->is_retired) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection