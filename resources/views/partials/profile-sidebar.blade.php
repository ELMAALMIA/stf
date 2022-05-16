<div class="sidebar">
    <div class="inner-sidebar">
        <ul>
            @if (request()->url() == route('profile.edit'))
            <li class="active">Mon Profile</li>
            @else
            <li><a href="{{ route('profile.edit') }}">Mon Profile</a></li>
            @endif

            @if (request()->url() == route('orders.index'))
            <li class="active">Mes Commandes</li>
            @else
            <li><a href="{{ route('orders.index') }}">Mes Commandes</li>
            @endif
        </ul>
    </div>
</div>