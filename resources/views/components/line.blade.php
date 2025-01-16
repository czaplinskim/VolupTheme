<svg
    xmlns="http://www.w3.org/2000/svg"
    class="{{ $direction === 'horizontal' ? 'w-full h-1' : ($direction === 'vertical' ? 'w-1 h-full' : 'w-full h-full') }} overflow-visible"
    viewBox="{{ $direction === 'horizontal' ? '0 0 100 1' : ($direction === 'vertical' ? '0 0 1 100' : '0 0 100 100') }}"
    preserveAspectRatio="none"
>
    <line
        x1="{{ $direction === 'diagonal' && $angle == 45 ? '0' : ($direction === 'diagonal' && $angle == -45 ? '100' : '0') }}"
        y1="{{ $direction === 'diagonal' && $angle == 45 ? '100' : ($direction === 'diagonal' && $angle == -45 ? '0' : '0') }}"
        x2="{{ $direction === 'diagonal' && $angle == 45 ? '100' : ($direction === 'diagonal' && $angle == -45 ? '0' : ($direction === 'horizontal' ? '100' : '0')) }}"
        y2="{{ $direction === 'diagonal' && $angle == 45 ? '0' : ($direction === 'diagonal' && $angle == -45 ? '100' : ($direction === 'vertical' ? '100' : '0')) }}"
        stroke="{{ $color }}"
        stroke-linecap="butt"
        stroke-width="{{ $stroke ?: '1' }}"
    />
</svg>


