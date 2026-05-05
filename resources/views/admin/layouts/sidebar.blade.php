  <nav class="sidebar" id="sidebar">
      <div style="padding:10px 8px 6px">
        <div style="padding:8px 10px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;gap:8px">
          <div style="width:28px;height:28px;border-radius:7px;background:#2563eb;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#fff" stroke-width="1.8"><rect x="2" y="2" width="5" height="5" rx="1.5"/><rect x="9" y="2" width="5" height="5" rx="1.5"/><rect x="2" y="9" width="5" height="5" rx="1.5"/><rect x="9" y="9" width="5" height="5" rx="1.5"/></svg>
          </div>
          <div><div style="font-size:11px;font-weight:600;color:#1d4ed8">Admin Panel</div><div style="font-size:10px;color:#3b82f6">Super Admin</div></div>
        </div>
      </div>

      <div class="sec-label">Overview</div>
      <div class="ni on" onclick="navClick(this,'Dashboard')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="2" width="5" height="5" rx="1.5"/><rect x="9" y="2" width="5" height="5" rx="1.5"/><rect x="2" y="9" width="5" height="5" rx="1.5"/><rect x="9" y="9" width="5" height="5" rx="1.5"/></svg>
        
         <a class="link text-success" style="text-decoration: none;" href="{{route('admin.dashboard')}}">Dashboard</a>
      </div>
      <div class="ni" onclick="navClick(this,'Users')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M2 14a6 6 0 0 1 12 0"/></svg>
         <a class="link text-success" style="text-decoration: none;" href="{{route('admin.users')}}">Users</a>

         <span class="nbadge red">2.4k</span>
      </div>
      <div class="sec-label">Job Management</div>


       <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.all-jobs')}}">All Jobs</a>
      </div>



       <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.pending-jobs')}}">Pending Jobs</a>
      </div>


      <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.active-jobs')}}">Live Jobs</a>
      </div>

     
     
       <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.paused-jobs')}}">Paused Jobs</a>
      </div>

       <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.rejected-jobs')}}">Rejected Jobs</a>
      </div>

       <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.completed-jobs')}}">Complete Jobs</a>
      </div>

     
      <div class="sec-label">Category Setting</div>
       <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.continent')}}">Continent</a>
      </div>

      <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.country')}}" class="link text-success" style="text-decoration: none;">Country</a>
      </div>

        <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.category')}}" class="link text-success" style="text-decoration: none;">Category</a>
      </div>

        <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.subcategory')}}" class="link text-success" style="text-decoration: none;">Sub Category</a>
      </div>
      <div class="sec-label">Pyment Setting</div>
      
      <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.payment.method')}}" class="link text-success" style="text-decoration: none;">Payment Method</a>
      </div>


      <div class="sec-label">Deposit Manage</div>
      <div class="ni" onclick="navClick(this,'Disputes')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
        
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.pending-deposit')}}">Pending Deposit</a>
         <span class="nbadge red">5</span>
      </div>

       <div class="ni" onclick="navClick(this,'Disputes')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
        
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.approved-deposit')}}">Approved Deposit</a>
         <span class="nbadge red">5</span>
      </div>

       <div class="ni" onclick="navClick(this,'Disputes')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
        
        <a class="link text-success" style="text-decoration: none;" href="{{route('admin.rejected-deposit')}}">Rejected Deposit</a>
         <span class="nbadge red">5</span>
      </div>
     
      <div class="ni" onclick="navClick(this,'Reviews')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 2l1.7 3.4 3.8.5-2.7 2.7.6 3.8L8 10.6l-3.4 1.8.6-3.8L2.5 5.9l3.8-.5z"/></svg>
        Reviews
      </div>
      <div class="ni" onclick="navClick(this,'Payments')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="1.5" y="4" width="13" height="9" rx="1.5"/><path d="M1.5 7h13"/></svg>
        Payments
      </div>

      <div class="sec-label">Analytics</div>
      <div class="ni" onclick="navClick(this,'Reports')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12l4-4 3 3 5-6"/></svg>
        Reports
      </div>
      <div class="ni" onclick="navClick(this,'Fraud Detection')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 1.5L2 4v5c0 3 2.7 5.5 6 6.5 3.3-1 6-3.5 6-6.5V4l-6-2.5z"/></svg>
        Fraud Detection
      </div>

      <div class="sec-label">System</div>
      <div class="ni" onclick="navClick(this,'Settings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="2.5"/><path d="M8 2v1.5M8 12.5V14M2 8h1.5M12.5 8H14M3.6 3.6l1 1M11.4 11.4l1 1M3.6 12.4l1-1M11.4 4.6l1-1"/></svg>
         <a href="{{route('admin.setting')}}" class="link text-success" style="text-decoration: none;">Setting</a>
      </div>

      <div class="sb-bottom">
        <div class="ni" style="color:#dc2626">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M6 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3M10 11l3-3-3-3M13 8H6"/></svg>
            <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
              Logout
          </button>
          </form>
           
        </div>
      </div>
    </nav>