<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="margin:10px">Panel</h3>
    </div>
    <div class="panel-body">
    {{-- <ul class="list-group">
        <li class="list-group-item">Profile</li>
        <li class="list-group-item">Order</li>
        <li class="list-group-item">Change Password</li>
    </ul> --}}
    <div style="padding: 20px 20px; line-height: 8px">
        <p>
            <a href="{!! route('customer.dashboard') !!}"> <b> <i class="icon-dashboard"></i> Dashboard</b> </a>
        </p>
        <p>
            <a href="{!! route('customer.profile') !!}"> <b> <i class="fa fa-user"></i> Profile</b> </a>
        </p>
        <p>
            <a href="{!! route('customer.change-password') !!}"> <b> <i class="fa fa-pen"></i> Change Password</b> </a>
        </p>
    </div>
</div>
</div>
