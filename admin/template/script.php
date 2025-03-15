<script>
    const themeSwitcher = document.getElementById('themeSwitcher');
    const profileMenuButton = document.getElementById('profileMenuButton');
    const ekstrakulikulerMenuButton = document.getElementById('ekstrakulikulerMenuButton');
    const profileMenu = document.getElementById('profileMenu');
    const ekstrakulikulerMenu = document.getElementById('ekstrakulikulerMenu');

    themeSwitcher.addEventListener('click', function() {
      document.body.classList.toggle('bg-gray-100');
      document.body.classList.toggle('bg-gray-900');
      document.querySelectorAll('.bg-white').forEach(el => el.classList.toggle('bg-gray-800'));
      document.querySelectorAll('.text-gray-800').forEach(el => el.classList.toggle('text-gray-200'));
      document.querySelectorAll('.text-gray-500').forEach(el => el.classList.toggle('text-gray-400'));
      document.querySelectorAll('.text-gray-600').forEach(el => el.classList.toggle('text-gray-300'));
    });

    profileMenuButton.addEventListener('click', function() {
      profileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
      if (!profileMenu.contains(event.target) && !profileMenuButton.contains(event.target)) {
        profileMenu.classList.add('hidden');
      }
    });

    ekstrakulikulerMenuButton.addEventListener('click', function() {
      ekstrakulikulerMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>