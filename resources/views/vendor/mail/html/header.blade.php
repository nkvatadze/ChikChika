<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Chik Chika')
                <x-application-logo style="height: 10rem; width: 10rem; transform: scaleX(-1)"/>
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
