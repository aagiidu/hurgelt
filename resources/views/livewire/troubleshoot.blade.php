@section('title', __('Troubleshoot') )
<div>

    <x-baseview title="{{ __('Troubleshoot') }} ">
        <div class="grid grid-cols-1 gap-6 mt-10 md:grid-cols-2 lg:grid-cols-3">

            {{-- fix image --}}
            <x-settings-item title="{{__('Fix Image(Not Loading)')}}" wireClick="fixImage">
                <x-heroicon-o-photograph class="w-5 h-5 {{ isRTL() ? 'ml-4':'mr-4' }}" />
            </x-settings-item>
            {{-- fix image --}}
            <x-settings-item title="{{__('Clear Cache')}}" wireClick="fixCache">
                <x-heroicon-o-desktop-computer class="w-5 h-5 {{ isRTL() ? 'ml-4':'mr-4' }}" />
            </x-settings-item>

            {{-- fix notification --}}
            <x-settings-item title="{{__('Notification Error')}}" wireClick="fixNotification">
                <x-heroicon-o-bell class="w-5 h-5 {{ isRTL() ? 'ml-4':'mr-4' }}" />
            </x-settings-item>

            {{-- auto assignment --}}
            <x-settings-item title="{{__('Auto assignment')}}" wireClick="fixAutoassignment">
                <x-heroicon-o-bell class="w-5 h-5 rtl:ml-4 ltr:mr-4" />
            </x-settings-item>

            {{-- referal code --}}
            <x-settings-item title="{{__('User referral code')}}" wireClick="fixReferralCodes">
                <x-heroicon-o-cursor-click class="w-5 h-5 rtl:ml-4 ltr:mr-4" />
            </x-settings-item>

            {{-- role/permssions --}}
            <x-settings-item title="{{__('User roles/permissions')}}" wireClick="fixUserPermission">
                <x-heroicon-o-identification class="w-5 h-5 rtl:ml-4 ltr:mr-4" />
            </x-settings-item>



        </div>
    </x-baseview>

    <div x-data="{ open: @entangle('showCreate') }">
        <x-modal>
            <p class="text-xl font-semibold">{{ __('Auto Assignment checks') }}</p>
            <hr class="my-2" />
            @foreach ($autoAssignmentChecks as $key => $autoAssignmentCheck)
            <div class="flex items-center py-2 my-2 ">

                <div class="w-6/12">{{ Str::title(str_ireplace("_"," ", $key)) }}</div>
                <div class="w-full h-1 mx-2 border-b border-dashed"></div>
                <div class="text-white rounded-full p-1 {{ $autoAssignmentCheck?'bg-green-500':'bg-red-500' }}">
                    @if ($autoAssignmentCheck)
                    <x-heroicon-o-check class="w-4 h-4 " />
                    @else
                    <x-heroicon-o-x class="w-4 h-4" />
                    @endif
                </div>

            </div>
            @endforeach
        </x-modal>
    </div>


</div>
