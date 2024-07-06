<!-- resources/views/components/db/menu-item.blade.php -->
<li class="menu-item @if ($active === 'true') active open @endif">
     <a href="javascript:void(0);" class="menu-link menu-toggle">
         <i class="menu-icon tf-icons {{ $icon }}"></i>
         <div data-i18n="{{ $itemName }}">{{ $itemName }}</div>
        </a>
     {{ $slot }}
 </li>
 