<div class="p-6">
    <x-danger-button wire:click='dispatchEvent'>
        {{ __('Create Event') }}
    </x-danger-button>

    @forelse ($unreadnotifications as $notify)
        <div class="bg-green-300 p-3 m-2">
            <b>{{$notify->data['name']}}</b> started following you!!
            <x-button wire:click.prevent='markAsRead(`{{$notify->id}}`)'>
                {{ __('Create Event') }}
            </x-button>
        </div>
    @empty
        <div class="bg-gray-200 p-3 m-2">
            No notifications!!!
        </div>
    @endforelse
</div>
