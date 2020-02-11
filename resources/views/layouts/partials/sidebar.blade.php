<nav id="sidebar">
    <div class="sidebar-header">
        <h3>PMS</h3>
    </div>
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/">
                    <i class="material-icons dashboard-icons">dashboard</i> <span class="text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="material-icons dashboard-icons">calendar_today</i> <span class="text">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('project.index')}}">
                    <i class="material-icons dashboard-icons">assignment</i> <span class="text">Projects</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="material-icons dashboard-icons">list</i> <span class="text">Tasks</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('company.index')}}">
                    <i class="material-icons dashboard-icons">location_city</i> <span class="text">Companies</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
