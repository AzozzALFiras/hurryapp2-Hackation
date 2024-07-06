<!-- resources/views/components/db/collapsed-menu-item.blade.php -->
<li class="menu-item @if ($active === 'true') active @endif">
     <a href="{{ $url }}" class="menu-link">
         <div data-i18n="{{ $itemName }}">{{ $itemName }}</div>
     </a>
 </li>
 