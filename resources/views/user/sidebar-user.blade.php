 <div class="col-md-3">
     <nav id="sidebar" style="overflow-y: auto;">
         <div class="list-group">
             <a href="/" class="list-group-item list-group-item-action {{ Request::is('/*') ? 'active' : '' }}">
                 <i class="fas fa-home"></i> Home
             </a>
             <div class="list-group">
                 <a href="{{ route('pelamar.detail-login-user') }}" class="list-group-item list-group-item-action {{ Request::is('detail-profile*') ? 'active' : '' }}">
                     <i class="fas fa-user"></i> Profile
                 </a>
                 @if($interviewActivity and $incompletedFormInterview)
                 <a href="{{ route('UsersData.create-form-interview') }}" class="list-group-item list-group-item-action {{ Request::is('form-interview*') ? 'active' : '' }}">
                     <i class="fas fa-file"></i> Form Interview
                 </a>
                 @endif
             </div>
             <a href="{{ route('pelamar.job-applied') }}" class="list-group-item list-group-item-action {{ Request::is('job-applied*') ? 'active' : '' }}">
                 <i class="fas fa-suitcase-rolling"></i> Job Applied
             </a>
         </div>
     </nav>
 </div>