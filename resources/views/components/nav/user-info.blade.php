@props(['user', 'mobile' => false])

<div {{ $attributes->merge(['class' => $mobile ? '' : 'text-right leading-1']) }}>
    <div class="font-medium {{ $mobile ? 'text-base text-gray-800' : 'text-sm text-gray-500' }}">
        {{ $user->name }}
    </div>
    <div
        class="font-medium {{ $mobile ? 'text-sm text-gray-500' : 'text-slate-400 text-[10px] uppercase tracking-wider font-bold' }}">
        {{ $user->role->label() }}
    </div>
</div>
