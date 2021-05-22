<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">LOGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/"><font-awesome-icon icon="home" /> <br>Home</a>
                    <a class="nav-item nav-link" href="/search"><font-awesome-icon icon="search"/> <br>Search</a>
                    <a class="nav-item nav-link" href="/explore"><font-awesome-icon icon="compass"/> <br>Explore</a>
                    <a class="nav-item nav-link" href="/recipes"><font-awesome-icon icon="drumstick-bite"/> <br>Recipes</a>
                    <a class="nav-item nav-link" href="/books"><font-awesome-icon icon="book"/> <br>Books</a>
                    <!-- sign in and sign up -->
                    <div class="items-to-right">
                        <a class="nav-item nav-link" href="/signin"><font-awesome-icon icon="sign-in-alt"/> <br>Sign in</a>
                        <a class="nav-item nav-link" href="/signup"><font-awesome-icon icon="user-plus"/> <br>Sign up</a>
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