 <button class="btn-icon relative" onclick="toggleDropdown('notif-dd')">
     <i class="fas fa-bell text-sm"></i>
     @php
         $unreadCount = count(Auth::user()->unReadNotifications);
     @endphp

     @if ($unreadCount > 0)
         <span
             class="absolute -top-0.5 -right-0.5 w-3.5 h-3.5 bg-red text-white text-[8px] font-bold rounded-full flex items-center justify-center">
             {{ $unreadCount }}
         </span>
     @endif
 </button>
 <div class="dropdown-menu" id="notif-dd" style="right:0;min-width:280px;top:42px">
     <div class="p-3 border-b border-border">
         <span class="text-tp text-xs font-semibold">Notifications</span>
         @if ($unreadCount > 0)
             <span class="chip chip-red ml-2">{{ $unreadCount }} new</span>
         @endif
     </div>
     <div class="p-2">
         <div class="dropdown-item"><i class="fas fa-user-plus text-accent text-xs"></i>
             <div>
                 <div class="text-tp text-xs">New student registered</div>
                 <div class="text-ts text-[10px]">2 min ago</div>
             </div>
         </div>
     </div>
     <div class="p-3 border-t border-border text-center">
         <span class="text-accent text-xs cursor-pointer hover:underline">View all notifications
             →</span>
     </div>
 </div>
