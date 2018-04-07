@extends('layouts.app')

@push('scripts')
    <script>
        $(function () {
            @foreach($lanes as $lane)
            Sortable.create(sortable{{ $lane->id }}, {
                group: 'boardItems',
                animation: 150,
                ghostClass: "sortable-ghost",
                store: {
                    /**
                     * Get the order of elements. Called once during initialization.
                     * @param   {Sortable}  sortable
                     * @returns {Array}
                     */
                    get: function (sortable) {
                        var order = localStorage.getItem(sortable.options.group.name);
                        return order ? order.split('|') : [];
                    },

                    /**
                     * Save the order of elements. Called onEnd (when the item is dropped).
                     * @param {Sortable}  sortable
                     */
                    set: function (sortable) {
                        var order = sortable.toArray();
                        localStorage.setItem(sortable.options.group.name, order.join('|'));
                    }
                }
            });
            @endforeach
        })
    </script>
@endpush

@section('content')
    <div class="container-fluid align-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="board-wrapper">
                    <div class="board-container">
                        <div class="board-item-row">
                            <div>
                                @foreach($lanes as $lane)
                                    <div class="board-item-wrapper">
                                        <div class="board-item">
                                            <div class="card">
                                                <div class="card-header">{{ $lane->title }}</div>

                                                <div class="card-body" id="sortable{{ $lane->id }}">
                                                    @foreach($lane->issues as $issue)
                                                        <div class="card mb-3">
                                                            <div class="card-header d-flex">
                                                                <div class="mr-auto">
                                                                    <a href="{{ route('showIssue', $issue) }}">
                                                                        #{{ $issue->id }} - {{ $issue->title }}
                                                                    </a>
                                                                </div>

                                                                @can('update', $issue)
                                                                    <div>
                                                                        <a href="{{ route('editIssue', $issue) }}">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                @endcan
                                                            </div>

                                                            <div class="card-body">
                                                                <div class="issue-meta-data-preview">
                                                                    <small>
                                                                        Created by <a href="#">{{ $issue->creator->name }}</a>
                                                                        {{ $issue->created_at->diffForHumans() }} in
                                                                        <a href="{{ route('showLane', $issue->lane) }}">{{ $issue->lane->title }}</a>
                                                                    </small>
                                                                </div>

                                                                <div class="issue-description-preview">
                                                                    {{ str_limit($issue->description, 50) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
