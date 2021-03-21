@extends($hostname.".la.layouts.app")
@section('main-content')
<div class="box box-success">
    <div class="thrust-index-header description">
        <span class="thrust-index-title title">
            @if (isset($parent_id) )
                @php $parent = $resource->parent($parent_id) @endphp
                <a href="{{route('thrust.index', [app(\BadChoice\Thrust\ResourceManager::class)->resourceNameFromModel($parent) ]) }}">{{ $parent->name }} </a> /
            @endif
            {{ trans_choice(config('thrust.translationsPrefix') . str_singular($resourceName), 2) }}
            ({{ $resource->rows()->total() }})
        </span>
        <br><br>
        @include('thrust::components.mainActions')
        {!! $description ?? "" !!}

        @include('thrust::components.search')
        <div class="pb1 text-right thrust-actions">
            @include('thrust::components.filters')
            @include('thrust::components.actions')
        </div>

    </div>

    <div id="all">
        {!! (new BadChoice\Thrust\Html\Index($resource))->show() !!}
    </div>
    <div id="results"></div>
 </div>
@stop

@section('supporttickets_scripts_custom')
    @parent
    @if ($searchable)
        @include('thrust::components.searchScript', ['resourceName' => $resourceName])
    @endif
    @include('thrust::components.js.actions', ['resourceName' => $resourceName])
    @include('thrust::components.js.filters', ['resourceName' => $resourceName])
    @include('thrust::components.js.editInline', ['resourceName' => $resourceName])

@stop

@section('supporttickets_styles')
<link href="https://fonts.googleapis.com/css?family=Lato:300,500" rel="stylesheet">
<link href="{{ asset('css/supportdesk.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@stop

@section('supporttickets_scripts_main')
<script src="{{ asset('js/supportdesk.js') }}"></script>
@stop