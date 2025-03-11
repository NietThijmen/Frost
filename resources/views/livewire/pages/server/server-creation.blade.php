<div>
    @foreach($providers as $name)
        <flux:button wire:click="selectProvider('{{ $name }}')" class="btn btn-primary">{{ $name }}</flux:button>
    @endforeach


    @if($provider)
        <form>
            @foreach($formData as $name=>$field)
                <div class="my-4">
                    @switch($field['type'])
                        @case('select')
                            <flux:select  searchable wire:model.live="formValues.{{ $name }}" class="form-control" placeholder="{{$field['placeholder']}}">
                                @foreach($field['options'] as $id=>$option)
                                    <flux:select.option value="{{ $id }}">{{ $option }}</flux:select.option>
                                @endforeach
                            </flux:select>
                            @break

                        @default
                        <flux:input wire:model.live="formValues.{{ $name }}" type="{{ $field['type'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" />
                            @break

                    @endswitch
                </div>
            @endforeach

            <flux:button wire:click="createServer" class="btn btn-primary">Create Server</flux:button>
        </form>
    @endif
</div>
