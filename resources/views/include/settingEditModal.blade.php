<div class="modal fade" id="edit{{ $setting->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 850px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $setting->description }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/settings/{{ $setting->id }}/store">
                @csrf
                <div class="modal-body">
                    @switch($setting->valueType)
                        @case(App\Enums\SettingTypes::boolean()->value)
                                <label for="booleanValue" class="form-label">Aan/uit:</label>
                                <select class="form-select mb-1" id="booleanValue" name="value" aria-label="Default select example">
                                    @if($setting->value)
                                        <option selected value="true">True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="true">True</option>
                                        <option selected value="false">False</option>
                                    @endif
                                </select>
                            @break
                        @case(App\Enums\SettingTypes::string()->value)
                            <div class="mb-3">
                                    <label for="stringValue" class="form-label">Waarde:</label>
                                    <input type="text" name="value" class="form-control" id="stringValue" placeholder="Enter value">
                            </div>
                            @break
                        @case(App\Enums\SettingTypes::integer()->value)
                            <div class="mb-3">
                                    <label for="numberValue" class="form-label">Waarde:</label>
                                    <input type="number" name="value" class="form-control" id="numberValue" placeholder="Enter value">
                            </div>
                            @break
                        @case(App\Enums\SettingTypes::date()->value)
                            <div class="mb-3">
                                    <label for="dateValue" class="form-label">Datum:</label>
                                    <input type="date" name="value" class="form-control" value="{{ \Carbon\Carbon::parse($setting->value)->format('Y-m-d') }}" id="dateValue" placeholder="Enter value">
                            </div>
                            @break
                    @endswitch
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluit</button>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>
