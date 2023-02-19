<div class="modal fade" id="deleteActivity{{ $activity->id }}From{{$participant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 850px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $activity->name }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Weet je zeker dat je activiteit "{{$activity->name}}" wil ontkoppelen van deelnemer {{ $participant->firstName }} {{$participant->insertion ?? null}} {{ $participant->lastName }}?</p>
            </div>
                <form method="POST" action="/participants/{{ $participant->id }}/activity/{{ $activity->id }}/del">
                @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluit</button>
                    <button type="submit" class="btn btn-danger">Ontkoppel</button>
                </div>
            </form>
        </div>
    </div>
</div>
