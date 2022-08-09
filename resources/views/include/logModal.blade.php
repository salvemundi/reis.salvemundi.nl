<div class="modal fade" id="auditModal{{$log->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$log->user->displayName . " heeft " . $log->description}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Uitgevoerd door: {{$log->user->displayName}}<br>
                Uitgevoerd op: {{ $log->created_at }}<br>
                <br>
                Log beschrijving: {{ $log->description }}<br>
            @switch($log->auditCategory)
                    @case(App\Enums\AuditCategory::BlogManagement)
                        Blog: {{$log->blog->name}}
                        Blog is gemaakt op: {{ $log->blog->created_at }}

                        <div class="mb-3">
                            <label for="blogdesc" class="form-label">Content:</label>
                            <textarea class="form-control" disabled id="blogdesc" rows="3">{{$log->blog->content}}</textarea>
                        </div>

                        @break
                    @case(App\Enums\AuditCategory::ScheduleManagement)
                        Event: {{ $log->schedule->name }}<br>
                        <div class="mb-3">
                            <label for="blogdesc" class="form-label">Beschrijving:</label>
                            <textarea class="form-control" disabled id="blogdesc" rows="3">{{$log->schedule->description}}</textarea>
                        </div>
                        <br>
                        Van: {{ $log->schedule->beginTime }}<br>
                        Tot: {{ $log->schedule->endTime }}
                        @break
                    @case(App\Enums\AuditCategory::ParticipantManagement)
                        @if(!$log->participant->purpleOnly)
                            Deelnemer: {{ $log->participant->getFullName() }}<br>
                            Is 18 jaar of ouder: {{ $log->participant->above18() }}<br>
                            Heeft betaald: {{$log->participant->hasPaid()}}<br>
                        @endif
                        Email: {{ $log->participant->email }}<br>
                        Fontys email: {{ $log->participant->fontysEmail }}

                        @break
                @endswitch
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
            </div>
        </div>
    </div>
</div>
