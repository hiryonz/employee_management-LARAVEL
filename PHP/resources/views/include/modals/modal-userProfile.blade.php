 <!-- Modal Dropdown -->
 <div class="user-dropdown" id="userDropdown">
    <ul>
        <li><a class="nav-link" href="{{route("viewEmployeeData", auth()->user()->employee->cedula ?? 'login2')}}">Perfil</a></li>
        <li><a class="nav-link" href="{{route("logout")}}">Cerrar Session</a></li>
    </ul>
</div>


<script>
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');

    // Toggle dropdown on click
    userIcon.addEventListener('click', (e) => {
        e.preventDefault();
        userDropdown.classList.toggle('show');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (e) => {
        if (!userIcon.contains(e.target) && !userDropdown.contains(e.target)) {
            userDropdown.classList.remove('show');
        }
    });
</script>