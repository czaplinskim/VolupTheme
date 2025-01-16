@props(['size' => 'small'])

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 100 100"
    preserveAspectRatio="none"
    class="h-full lg:h-auto"
>
    @if ($size === 'full')
        <line x1="20" y1="0" x2="20" y2="30" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="20" y1="30" x2="50" y2="30" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="0" y1="50" x2="50" y2="50" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="50" y1="0" x2="50" y2="50" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="50" y1="50" x2="50" y2="100" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
    @else
        <line x1="50" y1="0" x2="50" y2="30" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="50" y1="30" x2="100" y2="30" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="0" y1="52" x2="100" y2="52" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
        <line x1="100" y1="0" x2="100" y2="100" stroke="white" stroke-width="1" stroke-linecap="butt" vector-effect="non-scaling-stroke" />
    @endif
</svg>
