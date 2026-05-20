<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
*{box-sizing:border-box}
body{font-family:system-ui,sans-serif;background:#f1f5f9;color:#0f172a;font-size:14px}
.app{display:flex;flex-direction:column;height:100vh;min-height:600px}
.topbar{height:52px;background:#fff;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:10px;padding:0 14px;flex-shrink:0;z-index:10}
.hbtn{display:flex;flex-direction:column;gap:4px;background:none;border:none;cursor:pointer;padding:4px;border-radius:6px}
.hbtn span{display:block;width:18px;height:2px;background:#64748b;border-radius:2px;transition:all .2s}
.hbtn.open span:nth-child(1){transform:rotate(45deg) translate(4px,4px)}
.hbtn.open span:nth-child(2){opacity:0}
.hbtn.open span:nth-child(3){transform:rotate(-45deg) translate(4px,-4px)}
.logo{font-weight:700;font-size:15px;color:#2563eb;letter-spacing:-.3px}
.logo em{color:#94a3b8;font-style:normal;font-weight:400}
.tb-right{margin-left:auto;display:flex;align-items:center;gap:8px}
.tb-search{display:flex;align-items:center;gap:6px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:5px 10px}
.tb-search input{border:none;background:none;font-size:12px;color:#0f172a;outline:none;width:130px}
.tb-search svg{width:13px;height:13px;opacity:.4;flex-shrink:0}
.notif{position:relative;width:32px;height:32px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer}
.notif svg{width:14px;height:14px;opacity:.6}
.ndot{position:absolute;top:5px;right:5px;width:6px;height:6px;background:#ef4444;border-radius:50%;border:1.5px solid #fff}
.ava-top{width:30px;height:30px;border-radius:50%;background:#2563eb;color:#fff;font-size:11px;font-weight:600;display:flex;align-items:center;justify-content:center;cursor:pointer}
.body{display:flex;flex:1;overflow:hidden}
.sidebar{width:210px;min-width:210px;background:#fff;border-right:1px solid #e2e8f0;display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;flex-shrink:0}
.overlay{display:none;position:fixed;inset:0;top:52px;background:rgba(0,0,0,.45);z-index:40}
.main{flex:1;overflow-y:auto;padding:20px;min-width:0}

/* Page heading */
.pg-head{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:18px}
.pg-title{font-size:18px;font-weight:700;letter-spacing:-.3px}
.pg-sub{font-size:12px;color:#64748b;margin-top:2px}

/* Search bar */
.search-card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin-bottom:16px}
.search-card .search-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:12px;align-items:end}
.search-field label{display:block;font-size:10px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px}
.search-field input,
.search-field select{width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 10px;font-size:13px;background:#f8fafc;color:#0f172a;outline:none;transition:border .15s,background .15s}
.search-field input:focus,
.search-field select:focus{border-color:#2563eb;background:#fff;box-shadow:0 0 0 3px #bfdbfe55}
.search-actions{display:flex;gap:8px;align-items:flex-end}
.btn-search{background:#2563eb;color:#fff;border:none;border-radius:8px;padding:9px 18px;font-size:13px;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:6px;white-space:nowrap}
.btn-search:hover{background:#1d4ed8}
.btn-reset{background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;padding:9px 14px;font-size:13px;cursor:pointer;white-space:nowrap}
.btn-reset:hover{background:#e2e8f0}

/* Table card */
.table-card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden}
.table-card-head{padding:14px 16px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px}
.table-card-title{font-size:13px;font-weight:600}
.user-count-badge{font-size:11px;font-weight:600;padding:2px 10px;border-radius:20px;background:#eff6ff;color:#1d4ed8}
.tbl-scroll{overflow-x:auto;-webkit-overflow-scrolling:touch}
.user-table{width:100%;border-collapse:collapse;font-size:12px;min-width:750px}
.user-table th{padding:10px 12px;text-align:left;font-size:10px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;background:#f8fafc;border-bottom:1px solid #e2e8f0;white-space:nowrap}
.user-table td{padding:11px 12px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
.user-table tr:last-child td{border-bottom:none}
.user-table tbody tr:hover td{background:#f8fafc}

/* User cell */
.user-cell{display:flex;align-items:center;gap:8px}
.user-avatar{width:32px;height:32px;border-radius:50%;background:#eff6ff;color:#1d4ed8;font-size:10px;font-weight:600;display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden}
.user-avatar img{width:100%;height:100%;object-fit:cover}
.user-name{font-weight:600;font-size:12px;color:#0f172a}
.user-username{font-size:10px;color:#94a3b8;margin-top:1px}

/* Tags */
.tag{display:inline-block;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600}
.tag-active{background:#dcfce7;color:#15803d}
.tag-inactive{background:#fee2e2;color:#991b1b}

/* Mono text */
.mono{font-family:'Courier New',monospace;font-size:11px;color:#64748b}

/* Amount */
.amount{font-weight:600;font-size:12px;color:#0f172a}

/* Action buttons */
.action-btns{display:flex;gap:5px;align-items:center;flex-wrap:nowrap}
.btn-xs{padding:5px 10px;border-radius:6px;font-size:11px;font-weight:500;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:4px;white-space:nowrap}
.btn-xs:hover{opacity:.85;text-decoration:none}
.btn-details{background:#dbeafe;color:#1d4ed8}
.btn-status{background:#fef3c7;color:#92400e}
.btn-delete{background:#fee2e2;color:#991b1b}

/* No results */
.no-results{padding:48px;text-align:center;color:#94a3b8}
.no-results svg{width:36px;height:36px;opacity:.3;margin-bottom:10px}

/* Pagination */
.pagination-bar{padding:12px 16px;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px}
.pagination-info{font-size:12px;color:#64748b}
.pagination{margin:0}

/* Mobile */
@media(max-width:640px){
  .sidebar{position:fixed;top:52px;left:0;height:calc(100% - 52px);z-index:50;transform:translateX(-100%);transition:transform .25s ease;min-width:200px;width:200px}
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .tb-search{display:none}
  .search-card .search-grid{grid-template-columns:1fr 1fr}
  .search-actions{flex-direction:row;width:100%}
  .btn-search,.btn-reset{flex:1;justify-content:center}
  .action-btns{flex-wrap:wrap}
}
@media(min-width:641px){
  .hbtn{display:none}
  .overlay{display:none!important}
}
</style>

<div class="app">
  <div class="topbar">
    <button class="hbtn" id="hbtn" onclick="toggleSB()">
      <span></span><span></span><span></span>
    </button>
    <div class="logo">Onetask<em>Market</em>
      <span style="font-size:10px;background:#eff6ff;color:#2563eb;padding:2px 6px;border-radius:4px;font-weight:600;margin-left:2px">Admin</span>
    </div>
    <div class="tb-search">
      <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6.5" cy="6.5" r="4.5"/><path d="m10 10 3.5 3.5"/></svg>
      <input placeholder="Search jobs, users...">
    </div>
    <div class="tb-right">
      <div class="notif">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 1.5a5 5 0 0 1 5 5v2l1 2H2l1-2v-2a5 5 0 0 1 5-5Z"/><path d="M6.5 13.5a1.5 1.5 0 0 0 3 0"/></svg>
        <div class="ndot"></div>
      </div>
      <div class="ava-top">AD</div>
    </div>
  </div>

  <div class="body">
    <div class="overlay" id="overlay" onclick="closeSB()"></div>

    @include('admin.layouts.sidebar')

    <main class="main">

      {{-- Page heading --}}
      <div class="pg-head">
        <div>
          <div class="pg-title">User Management</div>
          <div class="pg-sub">Total {{ $users->total() }} registered users</div>
        </div>
      </div>

      {{-- ===== SEARCH FORM ===== --}}
      <div class="search-card">
        <form method="GET" action="{{ route('admin.users') }}" id="searchForm">
          <div class="search-grid">

            <div class="search-field">
              <label>User ID</label>
              <input type="number" name="search_id" value="{{ request('search_id') }}" placeholder="e.g. 11">
            </div>

            <div class="search-field">
              <label>Username</label>
              <input type="text" name="search_username" value="{{ request('search_username') }}" placeholder="e.g. john_doe">
            </div>

            <div class="search-field">
              <label>Email</label>
              <input type="text" name="search_email" value="{{ request('search_email') }}" placeholder="e.g. user@mail.com">
            </div>

            <div class="search-field">
              <label>Status</label>
              <select name="search_status">
                <option value="">All Status</option>
                <option value="1" {{ request('search_status')==='1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('search_status')==='0' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>

            <div class="search-actions" style="padding-bottom:0">
              <button type="submit" class="btn-search">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="6.5" cy="6.5" r="4.5"/><path d="m10 10 3.5 3.5"/></svg>
                Search
              </button>
              <a href="{{ route('admin.users') }}" class="btn-reset">Reset</a>
            </div>

          </div>
        </form>
      </div>
      {{-- ===== END SEARCH FORM ===== --}}

      {{-- ===== USER TABLE ===== --}}
      <div class="table-card">
        <div class="table-card-head">
          <span class="table-card-title">All Users</span>
          <span class="user-count-badge">{{ $users->total() }} users</span>
        </div>

        <div class="tbl-scroll">
          <table class="user-table">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Deposit</th>
                <th>Earning</th>
                <th>Refers</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $index => $user)
              <tr>
                <td class="mono">{{ $users->firstItem() + $index }}</td>

                <td>
                  <div class="user-cell">
                    <div class="user-avatar">
                      @if($user->photo)
                        <img src="{{ asset('storage/'.$user->photo) }}" alt="{{ $user->name }}">
                      @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strstr($user->name, ' '), 1, 1)) }}
                      @endif
                    </div>
                    <div>
                      <div class="user-name">{{ $user->name }}</div>
                      <div class="user-username">
                        @if($user->username) @{{ $user->username }} @else ID: {{ $user->id }} @endif
                      </div>
                    </div>
                  </div>
                </td>

                <td style="color:#64748b;font-size:11px">{{ $user->email }}</td>

                <td class="mono">{{ $user->phone ?? '—' }}</td>

                <td class="amount">${{ $user->total_deposit }}</td>

                <td class="amount">${{ $user->total_earning }}</td>

                <td class="mono">{{ $user->total_refer }}</td>

                <td>
                  @if($user->photo)
                    <img src="{{ asset('storage/'.$user->photo) }}"
                         style="width:40px;height:40px;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0">
                  @else
                    <span style="font-size:11px;color:#94a3b8">No photo</span>
                  @endif
                </td>

                <td>
                  @if($user->status)
                    <span class="tag tag-active">Active</span>
                  @else
                    <span class="tag tag-inactive">Inactive</span>
                  @endif
                </td>

                <td>
                  <div class="action-btns">
                    <a href="{{ route('admin.user.details', $user->id) }}" class="btn-xs btn-details">
                      Details
                    </a>
                    <button class="btn-xs btn-status editBtn"
                            data-id="{{ $user->id }}"
                            data-status="{{ $user->status }}">
                      Status
                    </button>
                    <a href="{{ route('admin.user-delete', $user->id) }}"
                       onclick="return confirm('Are you sure to delete this user?')"
                       class="btn-xs btn-delete">
                      Delete
                    </a>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="10">
                  <div class="no-results">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35M11 8v6M8 11h6"/></svg>
                    <div style="font-weight:600;margin-bottom:4px">No users found</div>
                    <div style="font-size:12px">Try adjusting your search filters</div>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
        <div class="pagination-bar">
          <span class="pagination-info">
            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
          </span>
          <div>
            {{ $users->appends(request()->query())->links() }}
          </div>
        </div>
        @endif

      </div>
      {{-- ===== END USER TABLE ===== --}}

    </main>
  </div>
</div>

{{-- ===== CHANGE STATUS MODAL ===== --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form id="editForm" action="{{ route('admin.update-user-status') }}" method="POST">
      @csrf
      <div class="modal-content" style="border-radius:12px;border:1px solid #e2e8f0">
        <div class="modal-header" style="border-bottom:1px solid #f1f5f9;padding:14px 16px">
          <h6 style="font-weight:600;margin:0">Change User Status</h6>
          <button type="button" class="close" data-dismiss="modal" style="font-size:18px">&times;</button>
        </div>
        <div class="modal-body" style="padding:16px">
          <input type="hidden" name="id" id="edit_id">
          <label style="font-size:11px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:6px">Status</label>
          <select name="status" id="edit_status" class="form-control" style="border-radius:8px;font-size:13px">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:12px 16px">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" style="border-radius:8px">Update Status</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* Sidebar toggle (mobile) */
var mobOpen=false;
function toggleSB(){
  mobOpen=!mobOpen;
  var sb=document.getElementById('sidebar');
  var ov=document.getElementById('overlay');
  var hb=document.getElementById('hbtn');
  if(mobOpen){sb.classList.add('mob-open');ov.classList.add('show');hb.classList.add('open')}
  else{sb.classList.remove('mob-open');ov.classList.remove('show');hb.classList.remove('open')}
}
function closeSB(){
  mobOpen=false;
  document.getElementById('sidebar').classList.remove('mob-open');
  document.getElementById('overlay').classList.remove('show');
  document.getElementById('hbtn').classList.remove('open');
}

/* Status modal */
$(document).on('click','.editBtn',function(){
  $('#edit_id').val($(this).data('id'));
  $('#edit_status').val($(this).data('status'));
  $('#editModal').modal('show');
});
</script>