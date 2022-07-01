<div class="modal fade" id="edit{{ $participant->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if($participant->insertion)
                    <h5 class="modal-title" id="exampleModalLabel">{{ $participant->firstName." ".$participant->insertion." ".$participant->lastName}} </h5>
                @else
                    <h5 class="modal-title" id="exampleModalLabel">{{ $participant->firstName." ".$participant->lastName}} </h5>
                @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
