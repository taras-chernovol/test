<nav class="nav nav-pills">
    <?php if (Application::$route == '/'): ?>
        <a class="nav-link active" href="/">Currency</a>
        <a class="nav-link" href="/add">Add currency</a>
    <?php elseif (Application::$route == '/add'): ?>
        <a class="nav-link" href="/">Currency</a>
        <a class="nav-link active" href="/add">Add currency</a>
    <?php endif ?>
</nav>