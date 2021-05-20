<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">LOGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/"><i class="fas fa-home"></i> <br>Home</a>
                    <a class="nav-item nav-link" href="/search"><i class="fas fa-search"></i> <br>Search</a>
                    <a class="nav-item nav-link" href="/explore"><i class="fas fa-compass"></i> <br>Explore</a>
                    <a class="nav-item nav-link" href="/recipes"><i class="fas fa-drumstick-bite"></i> <br>Recipes</a>
                    <a class="nav-item nav-link" href="/books"><i class="fas fa-book"></i> <br>Books</a>
                    <!-- sign in and sign up -->
                    <div class="items-to-right">
                        <a class="nav-item nav-link" href="/signin"><i class="fas fa-sign-in-alt"></i> <br>Sign in</a>
                        <a class="nav-item nav-link" href="/signup"><i class="fas fa-user-plus"></i> <br>Sign up</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    setup() {
    
    },
}
</script>