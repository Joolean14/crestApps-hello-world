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
                <h4 class="mt-5 mb-5">Singers</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('singers.singer.create') }}" class="btn btn-success" title="Create New Singer">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($singers) == 0)
            <div class="panel-body text-center">
                <h4>No Singers Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Music Type</th>
                            <th>Is Retired</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($singers as $singer)
                        <tr>
                            <td>{{ $singer->name }}</td>
                            <td>{{ $singer->gender }}</td>
                            <td>{{ implode('; ', $singer->music_type) }}</td>
                            <td>{{ ($singer->is_retired) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('singers.singer.destroy', $singer->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('singers.singer.show', $singer->id ) }}" class="btn btn-info" title="Show Singer">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('singers.singer.edit', $singer->id ) }}" class="btn btn-primary" title="Edit Singer">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Singer" onclick="return confirm(&quot;Click Ok to delete Singer.&quot;)">
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
            {!! $singers->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection