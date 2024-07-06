<!-- resources/views/components/db/notification-item.blade.php -->
<li class="list-group-item list-group-item-action dropdown-notifications-item {{ $read ? 'marked-as-read' : '' }}">
     <div class="d-flex">
         <div class="flex-shrink-0 me-3">
             <div class="avatar">
                 <span class="avatar-initial rounded-circle bg-label-warning"><i class="ri-error-warning-line"></i></span>
             </div>
         </div>
         <div class="flex-grow-1">
             <h6 class="mb-1 small">{{ $title }}</h6>
             <small class="mb-1 d-block text-body">{{ $content }}</small>
             <small class="text-muted">{{ $timestamp }}</small>
         </div>
         <div class="flex-shrink-0 dropdown-notifications-actions">
             <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
             <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ri-close-line"></span></a>
         </div>
     </div>
 </li>
 