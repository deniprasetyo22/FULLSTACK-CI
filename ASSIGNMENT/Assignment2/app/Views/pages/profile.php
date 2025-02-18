<body>
    {! Cek Mode Maintenance !}
    {if $site_settings.maintenance_mode}
    <div class="alert alert-warning">
        Sistem sedang dalam maintenance
    </div>
    {else}
    <div class="container">
        <h1>Profil Pengguna</h1>

        {! Basic Conditional !}
        {if $user.is_verified}
        <span class="badge">✓ Terverifikasi</span>
        {endif}

        {! If-Else dengan Multiple Conditions !}
        {if $user.role == 'admin'}
        <div class="role-badge admin">Administrator</div>
        {elseif $user.role == 'moderator'}
        <div class="role-badge mod">Moderator</div>
        {else}
        <div class="role-badge user">Regular User</div>
        {endif}
        {! Nested Conditionals !}
        {if $user.subscription == 'premium'}
        <div class="premium-section">
            <h3>Fitur Premium Aktif</h3>
            {if $user.points > 500}
            <p>Anda memiliki {user.points} poin VIP!</p>
            {if $user.login_count > 30}
            <div class="reward">Anda mendapat bonus loyalitas!</div>
            {endif}
            {endif}
        </div>
        {endif}

        {! Menggunakan Operator Perbandingan !}
        {if $user.age >= 18 && user.is_verified}
        <div class="adult-content">
            Konten khusus dewasa tersedia
        </div>
        {endif}


        {! Looping dengan Conditional !}
        <div class="notifications">
            {user.notifications}
            {if $count > 0}
            <div class="notification-item">
                {if $type == 'message'}
                <span class="icon">📨</span>
                {elseif $type == 'alert'}
                <span class="icon">⚠️</span>
                {endif}
                Anda memiliki {count} {type}
            </div>
            {endif}
            {/user.notifications}
        </div>

        {! Unless Conditional (kebalikan dari if) !}
        {! Ditampilkan jika kondisi false !}
        {unless user.is_verified}
        <div class="warning">
            Silakan verifikasi akun Anda
        </div>
        {/unless}

        {! Menggunakan Operator Logika !}
        {if user.role == 'admin' || user.points >= 1000}
        <div class="special-access">
            Akses Spesial Diberikan
        </div>
        {endif}
    </div>
    {endif}
</body>